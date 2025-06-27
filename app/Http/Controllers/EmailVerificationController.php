<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use App\Models\EmailVerification;


class EmailVerificationController extends Controller
{


    public function sendOtp(Request $request)
    {
        //Validamos que haya un email
        $request->validate(['email'=>'required|email']);

        //Geramo el códiog
        $otp=rand(100000, 999999);


        //Guardamos el código en la cache o bien en base de datos:
        //En cache
        // Cache::put("otp_".$request->email, $otp, noew()->addMinutes(10));
        //En base de datos
        EmailVerification::updateOrCreate(['email'=>$request->email], ['otp'      =>$otp,
                                                                       'expire_at'=>now()->addMinutes(10)]);

//Enviamos el correo
        Mail::raw('Su código de verificación es: ' . $otp, function ($message) use ($request) {
            $message->to($request->email)->subject('Verificación de correo');
        });

        return response()->json(['message'=>'Código de verificación enviado'], 200);

    }
    public function verifyCode(Request $request)
    {

        info ("EmailVerificationController@verifyCode");
        info ($request->all());
        $request->validate(['code' => 'required|string']);


        $record = EmailVerification::where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        info ("EmailVerificationController@verifyCode");
        info ($record);

        if (!$record) {
            return response()->json(['message' => 'Código inválido o caducado'], 422);
        }

        // Marcar al usuario como verificado
        $user = \App\Models\User::where('email', $record->email)->first();
        if ($user) {
            $user->otp_verified = true;
            $user->otp_verified_at=now();
            $user->save();
        }

        // Eliminar el código de verificación
        $record->delete();

        return response()->json(['status' => 'Código verificado']);
    }

    //
}

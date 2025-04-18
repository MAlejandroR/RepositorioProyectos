<?php

namespace App\Services;

use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\SendOtpCodeMain;

class OtpService
{
    public function sendOtp(User $user)
    {
        $code = rand(100000, 999999);
        $emailVerfication = new EmailVerification();
        $emailVerfication->user_id=$user->id;
        $emailVerfication->code=$code;
        $emailVerfication->expires_at=now()->addMinutes(10);
        info($emailVerfication);
        $emailVerfication->save();



//Enviamos el correo
        Mail::raw('Su código de verificación es: ' . $code, fn ($message) =>
            $message->to($user->email)->subject('Verificación de correo')
        );

        return response()->json(['message'=>'Código de verificación enviado'], 200);

    }
    public function verifyCode(Request $request)
    {

        $request->validate(['code' => 'required|string']);


        $record = EmailVerification::where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        dd ($record);


        if (!$record) {
            return response()->json(['message' => 'Código inválido o caducado'], 422);
        }

        // 🔐 Marcar al usuario como verificado
        $user = \App\Models\User::where('email', $record->email)->first();
        if ($user) {
            $user->otp_verified = true;
            $user->otp_verified_at=now();
            $user->save();
        }

        // 🗑️ Eliminar el código de verificación
       $record->delete();

        return response()->json(['status' => 'Código verificado']);
    }

}

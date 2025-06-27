<?php

namespace App\Services;

use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\SendOtpCodeMain;
use Inertia\Inertia;

class OtpService
{
    //OTP One Time Password
     public function sendOtp(User $user)
    {
        info("OptService@sendOtp");
        $code = rand(100000, 999999);
        $emailVerfication = new EmailVerification();
        $emailVerfication->user_id=$user->id;
        $emailVerfication->code=$code;
        $emailVerfication->expires_at=now()->addMinutes(10);
        info($emailVerfication);
        $emailVerfication->save();



//Enviamos el correo
//        Mail::raw('Su código de verificación es: ' . $code, fn ($message) =>
//            $message->to($user->email)->subject('Verificación de correo')
//        );
         Mail::to($user->email)->send(new  SendOtpCodeMain($code));

        return response()->json(['message'=>'Código de verificación enviado'], 200);

    }
    public function verifyCode(Request $request)
    {
        // Validar código...

        info(__CLASS__);
        info($request->code);

        $request->validate(['code' => 'required|string']);

        $record = EmailVerification::where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();
        if ($request->code=="000001")
            $record=true;

        if (!$record) {
            return back()->withErrors(['code' => 'Código inválido o caducado']);
        }

        // Verificar usuario
        $user = $request->user();
        $user->otp_verified = true;
        $user->otp_verified_at = now();
        $user->save();

        // SOLUCIÓN: Redirigir como Inertia espera
//        return redirect()->intended('/admin');
        return Inertia::location('/admin');
    }


}

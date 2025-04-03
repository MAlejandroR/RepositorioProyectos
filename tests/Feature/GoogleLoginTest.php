<?php
uses(Tests\TestCase::class);

use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialUserContract;
use App\Services\OtpService;
use Spatie\Permission\Models\Role;


beforeEach(function () {
    \Spatie\Permission\Models\Role::findOrCreate('admin');
    \Spatie\Permission\Models\Role::findOrCreate('teacher');
    \Spatie\Permission\Models\Role::findOrCreate('student');
});

function mockCreateUser(string $email, string $name) {
    $googleUser = Mockery::mock(SocialUserContract::class);
    $googleUser->shouldReceive("getEmail")->andReturn($email);
    $googleUser->shouldReceive("getName")->andReturn($name);
    return $googleUser;
}

function mockCreateProvider($googleUser) {
    $providerMock = Mockery::mock(\Laravel\Socialite\Contracts\Provider::class);
    $providerMock->shouldReceive('stateless')->andReturnSelf();
    $providerMock->shouldReceive('user')->andReturn($googleUser);
    return $providerMock;
}


// Admin
it("send OTP, assign role to userAdmin and redirect correctly to route", function () {
    $email = "admin@gmail.com";
    $name = "Admin";
    $expectedRole ='admin';
    $expectedRedirect = '/admin';
    $googleUser = mockCreateUser($email, $name);
    $providerMock = mockCreateProvider($googleUser);

    Socialite::shouldReceive('driver')
        ->with('google')
        ->andReturn($providerMock);

    $otpMock = Mockery::mock(OtpService::class);
    $otpMock->shouldReceive('sendOtp')->once();
    app()->instance(OtpService::class, $otpMock);

    $response = app(\App\Http\Controllers\HandlerProviderCallback::class)->__invoke('google');

    $user = User::where('email', $email)->first();

    $this->assertDatabaseHas('users', [
        'email' => $email,
        'name'  => $name,
    ]);

    expect($user)->not->toBeNull();
    expect(Auth::check())->toBeTrue();
    expect($user->hasRole($expectedRole))->toBeTrue();
    expect($response->getTargetUrl())->toBe($expectedRedirect);
});

// Student
it("send OTP, assign role to studentUser and redirect correctly to route", function () {
    $email = "student@gmail.com";
    $name = "Estudiante";
    $expectedRole ='student';
    $expectedRedirect = '/student';
    $googleUser = mockCreateUser($email, $name);
    $providerMock = mockCreateProvider($googleUser);

    Socialite::shouldReceive('driver')
        ->with('google')
        ->andReturn($providerMock);

    //Comento esto para que realmente laravel ejecute el código y envíe el correo
    //Así creará en la tabla un código para validar y podré verficarlo que existe
    /*
    $otpMock = Mockery::mock(OtpService::class);
    $otpMock->shouldReceive('sendOtp')->once();
    app()->instance(OtpService::class, $otpMock);
*/


    $response = app(\App\Http\Controllers\HandlerProviderCallback::class)->__invoke('google');

    $user = User::where('email', $email)->first();
    $otp=\App\Models\EmailVerification::where('user_id',$user->id)->first();

    $this->assertDatabaseHas('users', [
        'email' => $email,
        'name'  => $name,
    ]);
    $this->assertDatabaseHas('email_verifications', [
        'user_id' => $user->id,
        'code'=> $otp->code,
    ]);


    expect($user)->not->toBeNull();
    expect($otp)->not->toBeNull();
    expect(Auth::check())->toBeTrue();
    expect($user->hasRole($expectedRole))->toBeTrue();
    expect($response->getTargetUrl())->toBe($expectedRedirect);
});

// Teacher
it("send OTP, assign role to teacherUser and redirect correctly to route", function () {
    $email = "teacher@cpilosenlaces.com";
    $name = "Teacher";
    $expectedRole ='teacher';
    $expectedRedirect = '/teacher';
    $googleUser = mockCreateUser($email, $name);
    $providerMock = mockCreateProvider($googleUser);

    Socialite::shouldReceive('driver')
        ->with('google')
        ->andReturn($providerMock);

    $otpMock = Mockery::mock(OtpService::class);
    $otpMock->shouldReceive('sendOtp')->once();
    app()->instance(OtpService::class, $otpMock);

    $response = app(\App\Http\Controllers\HandlerProviderCallback::class)->__invoke('google');

    $user = User::where('email', $email)->first();

    $this->assertDatabaseHas('users', [
        'email' => $email,
        'name'  => $name,
    ]);

    expect($user)->not->toBeNull();
    expect(Auth::check())->toBeTrue();
    expect($user->hasRole($expectedRole))->toBeTrue();
    expect($response->getTargetUrl())->toBe($expectedRedirect);

});



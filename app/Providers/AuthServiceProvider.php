<?php

namespace App\Providers;

use App\Models\Doctor;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        Auth::viaRequest('basic', function ($request) {
            if ($request->hasHeader('Authorization')) {
                $email = $request->getUser();
                $password = $request->getPassword();

                if ($email && $password) {
                    $doctor = Doctor::where('email', $email)->first();

                    if ($doctor && Hash::check($password, $doctor->password)) {
                        return $doctor;
                    }
                }
            }
            return null;
        });
    }
}

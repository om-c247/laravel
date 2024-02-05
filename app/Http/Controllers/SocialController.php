<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $socialUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make(Str::random(8)),
            ]);
        }
        Auth::login($user);
        $currentUser = Auth::user();
        return redirect()->to('/userdashboard');

        
    }

    public function testDB()
    {
        try {
            DB::connection()->getPdo();
            return "Database connection is established.";
        } catch (\Exception $e) {
            return "Database connection failed: " . $e->getMessage();
        }
        
    }
}

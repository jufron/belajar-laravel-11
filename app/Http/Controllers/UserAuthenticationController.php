<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserAuthenticationController extends Controller
{
    public function index () : View
    {
        return view('dashboard');
    }

    public function register () : string
    {
        $user = User::factory()->create();

        UserRegistered::dispatch($user);

        return response()->json([
            'message' => 'success',
            'data' => [
                'user-create' => $user,
            ],
        ], 201);
    }
}

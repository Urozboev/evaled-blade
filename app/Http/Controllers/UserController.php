<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getOrCreateUser(Request $request)
    {
        $sessionId = $request->session()->get('user_session_id');
        
        if (!$sessionId) {
            $sessionId = Str::uuid()->toString();
            $request->session()->put('user_session_id', $sessionId);
            
            $user = User::create([
                'session_id' => $sessionId,
            ]);
        } else {
            $user = User::where('session_id', $sessionId)->first();
            
            if (!$user) {
                $user = User::create([
                    'session_id' => $sessionId,
                ]);
            }
        }
        
        return $user;
    }
    
    public function updateProfile(Request $request)
    {
        $user = $this->getOrCreateUser($request);
        
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'full_name' => 'required|string|max:255',
        ]);
        
        $user->update([
            'email' => $request->email,
            'full_name' => $request->full_name,
            'email_verified_at' => now(),
        ]);
        
        return response()->json(['success' => true]);
    }
}
<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    
    public function create(){
        return view('login.create');
    }

    public function store(Request $request){
        $data = $request->except(['_token']);
        $data['password'] = password_hash( $data['password'],PASSWORD_DEFAULT);

        $user = User::create($data);
        Auth::login($user);

        return redirect()->route('series.index');
    }

    public function destroy(){
        Auth::logout();

        return redirect()->route('login');
    }
}

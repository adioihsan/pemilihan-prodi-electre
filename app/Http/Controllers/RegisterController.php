<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;


class RegisterController extends Controller
{
    public function create()
    {
        $list_jurusan = Jurusan::select('id','nama','kode')->get();
        return view('register.create',compact('list_jurusan'));
    }

    public function store(){

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
        ]);

        $user = User::create($attributes);
        auth()->login($user);
        
        return redirect('/dashboard');
    } 
}

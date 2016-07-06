<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function me(Auth $auth)
    {
        return $auth->user();
    }

    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'sex' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[\d\(\)\-#]+$/',
            'address' => 'required',
        ]);

        $user = User::create($request->all());

        return [
            'id' => $user->id,
        ];
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'email' => 'sometimes|email',
            'phone' => 'sometimes|regex:/^[\d\(\)\-#]+$/',
        ]);

        User::findOrFail($id)->update($request->all());

        return [
            'success' => true
        ];
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return [
            'success' => true
        ];
    }
}

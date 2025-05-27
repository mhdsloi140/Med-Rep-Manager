<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashbordLoginRequest;
use App\Services\AuthSevice;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected AuthSevice $authSevice)
    {

    }
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DashbordLoginRequest $request)
    {

        $data = $request->afterValidation();
         if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->back()->with(['error' => 'Incorrect Password Or Email.']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id=null)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

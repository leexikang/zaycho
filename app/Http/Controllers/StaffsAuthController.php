<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Staff;
use Validator;

class StaffsAuthController extends Controller
{

    public function getLogin(){
        return view("staff.auth.login");
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        $this->validate($request, [
            'email' =>'required',
            'password' => 'required', 'exists:staffs,email,password,$email,$password'
        ]);

        $staff =  Staff::where([
            ['email', '=', $request->email],
            ['password', '=', $request->password]
        ])->first();

        
        if( empty($staff) ){
            //$request->session()->flash('loginError', '');
            return back()
                ->with('fail', 'Username and password are not match')
                ->withInput();
        }

        $request->session()->put('admin', $staff);
        return redirect('/staff');
    }

    public function logout(Request $request)
    {
        $request->session()->pull('admin');
        return redirect('/staff/login');
    }

}

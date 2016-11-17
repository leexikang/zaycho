<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
class UsersController extends Controller
{
    //
    /**
     * undocumented function
     *
     * @return void
     */
    /**
     * undocumented function
     *
     * @return void
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('staff.users', ['users' => $users]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);

    }
     public function update(Request $request, $id)
     {
         $user = User::find($id);
         $user->name = $request->name;
         $user->address = $request->address;
         $user->save();
         return redirect('staff/users');
     }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back();
    }
    
    public function showOrders(Request $request)
    {
        //show all orders
    }

   
}

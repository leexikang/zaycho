<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Delivery;

class DeliveriesController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function ship(Request $request, $id)
    {
        $delivery = Delivery::find($id);
        $delivery->ship = 1;
        $delivery->save();
        return redirect()->back();
    }

     public function arrive(Request $request, $id)
    {
        $delivery = Delivery::find($id);
        $delivery->arrive= 1;
        $delivery->arrival_date = date("Y-m-d H:i:s");
        $delivery->save();
        return redirect()->back();
    }
    
}

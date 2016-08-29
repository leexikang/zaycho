<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PaymentsController extends Controller
{
    /**
     * Give payment inofrmation
     *
     * @return void
     */
    public function purchase()
    {
        // user inforamtion 
        $account = ["number" => "121312",
            "phone" => "01-333312",
            "address" => "15 street Yangon"
        ];
        return view("payments.purchase", $account);
    }
    
}

<?php

namespace App\Http\Controllers;

use Stripe\{Charge, Customer};

class PurchasesController extends Controller
{
    
    public function store()
    {

    	$token  = request()->stripeToken;

		  //set on registration
		  $customer = Customer::create([
		      'email' => request('stripeEmail'),
		      'source'  => request('stripeToken')
		  ]);
		  //actual charge from db
		  $charge = Charge::create([
		      'customer' => $customer->id,
		      'amount'   => 5000,
		      'currency' => 'gbp'
		  ]);

		  return 'all done';
    }
}

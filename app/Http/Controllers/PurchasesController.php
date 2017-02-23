<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Customer;
use App\Product;

class PurchasesController extends Controller
{
    public function store()
    {
        // manually refetch product and price
        $product = Product::findOrFail(request('product'));

		//set on registration
		$customer = Customer::create([
		  'email' => request('stripeEmail'),
		  'source'  => request('stripeToken')
		]);
		//actual charge from db
		$charge = Charge::create([
		  'customer' => $customer->id,
		  'amount'   => $product->price,
		  'currency' => 'gbp'
		]);

        return 'all done';
    }
}

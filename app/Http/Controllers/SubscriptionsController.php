<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe\Charge;
use Stripe\Customer;
use App\Plan;

class SubscriptionsController extends Controller
{
    public function store()
    {
        // manually refetch plan and price
        $plan = Plan::findOrFail(request('plan'));

		//set on registration
		$customer = Customer::create([
		  'email' => request('stripeEmail'),
		  'source'  => request('stripeToken'),
		  'plan' => $plan->name
		]);

        return 'all done';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Exception;
use App\Http\Requests\Subscription;

class SubscriptionsController extends Controller
{
    public function store(Subscription $subscription)
    {
        try {
            $subscription->save();
        } catch (Exception $e) {
            return response()->json(
                ['status' => $e->getMessage()], 422
                );
        }
        
        // request()->user()->update([
        // 	'stripe_id' => $customer->id,
        // 	'stripe_active' => true
        // ]);

        

        return [
            'status' => 'Success!'
        ];
    }
}

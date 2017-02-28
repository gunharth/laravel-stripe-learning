<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Plan;
use App\User;

class Subscription extends FormRequest
{
    
    protected $user;

    public function _construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !! $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stripeEmail' => 'required|email',
            'stripeToken' => 'required',
            'plan' => 'required'
        ];
    }

    public function save()
    {
        $plan = Plan::findOrFail($this->plan);

        $this->user()
            ->subscription()
            ->create($plan, $this->stripeToken);

        
    }
}

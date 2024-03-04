<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('plans', compact('plans'));
    }
    public function show($slug)
    {

        $plan = Plan::where('slug', $slug)->first();
        $user = Auth::user();
        $intent = $user->createSetupIntent();
        return view('subscriptions', compact('plan', 'intent'));

        // $user->newSubscription('main', $plan->stripe_plan)->create($user->stripe_id);
        // return redirect()->route('plans.index')->with('success', 'You have successfully subscribed to the plan');
    }

    public function subs(Request $request)
    {
    

        $user = Auth::user();


        $user->newSubscription('silver', 'price_1OnZojSAA073ItmlcLfVd9g9')->create($request->stripeToken);

        return redirect()->route('plans.index')->with('success', 'You have successfully subscribed to the plan');
            }
    
}

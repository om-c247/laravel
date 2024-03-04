<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\Auth;


class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'stripe_plan', 'price', 'description'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    // public function show(Plan $plan, Request $request)
    // {
    //     $intent = auth()->user()->createSetupIntent();
    //     return view('subscriptions', compact('plan','intent'));
    // }
}

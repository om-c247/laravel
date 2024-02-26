<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Plans</title>
    <link rel="stylesheet" href="{{ asset('css/plans.css') }}"> <!-- Include CSS file -->
</head>
<body>
    <div class="container">
        <h1>Subscription Plans</h1>
        <div class="plans">
            @foreach ($plans as $plan)
                <div class="plan">
                    <div class="plan-header {{ strtolower($plan->name) }}">
                        <h2>{{ $plan->name }}</h2>
                        <p>${{ $plan->price }}/month</p>
                    </div>
                    <ul class="plan-features">
                        <!-- Example features -->
                        <li>Feature 1</li>
                        <li>Feature 2</li>
                        <li>Feature 3</li>
                        <!-- Add more features as needed -->
                    </ul>
                    <a href="{{ route('plans.show',$plan->slug) }}"><button>Subscribe</button></a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

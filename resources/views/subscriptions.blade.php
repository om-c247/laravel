<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Form</title>
    <script src="https://js.stripe.com/v3/"></script> <!-- Include Stripe.js -->
    <script src="{{ asset('js/subscription.js') }}" defer></script> <!-- Include custom JavaScript -->
</head>
<body>
    <div class="container">
        <h1>Subscribe to our service</h1>
        <form id="subscription-form" method="post" action="{{ route('plans.subs') }}">
            @csrf
            <div class="form-group">
                <label for="card-holder-name">Cardholder Name</label>
                <input type="text" id="card-holder-name" name="card-holder-name">
            </div>
            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element"></div>
                <div id="card-errors" role="alert"></div>
            </div>
            <button id="submit-button" type="submit">Subscribe</button>
        </form>
    </div>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var stripe = Stripe('pk_test_51OnZcKSAA073ItmlIo7hdcWBnpDHQyF1UNvIhbHLKwNVNzxNUszZI9jtQQvmSvQI2pZsxkYNdZhIYz06Ve1i7yGB00cHqHThtT'); // Replace with your Stripe public key
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    var cardHolderName = document.getElementById('card-holder-name');
    var form = document.getElementById('subscription-form');
    var cardButton = document.getElementById('submit-button');
    var cardErrors = document.getElementById('card-errors');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        cardButton.disabled = true;
        stripe.createToken(cardElement, {
            name: cardHolderName.value
        }).then(function(result) {
            if (result.error) {
                cardErrors.textContent = result.error.message;
                cardButton.disabled = false;
            } else {
                stripeTokenHandler(result.token);
            }
        });
        stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: cardHolderName.value
            }
        }).then(function(result) {
            if (result.error) {
                cardErrors.textContent = result.error.message;
                cardButton.disabled = false;
            } else {
                // Payment method created successfully
                // You can handle the result here (e.g., save the payment method ID)
                console.log(result.paymentMethod);
                var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method_id');
        hiddenInput.setAttribute('value', result.paymentMethod.id);
        form.appendChild(hiddenInput);
               // alert(JSON.stringify(paymentMethod));
                // Optionally, submit the form to your server for further processing
                form.submit();
            }
        });
    });




    
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        
        // Submit the form
       // form.submit();
    }
});

</script>
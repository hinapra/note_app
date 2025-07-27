<!DOCTYPE html>
<html>
<head>
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <button id="rzp-button">Pay ₹500</button>

    <form action="{{ route('payment') }}" method="POST" id="razorpay-form">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    </form>

    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": "50000", // in paise (500 INR)
            "currency": "INR",
            "name": "Notes App",
            "description": "Test Payment",
            "handler": function (response) {
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay-form').submit();
            },
            "prefill": {
                "name": "User",
                "email": "user@example.com"
            },
            "theme": {
                "color": "#0077cc"
            }
        };

        var rzp = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e) {
            rzp.open();
            e.preventDefault();
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'stripeKey' => config('services.stripe.key')
            ]) !!};
        </script>

    </head>
    <body>
        <div id="app">
            <div class="container">
               {{--  <div class="row">
                    <checkout-form :products="{{ $products }}"></checkout-form>
                </div> --}}
                 <div class="row">
                    <subscription-form :plans="{{ $plans }}"></subscription-form>
                </div>
            </div>
        </div>
        <script src="https://checkout.stripe.com/checkout.js"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>

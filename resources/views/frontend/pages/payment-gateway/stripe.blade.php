<div class="tab-pane fade show" id="v-pills-stripe" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.stripe.payment') }}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="stripe_token" id="stripe-token-id">
                    <div id="card-element" class="form-control" style="padding: 20px !important;"></div><br>
                    <button type="button" class="nav-link common_btn" id="pay-btn" onclick="createToken()">Pay With Stripe</button>
                </form>
            </div>
        </div>
    </div>
</div>

@php
    $stripeSetting = \App\Models\StripeSetting::first();
@endphp

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe("{{ $stripeSetting->client_id }}");
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        function createToken() {
            document.getElementById("pay-btn").disabled = true;
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    document.getElementById("pay-btn").disabled = false;
                    toastr.error(result.error.message);
                } else if (result.token) {
                    document.getElementById("stripe-token-id").value = result.token.id;
                    document.getElementById('checkout-form').submit();
                }
            });
        }
    </script>
@endpush

<div class="tab-pane fade" id="v-pills-stripe" role="tabpanel" aria-labelledby="v-pills-stripe-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form id="pay-stripe-form" action="{{ route('user.payment.stripe') }}" method="POST">
                    @csrf
                    <input type="hidden" name="stripe_token" id="token-stripe-id">
                    <div id="card-element" class="form-control mb-4 p-4"></div>
                    <button class="nav-link common_btn" id="pay-stripe-btn" onclick="createToken()" type="button">Thanh
                        toán
                        Stripe</button>
                </form>
            </div>
        </div>
    </div>
</div>

@php
    $stripe_setting = \App\Models\StripeSetting::first();
@endphp

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var stripe = Stripe("{{ $stripe_setting->client_id }}");
        var elements = stripe.elements();

        // create card element
        var card_element = elements.create('card');
        card_element.mount('#card-element');

        function createToken() {
            // disable pay stripe button
            document.getElementById('pay-stripe-btn').disable = true;

            // create token
            stripe.createToken(card_element).then(function(result) {
                // alert error message
                if (typeof result.error !== 'undefined') {
                    document.getElementById('pay-stripe-btn').disable = false;
                    alert(result.error.message);
                }

                // create token successfully
                if (typeof result.token !== 'undefined') {
                    document.getElementById('token-stripe-id').value = result.token.id;
                    document.getElementById('pay-stripe-form').submit();
                }
            })
        }
    </script>
@endpush

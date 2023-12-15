<div class="tab-pane fade" id="v-pills-zalopay" role="tabpanel" aria-labelledby="v-pills-zalopay-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.payment.zalopay') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link common_btn text-center" name="redirect">Thanh
                        toán ZaloPay</button>
                </form>
            </div>
        </div>
    </div>
</div>

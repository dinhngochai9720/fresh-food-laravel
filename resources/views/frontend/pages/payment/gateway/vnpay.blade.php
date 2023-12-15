<div class="tab-pane fade" id="v-pills-vnpay" role="tabpanel" aria-labelledby="v-pills-vnpay-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.payment.vnpay') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link common_btn text-center" name="redirect">Thanh
                        toán VNPay</button>
                </form>
            </div>
        </div>
    </div>
</div>

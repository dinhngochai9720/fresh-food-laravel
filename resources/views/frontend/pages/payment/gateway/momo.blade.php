<div class="tab-pane fade" id="v-pills-momo" role="tabpanel" aria-labelledby="v-pills-momo-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.payment.momo') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link common_btn text-center" name="redirect">Thanh
                        toán MoMo</button>
                </form>
            </div>
        </div>
    </div>
</div>

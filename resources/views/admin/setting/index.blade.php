 @extends('admin.layouts.master')

 @section('title')
     Cài đặt
 @endsection

 @section('content')
     <section class="section">
         <div class="section-header">
             <h1>Cài đặt</h1>
         </div>

         <div class="section-body">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-2">
                                     <div class="list-group" id="list-tab" role="tablist">
                                         <a class="list-group-item list-group-item-action active" id="gerenal-settings"
                                             data-toggle="list" href="#gerenal-setting" role="tab">Cài đặt chung</a>
                                         <a class="list-group-item list-group-item-action" id="paypal-settings"
                                             data-toggle="list" href="#paypal-setting" role="tab">PayPal</a>
                                         <a class="list-group-item list-group-item-action" id="stripe-settings"
                                             data-toggle="list" href="#stripe-setting" role="tab">Stripe</a>
                                         <a class="list-group-item list-group-item-action" id="vnpay-settings"
                                             data-toggle="list" href="#vnpay-setting" role="tab">VNPay</a>
                                         <a class="list-group-item list-group-item-action" id="email-configs"
                                             data-toggle="list" href="#email-config" role="tab">Mailtrap</a>
                                         <a class="list-group-item list-group-item-action" id="pusher-settings"
                                             data-toggle="list" href="#pusher-setting" role="tab">Pusher</a>
                                     </div>
                                 </div>
                                 <div class="col-10">
                                     <div class="tab-content" id="nav-tabContent">
                                         @include('admin.setting.general-setting')
                                         @include('admin.setting.payment.paypal-setting')
                                         @include('admin.setting.payment.stripe-setting')
                                         @include('admin.setting.payment.vnpay-setting')
                                         @include('admin.setting.email-config')
                                         @include('admin.setting.pusher-setting')
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 @endsection

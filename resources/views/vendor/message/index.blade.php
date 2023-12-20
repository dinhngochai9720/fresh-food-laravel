@extends('vendor.layouts.master')

@section('title')
    Chat
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3>Chat</h3>
                        <div class="wsus__dashboard_review">
                            <div class="row">
                                <div class="col-xl-4 col-md-5">
                                    <div class="wsus__chatlist d-flex align-items-start">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <h2>Đoạn chat</h2>
                                            <div class="wsus__chatlist_body">
                                                @foreach ($senders_info as $sender)
                                                    @php
                                                        // check user seen message or not
                                                        $unseen_messages = \App\Models\Message::where(['sender_id' => $sender->senderProfile->id, 'receiver_id' => auth()->user()->id, 'seen' => 0])->exists();
                                                    @endphp

                                                    <button class="nav-link chat-sender-profile"
                                                        data-id="{{ $sender->senderProfile->id }}" id="seller-list-6"
                                                        data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button"
                                                        role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                        <div
                                                            class="wsus_chat_list_img {{ $unseen_messages ? 'msg-notification' : '' }}">
                                                            <img src="{{ $sender->senderProfile->image ? asset($sender->senderProfile->image) : asset('frontend/images/default-image.png') }}"
                                                                alt="user" class="img-fluid">
                                                            <span class="pending d-none" id="pending-6">0</span>
                                                        </div>
                                                        <div class="wsus_chat_list_text">
                                                            <h4>{{ $sender->senderProfile->name }}</h4>
                                                        </div>
                                                    </button>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-7">
                                    <div class="wsus__chat_main_area" style="position: relative">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show" id="v-pills-home" role="tabpanel"
                                                aria-labelledby="v-pills-home-tab">
                                                <div id="chat_box">
                                                    <div class="wsus__chat_area"
                                                        style="position: absolute; height: 100%; width: 100%;">
                                                        <div class="wsus__chat_area_header">
                                                            <h2 id="name_sender"></h2>
                                                        </div>
                                                        <div class="wsus__chat_area_body chat_body_dashboard_vendor"
                                                            data-inbox="">
                                                            {{-- <div class="wsus__chat_single">
                                                                <div class="wsus__chat_single_img">
                                                                    <img src="http://127.0.0.1:8000/uploads/custom-images/daniel-paul-2022-08-15-01-16-48-4881.png"
                                                                        alt="user" class="img-fluid">
                                                                </div>
                                                                <div class="wsus__chat_single_text">
                                                                    <p>Welcome to Shop name 2!

                                                                        Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book.</p>
                                                                    <span>15 August, 2022, 12:56 PM</span>
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="wsus__chat_single single_chat_2">
                                                                <div class="wsus__chat_single_img">
                                                                    <img src="http://127.0.0.1:8000/uploads/custom-images/john-doe-2022-08-15-01-14-20-3892.png"
                                                                        alt="user" class="img-fluid">
                                                                </div>
                                                                <div class="wsus__chat_single_text">
                                                                    <p>Hello Paul</p>
                                                                    <span>15 August, 2022, 12:57 PM</span>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <div class="wsus__chat_area_footer"
                                                            style="margin-top: 50px; position: absolute; bottom: 0; width: 100%;">
                                                            <form class="message_form_dashboard_vendor">
                                                                @csrf
                                                                <input class="message_input" type="text" placeholder="Aa"
                                                                    id="message" name="message" autocomplete="off">

                                                                <input type="hidden" name="receiver_id" id="receiver_id"
                                                                    value="">


                                                                <button type="submit"><i class="fas fa-paper-plane"
                                                                        aria-hidden="true"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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


@push('scripts')
    <script>
        const chat_are_body = $('.chat_body_dashboard_vendor');

        function formatDateTime(dateTimeString) {
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
            }

            const formatDateTime = new Intl.DateTimeFormat('vi', options).format(new Date(dateTimeString));
            return formatDateTime;
        }

        function autoScrollToBottom() {
            chat_are_body.scrollTop(chat_are_body.prop('scrollHeight'));
        }

        $(document).ready(function() {
            $('.chat-sender-profile').on('click', function() {
                let sender_id = $(this).data('id');

                let name_sender = $(this).find('h4').text();

                var receiverImage = $(this).find('img').attr('src');

                $('#receiver_id').val(sender_id);

                chat_are_body.attr('data-inbox', sender_id);

                $(this).find(".wsus_chat_list_img").removeClass("msg-notification");

                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.get-message') }}",
                    data: {
                        sender_id: sender_id,
                    },
                    beforeSend: function() {
                        // refresh chat content after choose new sender
                        chat_are_body.html('');

                        $('#name_sender').text(`${name_sender}`);
                    },
                    success: function(response) {
                        // console.log(response);
                        $.each(response, function(index, value) {
                            // message of sender is show right
                            if (value.sender_id == USER.id) {
                                var message = `<div class="wsus__chat_single single_chat_2">
                                                <div class="wsus__chat_single_img">
                                                    <img src="${USER.banner}"
                                                        alt="user" class="img-fluid">
                                                </div>
                                                <div class="wsus__chat_single_text">
                                                    <p>${value.message}</p>
                                                    <span>${formatDateTime(value.created_at)}</span>
                                                </div>
                                            </div>`;
                            }
                            // message of reicever is show left
                            else {
                                var message = `<div class="wsus__chat_single">
                                            <div class="wsus__chat_single_img">
                                                <img src="${receiverImage}"
                                                    alt="user" class="img-fluid">
                                            </div>
                                            <div class="wsus__chat_single_text">
                                                <p>${value.message}</p>
                                                <span>${formatDateTime(value.created_at)}</span>
                                            </div>
                                        </div>`;
                            }

                            chat_are_body.append(message);
                        })

                        // auto scroll to bottom
                        autoScrollToBottom()
                    },
                    error: function(data) {}

                })
            })

            $('.message_form_dashboard_vendor').on('submit', function(e) {
                e.preventDefault();

                let form_data = $(this).serialize();
                let message_data = $('.message_input').val();

                var formSubmitting = false;
                // do not show message and do not save DB if input is empty
                if (formSubmitting || message_data === "") {
                    return;
                }

                // set message in inbox
                let message = `<div class="wsus__chat_single single_chat_2">
                                        <div class="wsus__chat_single_img">
                                            <img src="${USER.banner}"
                                                alt="avatar_image" class="img-fluid">
                                        </div>
                                        <div class="wsus__chat_single_text">
                                            <p>${message_data}</p>
                                            <span></span>
                                        </div>
                                    </div>`;
                chat_are_body.append(message);

                // refresh message input after send successfully
                $('.message_input').val('');

                // auto scroll to bottom
                autoScrollToBottom()


                $.ajax({
                    method: 'POST',
                    url: "{{ route('vendor.send-message') }}",
                    data: form_data,
                    beforeSend: function() {
                        formSubmitting = true;
                    },
                    success: function(data) {

                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                        formSubmitting = false;
                    },
                    complete: function() {
                        formSubmitting = false;
                    }
                })
            })
        })
    </script>
@endpush

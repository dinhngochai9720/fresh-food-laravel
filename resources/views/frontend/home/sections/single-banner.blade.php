@if ($home_page_banner_two->banner_one->status_one == 0 && $home_page_banner_two->banner_two->status_two == 0)
@else
    <section id="wsus__single_banner" class="wsus__single_banner_2">
        <div class="container">
            <div class="row">
                @if ($home_page_banner_two->banner_one->status_one == 1)
                    <div class="col-xl-6 col-lg-6">
                        <div class="wsus__single_banner_content">
                            <div class="wsus__single_banner_img">
                                <a href="{{ $home_page_banner_two->banner_one->url_one }}">
                                    <img src="{{ asset($home_page_banner_two->banner_one->image_one) }}" alt="banner"
                                        class="img-fluid w-100">
                                </a>

                            </div>
                        </div>
                    </div>
                @else
                @endif

                @if ($home_page_banner_two->banner_two->status_two == 1)
                    <div class="col-xl-6 col-lg-6">
                        <div class="wsus__single_banner_content single_banner_2">
                            <div class="wsus__single_banner_img">
                                <a href="{{ $home_page_banner_two->banner_two->url_two }}">
                                    <img src="{{ asset($home_page_banner_two->banner_two->image_two) }}" alt="banner"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                @endif
            </div>
        </div>
    </section>
@endif

@if ($home_page_banner_four->banner_one->status == 0)
@else
    <section id="wsus__large_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <a href="{{ $home_page_banner_four->banner_one->url }}">
                        <img src="{{ asset($home_page_banner_four->banner_one->image) }}" alt="img"
                            class="img-fluid w-100">
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif

@extends('layouts.apphome')

@section('title', $seodata['MetaTitle'])
@section('description', $seodata['MetaDescription'])
@section('keywords', $seodata['Keyword'])

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="">
                @foreach ($breadcrumbs as $breadcrumb)
                    <a href="{{ url($breadcrumb->link) }}" class="tg-review-tag">{{ $breadcrumb->title }}</a>{{ $breadcrumb->separetor }}
                @endforeach
                <h1 class="tg-review-title">{{ $record->Name }}</h1>
                <div class="tg-metadata-wrap">
                    <div class="tg-article-date">
                        Published: <b>{{ date('F j, Y', strtotime($record->PublishDate)) }}</b>
                        <div class="tg-article-date">Views: <b>{{ $record->views }}</b></div>
                    </div>
                    <div class="tg-meta-links">
                        <span class="tg-author">By <a href="{{ url('author/' . $record->Author) }}">{{ $record->Author }}</a></span> |
                        <span class="tg-share">
                            <i class="fa fa-share-alt" onclick="copyURL(event)"></i>
                            <span class="copied-message" style="display: none;">Copied!</span>
                            <a class="tg-fb" href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="tg-tw" href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                            <a class="tg-wa" href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Image Carousel -->
            <div id="carousel-thumbnail" class="carousel slide article-slider" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($images as $i_key => $i_value)
                        @php
                            $imageName = preg_replace('/_/', ' ', pathinfo($i_value->ImagePath, PATHINFO_FILENAME));
                            $altText = ucwords(trim(preg_replace('/\bNews\b/i', '', $imageName)));
                            $altText = substr($altText, 0, -10);
                        @endphp
                        <div class="carousel-item {{ !$i_key ? 'active' : '' }}">
                            <img src="{{ asset($i_value->ImagePath) }}" class="d-block w-100" alt="{{ $altText }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-thumbnail" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-thumbnail" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <div class="carousel-indicators">
                    @foreach($images as $i_key_t => $i_val_t)
                        @php
                            $imageName = preg_replace('/_/', ' ', pathinfo(($i_val_t->ImagePath) ? $i_val_t->ImagePath : $i_val_t->SliderImage, PATHINFO_FILENAME));
                            $altText = ucwords(trim(preg_replace('/\bNewsthumb\b/i', '', $imageName)));
                            $altText = substr($altText, 0, -10);
                        @endphp
                        <button type="button" data-bs-target="#carousel-thumbnail" data-bs-slide-to="{{ $i_key_t }}" class="thumbnail {{ !$i_key_t ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $i_key_t+1 }}">
                            <img src="{{ asset(($i_val_t->ImagePath) ? $i_val_t->ImagePath : $i_val_t->SliderImage) }}" class="d-block w-100" alt="{{ $altText }}">
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tg-review-body">
    <div id="kj-roadblock">
  <ins class="adnm-tag"
       style="display:inline-block;width:100%;height:300px;"
       data-adnm-cc="cac57449-4c04-4846-989e-47e598ffcd49"
       data-adnm-session="${CACHEBUSTER}"
       data-adnm-click="${CLICK_URL}"
       data-adnm-type="canvasmobile"
       ... >
     <script async src="https://macro.adnami.io/macro/gen/adnm.ads.v2.js"></script>
  </ins>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {!! $record->Description !!}
                <!-- Latest magazine banner and YT playlist -->
            </div>
            <div class="col-md-4">
                <div class="wrap-ad sticky-top">
                    <a href="https://www.exhibitstore.in/" target="_blank">
                        <img src="https://www.topgearmag.in/uploads/Banners/tgissue-jun2025.webp" width="100%" alt="TopGear Magazine June 2025" />
		    </a>
                    <div style="padding-top: 20px;">
                        <!-- Google Ads code begin -->
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2979269950522014" crossorigin="anonymous"></script>
                        <!-- Topgear vertical ad -->
                        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2979269950522014" data-ad-slot="9681431780" data-ad-format="auto" data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        <!-- Google Ads code end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('scripts')
    <script src="{{ asset('assets/js/socialshare.js') }}"></script>
@endsection

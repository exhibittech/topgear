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
                <h1 class="tg-review-title">{{ $record->ReviewsTitle }}</h1>
                <div class="tg-metadata-wrap">
                    <div class="tg-article-date">
                        Published: <b>{{ date('F j, Y', strtotime($record->PublishDate)) }}</b>
                        <div class="tg-article-date">Views: <b>{{ $views }}</b></div>
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

            <div id="carousel-thumbnail" class="carousel slide article-slider" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($images as $i_key => $i_value)
                        @php
                            $imageName = preg_replace('/_/', ' ', pathinfo($i_value->ImagePath, PATHINFO_FILENAME));
                            $altText = ucwords(trim(preg_replace('/\bReviews\b/i', '', $imageName)));
                            $altText = substr($altText, 0, -10);
                        @endphp
                        <div class="carousel-item {{ !$i_key ? 'active' : '' }}">
                            <img src="{{ url($i_value->ImagePath) }}" class="d-block w-100" alt="{{ $altText }}">
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

<div class="tgrev-tab">
    <nav class="navbar-expand-lg">
        <div class="container">
            <ul class="navbar-nav" id="reviewTabs">
                @foreach ($tabs as $tab)
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedTab && $selectedTab->TabID == $tab->TabID ? 'tg-k' : '' }}" href="#tab-content-{{ $tab->TabID }}" data-tab-content="{{ $tab->TabID }}">
                            {{ $tab->Name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</div>

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
    @foreach ($tabContents as $content)
        <div class="tab-content" id="tab-content-{{ $content->TabID }}" style="{{ $content->TabID == $selectedTab->TabID ? '' : 'display: none;' }}">
    
            {!! $content->Content !!}
        </div>
    @endforeach
	</div>
	<div class="col-md-4">
                <div class="wrap-ad sticky-top">
		    <a href="https://www.exhibitstore.in/" target="_blank">
                        <img src="https://www.topgearmag.in/uploads/Banners/tgissue-jun2025.webp" width="100%" alt="TopGear Magazine June 2025" />
                    </a>                </div>
	</div>	
</div>
</div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabLinks = document.querySelectorAll('#reviewTabs .nav-link');
        const tabContents = document.querySelectorAll('.tab-content');

        tabLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                const target = this.getAttribute('data-tab-content');

                tabContents.forEach(content => {
                    content.style.display = content.id === 'tab-content-' + target ? 'block' : 'none';
                });

                tabLinks.forEach(link => link.classList.remove('tg-k'));
                this.classList.add('tg-k');
            });
        });
    });
</script>
@endsection


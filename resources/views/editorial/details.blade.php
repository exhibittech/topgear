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
                    @php
                        $imageName = preg_replace('/_/', ' ', pathinfo($record->ImagePath, PATHINFO_FILENAME));
                        $altText = ucwords(trim(preg_replace('/\bEditorial\b/i', '', $imageName)));
                        $altText = substr($altText, 0, -10);
                    @endphp
                    <div class="carousel-item active">
                        <img src="{{ asset($record->ImagePath) }}" class="d-block w-100" alt="{{ $altText }}">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-thumbnail" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-thumbnail" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="tg-review-body">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {!! $record->Description !!}
                <!-- Latest magazine banner and YT playlist -->
            </div>
            <div class="col-md-4">
                <div class="wrap-ad sticky-top">
                    <a href="https://www.exhibitstore.in/" target="_blank">
                            <img src="https://www.topgearmag.in/uploads/Banners/tgissue-annual2026.jpg" width="100%"
                                alt="TopGear Magazine Annual Issue 2026" />
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

<section class="tg-rel-reviews">
    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="tg-rel-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Related Articles</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="tg-rel-tab">
                <div class="container">
                    <div class="row">
                        @foreach($relatedArticles as $related)
                            <div class="col-md-4">
                                <div class="tgrelated-article">
                                    <div class="tg-media">
                                        <a href="{{ url('editorial/' . $related->Code) }}">
                                            <img src="{{ url($related->ImagePath) }}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="tg-reltxt">
                                        <p class="tg-review-title">
                                            <a href="{{ url('editorial/' . $related->Code) }}">
                                                {{ ucwords(strtolower(Str::limit($related->Name, 30))) }}
                                            </a>
                                        </p>
                                        <span class="tg-author"><a href="{{ url('author/' . $related->Author) }}" class="tg-review-tag">{{ $related->Author }}</a></span> -
                                        <span class="tg-article-date">{{ date('F j, Y', strtotime($related->PublishDate)) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

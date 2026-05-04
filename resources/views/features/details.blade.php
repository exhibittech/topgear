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
                        <a href="{{ url($breadcrumb->link) }}"
                            class="tg-review-tag">{{ $breadcrumb->title }}</a>{{ $breadcrumb->separetor }}
                    @endforeach
                    <h1 class="tg-review-title">{{ $record->Name }}</h1>
                    <div class="tg-metadata-wrap">
                        <div class="tg-article-date">
                            Published: <b>{{ date('F j, Y', strtotime($record->PublishDate)) }}</b>
                            <div class="tg-article-date">Views: <b>{{ $record->views }}</b></div>
                        </div>
                        <div class="tg-meta-links">
                            <span class="tg-author">By <a
                                    href="{{ url('author/' . $record->Author) }}">{{ $record->Author }}</a></span> |
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

                <!-- Two Column Layout: Slider Left, Ads Right -->
                <div class="row">
                    <!-- Slider Column (Left) -->
                    <div class="col-md-9">
                        <div id="carousel-thumbnail" class="carousel slide article-slider" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($images as $i_key => $i_value)
                                    @php
                                        $imageName = preg_replace('/_/', ' ', pathinfo($i_value->ImagePath, PATHINFO_FILENAME));
                                        $altText = ucwords(trim(preg_replace('/\bNews\b/i', '', $imageName)));
                                        $altText = substr($altText, 0, -10);
                                    @endphp
                                    <div class="carousel-item {{ !$i_key ? 'active' : '' }}">
                                        @php
                                            $imageRelativePath = $i_value->ImagePath;
                                            $webpRelativePath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $imageRelativePath);
                                            $webpAvailable = $webpRelativePath !== $imageRelativePath && file_exists(public_path($webpRelativePath));
                                        @endphp
                                        <picture>
                                            @if ($webpAvailable)
                                                <source type="image/webp" srcset="{{ asset($webpRelativePath) }}">
                                            @endif
                                            <img src="{{ asset($imageRelativePath) }}" class="d-block w-100"
                                                alt="{{ $altText }}" loading="lazy">
                                        </picture>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-thumbnail"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-thumbnail"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                            <!-- Scrollable Thumbnail Navigation -->
                            <div class="thumbnail-navigation-wrapper">
                                <button type="button" class="thumbnail-nav-btn thumbnail-nav-prev" id="thumbnailPrev"
                                    aria-label="Previous thumbnails">
                                    <i class="fas fa-chevron-left"></i>
                                </button>

                                <div class="carousel-indicators-scrollable" id="thumbnailScroll">
                                    @foreach($images as $index => $imageItem)
                                        @php
                                            $imageName = preg_replace('/_/', ' ', pathinfo($imageItem->ImagePath, PATHINFO_FILENAME));
                                            $altText = ucwords(trim(preg_replace('/\bNews\b/i', '', $imageName)));
                                            $altText = substr($altText, 0, -10);
                                        @endphp
                                        <button type="button" data-bs-target="#carousel-thumbnail"
                                            data-bs-slide-to="{{ $index }}" class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                            aria-label="Slide {{ $index + 1 }}">
                                            @php
                                                $thumbRelativePath = $imageItem->ImagePath;
                                                $thumbWebpRelativePath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $thumbRelativePath);
                                                $thumbWebpAvailable = $thumbWebpRelativePath !== $thumbRelativePath && file_exists(public_path($thumbWebpRelativePath));
                                            @endphp
                                            <picture>
                                                @if ($thumbWebpAvailable)
                                                    <source type="image/webp" srcset="{{ asset($thumbWebpRelativePath) }}">
                                                @endif
                                                <img src="{{ asset($thumbRelativePath) }}" class="d-block w-100"
                                                    alt="{{ $altText }}" loading="lazy">
                                            </picture>
                                        </button>
                                    @endforeach
                                </div>

                                <button type="button" class="thumbnail-nav-btn thumbnail-nav-next" id="thumbnailNext"
                                    aria-label="Next thumbnails">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Ads Column (Right) -->
                    <div class="col-md-3">
                        <div class="wrap-ad-sidebar">
                            <!-- Google AdSense Ad Unit 1 -->
                            <div class="ad-unit" style="margin-bottom: 15px;">
                                <script async
                                    src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2979269950522014"
                                    crossorigin="anonymous"></script>
                                <ins class="adsbygoogle" style="display:block;" data-ad-client="ca-pub-2979269950522014"
                                    data-ad-slot="9681431780" data-ad-format="auto" data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </div>
                        </div>
                    </div>
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
                            <img src="https://www.topgearmag.in/uploads/Banners/tgissue-may2026.jpg" width="100%"
                                alt="TopGear Magazine May 2026" />
                        </a>
                        <div style="padding-top: 20px;">
                            <!-- Google Ads code begin -->
                            <script async
                                src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2979269950522014"
                                crossorigin="anonymous"></script>
                            <!-- Topgear vertical ad -->
                            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2979269950522014"
                                data-ad-slot="9681431780" data-ad-format="auto" data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            <!-- Google Ads code end -->
                        </div>
                    </div>
    </section>



    <style>
        /* Scrollable Thumbnail Navigation Styling */
        .thumbnail-navigation-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            margin-top: 20px;
            gap: 12px;
            padding: 10px 0;
        }

        .carousel-indicators-scrollable {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            overflow-y: hidden;
            scroll-behavior: smooth;
            padding: 8px 4px;
            flex: 1;

            /* Hide scrollbar but keep functionality */
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
        }

        .carousel-indicators-scrollable::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        .carousel-indicators-scrollable .thumbnail {
            position: relative;
            min-width: 100px;
            width: 100px;
            height: 70px;
            margin: 0;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 3px solid transparent;
            background: #f5f5f5;
            padding: 0;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            cursor: pointer;
        }

        .carousel-indicators-scrollable .thumbnail::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
            pointer-events: none;
        }

        .carousel-indicators-scrollable .thumbnail img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .carousel-indicators-scrollable .thumbnail:hover {
            transform: translateY(-4px) scale(1.05);
            border-color: #79d6f2;
            box-shadow: 0 6px 16px rgba(121, 214, 242, 0.4);
        }

        .carousel-indicators-scrollable .thumbnail:hover::before {
            opacity: 1;
        }

        .carousel-indicators-scrollable .thumbnail:hover img {
            transform: scale(1.1);
        }

        .carousel-indicators-scrollable .thumbnail.active {
            border-color: #79d6f2;
            box-shadow: 0 4px 20px rgba(121, 214, 242, 0.6);
            transform: translateY(-2px);
        }

        .carousel-indicators-scrollable .thumbnail.active::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid #79d6f2;
            z-index: 10;
        }

        /* Navigation Buttons */
        .thumbnail-nav-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(121, 214, 242, 0.9) 0%, rgba(121, 214, 242, 0.7) 100%);
            border: none;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
            z-index: 5;
            box-shadow: 0 4px 12px rgba(121, 214, 242, 0.4);
        }

        .thumbnail-nav-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, #79d6f2 0%, #5bc0de 100%);
            transform: scale(1.15);
            box-shadow: 0 6px 20px rgba(121, 214, 242, 0.6);
        }

        .thumbnail-nav-btn:active:not(:disabled) {
            transform: scale(1.05);
        }

        .thumbnail-nav-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            background: linear-gradient(135deg, rgba(150, 150, 150, 0.5) 0%, rgba(120, 120, 120, 0.5) 100%);
            box-shadow: none;
        }

        .thumbnail-nav-btn:disabled:hover {
            transform: none;
        }

        .thumbnail-nav-btn i {
            font-size: 18px;
            font-weight: bold;
        }

        /* Ads Sidebar Styling */
        .wrap-ad-sidebar {
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .wrap-ad-sidebar .ad-unit {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }

        .wrap-ad-sidebar .adsbygoogle {
            max-width: 100%;
            width: 100%;
            overflow: hidden;
            display: block;
        }

        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .carousel-indicators-scrollable .thumbnail {
                min-width: 80px;
                width: 80px;
                height: 60px;
            }

            .thumbnail-nav-btn {
                width: 38px;
                height: 38px;
            }

            .thumbnail-nav-btn i {
                font-size: 14px;
            }

            .wrap-ad-sidebar {
                max-height: none;
                margin-top: 20px;
                max-width: 320px;
                margin-left: auto;
                margin-right: auto;
            }

            .wrap-ad.sticky-top {
                position: static;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Scrollable Thumbnail Navigation
            const thumbnailScroll = document.getElementById('thumbnailScroll');
            const thumbnailPrev = document.getElementById('thumbnailPrev');
            const thumbnailNext = document.getElementById('thumbnailNext');
            const carousel = document.getElementById('carousel-thumbnail');

            if (thumbnailScroll && thumbnailPrev && thumbnailNext) {
                const scrollAmount = 300; // Pixels to scroll per click

                // Scroll thumbnails left
                thumbnailPrev.addEventListener('click', function () {
                    thumbnailScroll.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });

                // Scroll thumbnails right
                thumbnailNext.addEventListener('click', function () {
                    thumbnailScroll.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });

                // Update button states based on scroll position
                function updateScrollButtons() {
                    const maxScroll = thumbnailScroll.scrollWidth - thumbnailScroll.clientWidth;
                    thumbnailPrev.disabled = thumbnailScroll.scrollLeft <= 0;
                    thumbnailNext.disabled = thumbnailScroll.scrollLeft >= maxScroll - 5;
                }

                thumbnailScroll.addEventListener('scroll', updateScrollButtons);
                updateScrollButtons(); // Initial state
            }

            // Sync thumbnails with carousel
            if (carousel && thumbnailScroll) {
                carousel.addEventListener('slide.bs.carousel', function (event) {
                    // Remove active class from all thumbnails
                    const thumbnails = document.querySelectorAll('.carousel-indicators-scrollable .thumbnail');
                    thumbnails.forEach(thumb => thumb.classList.remove('active'));

                    // Add active class to the corresponding thumbnail
                    const activeIndex = event.to;
                    const activeThumbnail = document.querySelector(`.carousel-indicators-scrollable .thumbnail[data-bs-slide-to="${activeIndex}"]`);

                    if (activeThumbnail) {
                        activeThumbnail.classList.add('active');

                        // Auto-scroll to show active thumbnail
                        const containerScrollLeft = thumbnailScroll.scrollLeft;
                        const containerWidth = thumbnailScroll.clientWidth;
                        const thumbnailLeft = activeThumbnail.offsetLeft;
                        const thumbnailWidth = activeThumbnail.offsetWidth;

                        const isOutOfViewLeft = thumbnailLeft < containerScrollLeft;
                        const isOutOfViewRight = (thumbnailLeft + thumbnailWidth) > (containerScrollLeft + containerWidth);

                        if (isOutOfViewLeft || isOutOfViewRight) {
                            const targetScroll = thumbnailLeft - (containerWidth - thumbnailWidth) / 2;
                            thumbnailScroll.scrollTo({
                                left: Math.max(targetScroll, 0),
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            }
        });
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/socialshare.js') }}"></script>
@endsection
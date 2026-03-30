<!-- resources/views/home.blade.php -->
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/popup.css') }}">
@section('content')
    <h1 class="d-none">Car and Bike Reviews, News & Auto Magazine in India</h1>
    @include('partials.banner')

    <!-- <div class="container">
        <div class="my-2 text-center">
            <a href="/winners26">
                <img src="/uploads/Banners/winners26.jpeg" alt="BBC TopGear India Awards 2026" width="100%">
            </a>
        </div>
    </div> -->
    <section class="tg-reviews-latest">
        <div class="container">
            <div class="row">
                <div class="tgsection-title">
                    <h2>LATEST NEWS</h2>
                </div>
                @foreach($homecontent as $news)
                            <?php
                    $imageName = preg_replace('/_/', ' ', pathinfo($news->images->first()->ImagePath ?? $news->ImagePath, PATHINFO_FILENAME));
                    $altText = ucwords(trim(preg_replace('/\bNewsthumb\b/i', '', $imageName)));
                    $altText = substr($altText, 0, -10);
                            ?>
                            <div class="col-lg-4">
                                <div class="kjwrap tg-article-item">
                                    <div class="tg-media">
                                        <a class="d-block" href="{{ url('news/' . $news->category->Code . '/' . $news->Code) }}">
                                            <img src="{{ url($news->ImagePath) }}" alt="{{ $altText }}">
                                        </a>
                                    </div>
                                    <div class="tg-txt">
                                        <a class="tg-review-tag"
                                            href="{{ url($news->menu->PageLink . '/' . $news->category->Code) }}">{{ strtoupper($news->category->Name) }}</a>
                                        <h2 class="tg-review-title"><a
                                                href="{{ url('news/' . $news->category->Code . '/' . $news->Code) }}">{{ substr($news->Name, 0, 65) }}...</a>
                                        </h2>
                                        <span class="tg-tooltip">{{ $news->Name }}</span>
                                        <span class="tg-author"><a
                                                href="{{ url('author/' . $news->Author) }}">{{ $news->Author }}</a></span> -
                                        <span class="tg-article-date">{{ date('F j, Y', strtotime($news->PublishDate)) }}</span>
                                    </div>
                                </div>
                            </div>
                @endforeach
            </div>
            <div class="mt-5">
                <a href="https://www.magzter.com/IN/Exhibit/BBC-TopGear-India/Automotive/" target="_blank"><img
                        alt="TopGear Magazine Annual Issue 2026" src="/uploads/Banners/tgmagzter-annual2026.jpg" width="100%" /></a>
            </div>
        </div>
    </section>
    {{-- <section class="">
        <div class="container">
            <div class="row">
                <div class="tgsection-title">
                    <h2>YouTube Videos</h2>
                    <a href="https://www.youtube.com/@TopGearMagIndia" target="_blank">View All Videos
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" stroke="currentColor" fill="#d61b26"
                            stroke-width="0" width="1em" height="1em" font-size="20" data-testid="SvgGelIconChevronRight">
                            <path d="M21.6 14.3L5.5 31h6.4l14.6-15L11.9 1H5.5l16.1 16.7v-3.4z" stroke="none"></path>
                        </svg>
                    </a>
                </div>
                <div class="col-lg-4">
                    <iframe class="latestVideoEmbed" kjnum='0' height="240" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
                <div class="col-lg-4">
                    <iframe class="latestVideoEmbed" kjnum='1' height="240" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
                <div class="col-lg-4">
                    <iframe class="latestVideoEmbed" kjnum='2' height="240" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section> --}}

    <section class="tg-reviews-latest">
        <div class="container">
            <div class="row">
                <div class="tgsection-title">
                    <h2>LATEST REVIEWS</h2>
                </div>
                @foreach($reviewslisthome as $review)
                    @php
                        $imageName = preg_replace('/_/', ' ', pathinfo($review->ImagePath, PATHINFO_FILENAME));
                        $altText = ucwords(trim(preg_replace('/\bReviews\b/i', '', $imageName)));
                        $altText = substr($altText, 0, -10);
                    @endphp
                    <div class="col-lg-4">
                        <div class="kjwrap tg-article-item">
                            <div class="tg-media">
                                <a class="d-block"
                                    href="{{ url('reviews/' . $review->menu->Code . '/' . $review->category->Code . '/' . $review->Code) }}">
                                    <img src="{{ url($review->ImagePath) }}" alt="{{ $altText }}">
                                </a>
                            </div>
                            <div class="tg-txt">
                                <a class="tg-review-tag"
                                    href="{{ url('reviews/' . $review->menu->Code . '/' . $review->category->Code) }}">{{ strtoupper($review->category->Name) }}</a>
                                <h2 class="tg-review-title"><a
                                        href="{{ url('reviews/' . $review->menu->Code . '/' . $review->category->Code . '/' . $review->Code) }}">{{ substr($review->ReviewsTitle, 0, 65) }}...</a>
                                </h2>
                                <span class="tg-tooltip">{{ $review->ReviewsTitle }}</span>
                                <span class="tg-author"><a
                                        href="{{ url('author/' . $review->Author) }}">{{ $review->Author }}</a></span> -
                                <span class="tg-article-date">{{ date('F j, Y', strtotime($review->PublishDate)) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section id="trending">
        <div class="container">
            <div class="tg-trending row">
                <div class="tgsection-title">
                    <h2>TRENDING THIS MONTH</h2>
                </div>

                @foreach($trendingdata as $item)

                    <div class="col-lg-6 kjtrending">
                        <div class="tg-number"></div>
                        <div class="">
                            <a class="tg-review-tag"
                                href="{{ url($item->menu->PageLink . '/' . $item->category->Code) }}">{{ $item->category->Name }}</a>
                            <h2 class="tg-review-title"><a
                                    href="{{ url($item->menu->PageLink . '/' . $item->category->Code . '/' . $item->Code) }}">{{ substr(strip_tags($item->Name ?? $item->ReviewsTitle), 0, 65) }}</a>
                            </h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- More sections as needed -->
    <section class="tg-reviews-latest kjads-wrap">
        <div class="container">
            <div class="row">
                <div class="tgsection-title">
                    <h2>LATEST FEATURES</h2>
                </div>
                @foreach($featurelisthome as $feature)
                            <?php

                    $imageName = preg_replace('/_/', ' ', pathinfo($feature->ImagePath ?? $feature->ImagePath, PATHINFO_FILENAME));
                    $altText = ucwords(trim(preg_replace('/\bFeaturesthumb\b/i', '', $imageName)));
                    $altText = substr($altText, 0, -10);
                                ?>
                            <div class="col-lg-4">
                                <div class="kjwrap tg-article-item">
                                    <div class="tg-media">
                                        <a class="d-block"
                                            href="{{ url('features/' . $feature->category->Code . '/' . $feature->Code) }}">
                                            <img src="{{ url($feature->ImagePath ?? $feature->ImagePath) }}" alt="{{ $altText }}">
                                        </a>
                                    </div>
                                    <div class="tg-txt">
                                        <a class="tg-review-tag"
                                            href="{{ url($feature->menu->PageLink . '/' . $feature->category->Code) }}">{{ strtoupper($feature->category->Name) }}</a>
                                        <h2 class="tg-review-title"><a
                                                href="{{ url('features/' . $feature->category->Code . '/' . $feature->Code) }}">{{ substr($feature->Name, 0, 65) }}...</a>
                                        </h2>
                                        <span class="tg-tooltip">{{ $feature->Name }}</span>
                                        <span class="tg-author"><a
                                                href="{{ url('author/' . $feature->Author) }}">{{ $feature->Author }}</a></span> -
                                        <span class="tg-article-date">{{ date('F j, Y', strtotime($feature->PublishDate)) }}</span>
                                    </div>
                                </div>
                            </div>
                @endforeach
            </div>
        </div>
    </section>
    <div id="tg-newsletter-box" class="my-5">
        <div class="container">
            <div class="kjnewsletter">
                <div class="tg-newsletter-wrap">
                    <div class="newsletter-header">
                        <h2 class="tg-title">Top Gear<br>Newsletter</h2>
                        <p>Stay up to date with all our latest content, news reports and reviews by subscribing to our
                            newsletter! <br>PS: We don't intend to sell your data to the highest bidder...</p>
                    </div>
                    <div class="newsletter-form">
                        <div id="mlb2-2028988" class="ml-form-embedContainer ml-subscribe-form ml-subscribe-form-2028988">
                            <div class="ml-form-align-center">
                                <div class="ml-form-embedWrapper embedForm">
                                    <div class="ml-form-embedBody ml-form-embedBodyDefault row-form">
                                        <div class="ml-form-embedContent" style="margin-bottom:0"></div>
                                        <form class="ml-block-form tg-newsletter"
                                            action="https://static.mailerlite.com/webforms/submit/n4j3t8" data-code="n4j3t8"
                                            method="post" target="_blank">
                                            <div class="ml-form-formContent">
                                                <div class="ml-form-fieldRow">
                                                    <div class="ml-field-group ml-field-name ml-validate-required">
                                                        <label class="d-none">Name</label>
                                                        <input aria-label="name" aria-required="true" type="text"
                                                            class="form-control" data-inputmask="" name="fields[name]"
                                                            placeholder="Your Name" autocomplete="name">
                                                    </div>
                                                </div>
                                                <div class="ml-form-fieldRow">
                                                    <div
                                                        class="ml-field-group ml-field-email ml-validate-email ml-validate-required">
                                                        <label class="d-none">Email</label>
                                                        <input aria-label="email" aria-required="true" type="email"
                                                            class="form-control" data-inputmask="" name="fields[email]"
                                                            placeholder="Your Email" autocomplete="email">
                                                    </div>
                                                </div>
                                                <div class="ml-form-fieldRow ml-last-item">
                                                    <div class="ml-field-group ml-field-company">
                                                        <label class="d-none">What's in your garage</label>
                                                        <input aria-label="company" type="text" class="form-control"
                                                            data-inputmask="" name="fields[company]"
                                                            placeholder="What's in your garage" autocomplete="">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="ml-submit" value="1">
                                            <div class="ml-form-embedSubmit">
                                                <button type="submit" class="tg-btn primary">SUBSCRIBE</button>
                                                <button disabled="disabled" style="display:none" type="button"
                                                    class="loading">
                                                    <div class="ml-form-embedSubmitLoad"></div> <span
                                                        class="sr-only">Loading...</span>
                                                </button>
                                            </div>
                                            <input type="hidden" name="anticsrf" value="true">
                                        </form>
                                    </div>
                                    <div class="ml-form-successBody row-success" style="display:none">
                                        <div class="ml-form-successContent">
                                            <h4>Thank you for Subscribing</h4>
                                            <p>You have successfully joined our subscriber list.</p>
                                            <p><span style="font-size:16px">Welcome to BBC TopGear India!</span></p>
                                            <p></p>
                                            <p><strong></strong></p>
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
    <!-- Popup Here -->
    <!--<div id="tgoverlay">
        <div id="kjpopup">
          <button id="close-btn">&times;</button>
          <a href="https://www.topgearmag.in/votenow" target="_blank">
            <img src="https://topgearmag.in/uploads/awards25/popup-banner.webp" alt="Vote Now">
          </a>
        </div>
      </div>-->

    {{--
    <script>

        const loadVideo = (iframe) => {
            const cid = "UCzt-MrR91HgnZCvypAaV1uA";
            const channelURL = encodeURIComponent(`https://www.youtube.com/feeds/videos.xml?channel_id=${cid}`)
            const reqURL = `https://api.rss2json.com/v1/api.json?rss_url=${channelURL}`;

            fetch(reqURL)
                .then(response => response.json())
                .then(result => {
                    console.log(result)
                    const videoNumber = iframe.getAttribute('kjnum')
                    const link = result.items[videoNumber].link;
                    const id = link.substr(link.indexOf("=") + 1);
                    iframe.setAttribute("src", `https://youtube.com/embed/${id}?controls=0&autoplay=1`);
                })
                .catch(error => console.log('error', error));
        }

        const iframes = document.getElementsByClassName('latestVideoEmbed');
        for (let i = 0, len = iframes.length; i < len; i++) {
            loadVideo(iframes[i]);
        }

    </script> --}}

@endsection
<div class="container">
    <div class="hero-slider carousel slide pointer-event" data-bs-ride="carousel" id="carouselExampleIndicators">
        <div class="carousel-inner">
            @php $firstItem = true; @endphp <!-- Variable to track the first item -->
            @foreach($mergedBanner->sortByDesc('PublishDate')->take(7) as $item)
                        <?php
                $imageName = preg_replace('/_/', ' ', pathinfo($item->ImagePath ?? $item->ImagePath, PATHINFO_FILENAME));
                $altText = ucwords(trim(preg_replace('/\bNewsthumb\b/i', '', $imageName)));
                $altText = substr($altText, 0, -10);
                            ?>
                        <div class="carousel-item {{ $firstItem ? 'active' : '' }}">
                            <div class="row">
                                <div class="col-lg-8">
                                    <a href="{{ url($item->menu->PageLink . '/' . $item->category->Code . '/' . $item->Code) }}">
                                        <img alt="{{ $altText }}" class="w-100"
                                            src="{{ url($item->ImagePath ?? $item->ImagePath) }}">
                                    </a>
                                </div>
                                <div class="col-lg-4">
                                    <div class="caption">
                                        <a href="{{ url($item->menu->PageLink . '/' . $item->category->Code) }}"
                                            class="tgnews-tag">{{ strtoupper($item->category->Name) }}</a>
                                        <h2 class="tg-review-title">
                                            <a
                                                href="{{ url($item->menu->PageLink . '/' . $item->category->Code . '/' . $item->Code) }}">
                                                {{ $item->Name ?? $item->ReviewsTitle }}
                                            </a>
                                        </h2>
                                        <span class="tg-article-date">{{ date('F j, Y', strtotime($item->PublishDate)) }}</span>
                                        <p><a
                                                href="{{ url($item->menu->PageLink . '/' . $item->category->Code . '/' . $item->Code) }}">Learn
                                                More</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $firstItem = false; @endphp <!-- Set the first item to false after the first iteration -->
            @endforeach

            <!-- Custom Banner -->
            <div class="carousel-item">
                <img alt="TopGear India Magazine May 2026" class="d-block w-100"
                    src="https://www.topgearmag.in/uploads/Banners/tgbanner-may2026.jpg">
                <div class="caption tg-magazine">
                    <p class="text-center"><a href="https://www.exhibitstore.in" target="_blank">Buy Now</a></p>
                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators"
            type="button">
            <span aria-hidden="true" class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleIndicators"
            type="button">
            <span aria-hidden="true" class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
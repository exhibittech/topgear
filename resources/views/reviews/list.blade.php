@extends('layouts.apphome')

@section('title', $seodata['MetaTitle'])
@section('description', $seodata['MetaDescription'])
@section('keywords', $seodata['Keyword'])

@section('content')
<section class="tg-reviews-latest">
    <div class="container">
        <div class="row">
            <div class="tgsection-title">
                <h1>{{ $category->Name }}</h1>
            </div>
        </div>
        @if($reviewsList->count())
            <div class="row">
                @foreach ($reviewsList as $review)
                    <div class="col-md-4 mb-4">
                        <div class="kjwrap tg-article-item">
                            <div class="tg-media">
                                <a href="{{ url('reviews/' . $menuData->Code . '/' . $category->Code . '/' . $review->Code) }}" class="d-block">
                                    <img src="{{ asset($review->ImagePath) }}" alt="{{ $review->ReviewsTitle }}" width="800">
                                </a>
                            </div>
                            <div class="tg-txt">
                                <a href="#" class="tg-review-tag">{{ $category->Name }}</a>
                                <h2 class="tg-review-title">
                                    <a href="{{ url('reviews/' . $menuData->Code . '/' . $category->Code . '/' . $review->Code) }}">
                                        {{ $review->ReviewsTitle }}
                                    </a>
                                </h2>
                                <span class="tg-author">{{ $review->Author }}</span> -
                                <span class="tg-article-date">{{ date('F j, Y', strtotime($review->PublishDate)) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
 <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($reviewsList->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $reviewsList->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($reviewsList->links()->elements[0] as $page => $url)
                            @if ($page == $reviewsList->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($reviewsList->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $reviewsList->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        @else
            <p>No reviews found in this category.</p>
        @endif
    </div>
</section>
@endsection

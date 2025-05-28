@extends('layouts.apphome')

@section('title', $seodata['MetaTitle'])
@section('description', $seodata['MetaDescription'])
@section('keywords', $seodata['Keyword'])

@section('content')
<div class="tg-reviews-latest">
    <div class="container">
        @if(!empty($categories))
            @foreach ($categories as $category)
                <div class="row">
                    <div class="tgsection-title">
                        <h1>{{ $category->Name }}</h1>
                    </div>
                    @if($category->reviews->isNotEmpty())
                        @foreach ($category->reviews as $review)
                            <div class="col-md-4">
                                <div class="kjwrap tg-article-item">
                                    <div class="tg-media">
                                        <a href="{{ url('reviews/' . $menuData->Code . '/' . $category->Code . '/' . $review->Code) }}" class="d-block">
                                            <img src="{{ asset($review->ImagePath) }}" width="800" alt="{{ $review->Name }}">
                                        </a>
                                    </div>
                                    <div class="tg-txt">
                                        <a href="{{ url('reviews/' . $menuData->Code . '/' . $category->Code . '/' . $review->Code) }}" class="tg-review-tag">{{ $category->Name }}</a>
                                        <h2 class="tg-review-title">
                                            <a href="{{ url('reviews/' . $menuData->Code . '/' . $category->Code . '/' . $review->Code) }}">{{ $review->ReviewsTitle }}</a>
                                        </h2>
                                        <span class="tg-author">{{ $review->Author }}</span> -
                                        <span class="tg-article-date">{{ date('F j, Y', strtotime($review->PublishDate)) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <p>No reviews available in this category.</p>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <p>No categories available.</p>
        @endif
    </div>
</div>
@endsection

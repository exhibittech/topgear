@extends('layouts.apphome')

@section('title', $seodata['MetaTitle'])
@section('description', $seodata['MetaDescription'])
@section('keywords', $seodata['Keyword'])

@section('content')
    <div class="container">
        <div class="tg-reviews-latest">
            <div class="container">
                <div class="row">
                    <div class="tgsection-title">
                        <h1>Articles by {{ $author }}</h1>
                    </div>

                    @if($results->isEmpty())
                        <p>No content found for author "{{ $author }}".</p>
                    @else
                        @foreach($results as $result)
                            @if(isset($result->menu->PageLink) && isset($result->category->Code) && ($result->Code ?? $result->ReviewsTitle))
                                <div class="col-md-4">
                                    <div class="kjwrap tg-article-item">
                                        <div class="tg-media">
                                            <a href="{{ url($result->menu->PageLink . '/' . $result->category->Code . '/' . ($result->Code ?? $result->ReviewsTitle)) }}" class="d-block">
                                                <img src="{{ url($result->ImagePath ?? 'uploads/default-image.jpg') }}" width="800" alt="{{ $result->Name ?? $result->ReviewsTitle }}">
                                            </a>
                                        </div>
                                        <div class="tg-txt">
                                            <h2 class="tg-review-title">
                                                <a href="{{ url($result->menu->PageLink . '/' . $result->category->Code . '/' . ($result->Code ?? $result->ReviewsTitle)) }}">
                                                    {{ Str::limit($result->Name ?? $result->ReviewsTitle, 65) }}
                                                </a>
                                            </h2>
                                            <span class="tg-tooltip">{{ $result->Name ?? $result->ReviewsTitle }}</span>
                                            <span class="tg-author">
                                                {{ $result->Author }}
                                            </span> -
                                            <span class="tg-article-date">{{ date('F j, Y', strtotime($result->PublishDate)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

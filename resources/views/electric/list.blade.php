@extends('layouts.apphome')

@section('title', $seodata['MetaTitle'])
@section('description', $seodata['MetaDescription'])
@section('keywords', $seodata['Keyword'])

@section('content')
<div class="tg-reviews-latest">
    <div class="container">
        <div class="row">
            <div class="tgsection-title">
                <h1>Electric Vehicles</h1>
            </div>
            @if ($electricList->isEmpty())
                <p>No electric vehicles found.</p>
            @else
                @foreach ($electricList as $item)
                    @php
                        $imageName = pathinfo($item->ImagePath ?? $item->images->first()->ImagePath, PATHINFO_FILENAME);
                        $altText = ucwords(str_replace('_', ' ', $imageName));
                        $altText = substr($altText, 0, -10);
                    @endphp
                    <div class="col-md-4">
                        <div class="kjwrap tg-article-item">
                            <div class="tg-media">
                                <a href="{{ url('electric/' . $item->Code) }}" class="d-block">
                                    <img src="{{ asset($item->ImagePath ?? $item->images->first()->ImagePath) }}" width="800" alt="{{ $altText }}">
                                </a>
                            </div>
                            <div class="tg-txt">
                                <h2 class="tg-review-title">
                                    <a href="{{ url('electric/' . $item->Code) }}">{{ Str::limit($item->Name, 65) }}...</a>
                                </h2>
                                <span class="tg-tooltip">{{ $item->Name }}</span>
                                <span class="tg-author"><a href="{{ url('author/' . $item->Author) }}">{{ $item->Author }}</a></span> -
                                <span class="tg-article-date">{{ date('F j, Y', strtotime($item->PublishDate)) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="d-flex justify-content-center">
            {{ $electricList->links() }}
        </div>
    </div>
</div>
@endsection

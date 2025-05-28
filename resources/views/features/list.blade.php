@extends('layouts.apphome')

@section('title', $seodata['MetaTitle'])
@section('description', $seodata['MetaDescription'])
@section('keywords', $seodata['Keyword'])

@section('content')
<div class="container">
    <div class="tgsection-title">
        <h1>{{ $category->Name }}</h1>
    </div>
    <div class="row">
        @foreach($featureList as $feature)
            <div class="col-md-4">
                <div class="kjwrap tg-article-item">
                    <div class="tg-media">
                        <a href="{{ url('features/'.$category->Code.'/'.$feature->Code) }}" class="d-block">
                            <img src="{{ asset($feature->ImagePath) }}" width="800" alt="{{ $feature->Name }}">
                        </a>
                    </div>
                    <div class="tg-txt">
                        <h2 class="tg-review-title">
                            <a href="{{ url('features/'.$category->Code.'/'.$feature->Code) }}">{{ Str::limit($feature->Name, 65) }}</a>
                        </h2>
                        <span class="tg-tooltip">{{ $feature->Name }}</span>
                        <span class="tg-author"><a href="{{ url('author/'.$feature->Author) }}">{{ $feature->Author }}</a></span> -
                        <span class="tg-article-date">{{ date('F j, Y', strtotime($feature->PublishDate)) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
   
<div class="d-flex justify-content-center mt-4">
        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($featureList->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $featureList->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($featureList->links()->elements[0] as $page => $url)
                    @if ($page == $featureList->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($featureList->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $featureList->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

</div>
@endsection

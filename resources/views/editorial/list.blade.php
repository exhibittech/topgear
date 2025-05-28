@extends('layouts.apphome')

@section('title', $seodata['MetaTitle'])
@section('description', $seodata['MetaDescription'])
@section('keywords', $seodata['Keyword'])

@section('content')
<div class="tg-reviews-latest">
    <div class="container">
        <div class="row">
            <div class="tgsection-title">
                <h1>Editorial</h1>
            </div>
            @if ($editorialList->isEmpty())
                <p>No editorial articles found.</p>
            @else
                @foreach ($editorialList as $item)
                    @php
                        $imageName = pathinfo($item->ImagePath, PATHINFO_FILENAME);
                        $altText = ucwords(str_replace('_', ' ', $imageName));
                        $altText = substr($altText, 0, -10);
                    @endphp
                    <div class="col-md-4">
                        <div class="kjwrap tg-article-item">
                            <div class="tg-media">
                                <a href="{{ url('editorial/' . $item->Code) }}" class="d-block">
                                    <img src="{{ asset($item->ImagePath) }}" width="800" alt="{{ $altText }}">
                                </a>
                            </div>
                            <div class="tg-txt">
                                <h2 class="tg-review-title">
                                    <a href="{{ url('editorial/' . $item->Code) }}">{{ Str::limit($item->Name, 65) }}...</a>
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
          <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($editorialList->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $editorialList->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($editorialList->links()->elements[0] as $page => $url)
                        @if ($page == $editorialList->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($editorialList->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $editorialList->nextPageUrl() }}" rel="next">&raquo;</a>
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
    </div>
</div>
@endsection

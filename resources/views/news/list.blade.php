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
                        <h1>{{ $category->Name }}</h1>
                    </div>
                    @foreach($newsList as $news)
                        <div class="col-md-4">
                            <div class="kjwrap tg-article-item">
                                <div class="tg-media">
                                    <a href="{{ url($news->menu->PageLink . '/' . $news->category->Code . '/' . $news->Code) }}" class="d-block">
                                        <img src="{{ url($news->ImagePath) }}" width="800" alt="{{ $news->Name }}">
                                    </a>
                                </div>
                                <div class="tg-txt">
                                    <h2 class="tg-review-title">
                                        <a href="{{ url($news->menu->PageLink . '/' . $news->category->Code . '/' . $news->Code) }}">
                                            {{ Str::limit($news->Name, 65) }}
                                        </a>
                                    </h2>
                                    <span class="tg-tooltip">{{ $news->Name }}</span>
                                    <span class="tg-author">
                                        <a href="{{ url('author/' . $news->Author) }}">{{ $news->Author }}</a>
                                    </span> -
                                    <span class="tg-article-date">{{ date('F j, Y', strtotime($news->PublishDate)) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>

        <div id="kj-roadblock">
    <ins class="adnm-tag" id="adnmCreative"
       style="display:inline-block;width:100%;height:300px;"
       data-adnm-cc="cac57449-4c04-4846-989e-47e598ffcd49"
       data-adnm-session="${CACHEBUSTER}"
       data-adnm-click="${CLICK_URL}"
       data-adnm-type="canvasmobile"
       ... >
     <script async src="https://macro.adnami.io/macro/gen/adnm.ads.v2.js"></script>
  </ins>
</div>

        <!-- Pagination Links -->
       <div class="d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($newsList->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $newsList->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($newsList->links()->elements[0] as $page => $url)
                        @if ($page == $newsList->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($newsList->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $newsList->nextPageUrl() }}" rel="next">&raquo;</a>
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

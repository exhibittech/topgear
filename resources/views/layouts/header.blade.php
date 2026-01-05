<!-- resources/views/layouts/header.blade.php -->

<!-- <div class="container">
    <div class="my-3 text-center">
        <a href="https://youtu.be/yeGXHJcf8mQ" target="_blank">
            <img src="/uploads/Banners/cws-s2.png" alt="Cars With Stars Season 2" width="100%">
        </a>
    </div>
</div> -->



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="tg-header-banner">
        <div class="kjgearstripes-wrap">
            <div class="tg-stripes"></div>
            <div class="tg-gear-wrap">
                <img src="{{ asset('assets/imgs/large-gear.png') }}" width="165" />
            </div>
        </div>
        <div class="tg-brand-wrap"></div>
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/imgs/tg-logo-white.png') }}" width="340" alt="BBC TopGear India"></a>
            <div class="tg-subscribe">
                <!--<div>BBC TopGear India Awards 2025</div>
                <p>Sign up to our newsletter</p>
                <a href="https://www.topgearmag.in/votenow">Vote Now</a>-->
            </div>
        </div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="tg-nav-container">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-between" id="navbar-menu">
                <ul class="navbar-nav mb-2">
                    @foreach($menu as $item)
                        <li class="nav-item dropdown">
                            <a class="nav-link {{ $item->submenus->isNotEmpty() || ($item->ID == 3 && $item->dynamicSubmenus->isNotEmpty()) ? 'dropdown-toggle' : '' }}"
                               href="{{ (strpos($item->PageLink, 'http') === 0) ? $item->PageLink : ($item->submenus->isEmpty() && ($item->ID != 3 || $item->dynamicSubmenus->isEmpty()) ? url($item->PageLink) : '#') }}"
                               id="{{ $item->Name }}" role="button" {{ $item->submenus->isNotEmpty() || ($item->ID == 3 && $item->dynamicSubmenus->isNotEmpty()) ? 'data-bs-toggle=dropdown' : '' }} aria-expanded="false">
                                {{ $item->Name }}
                            </a>
                            @if($item->submenus->isNotEmpty() || ($item->ID == 3 && $item->dynamicSubmenus->isNotEmpty()))
                                <ul class="dropdown-menu" aria-labelledby="{{ $item->Name }}">
                                    @php
                                        // Ensure "Cars" appears first only under the News dropdown, keep others' order
                                        if (isset($item->Name) && strtolower($item->Name) === 'news') {
                                            $carsFirst = $item->submenus->filter(function ($s) { return strtolower($s->Name) === 'cars'; });
                                            $others = $item->submenus->reject(function ($s) { return strtolower($s->Name) === 'cars'; });
                                            $submenusOrdered = $carsFirst->concat($others);
                                        } else {
                                            $submenusOrdered = $item->submenus;
                                        }
                                    @endphp
                                    @foreach($submenusOrdered as $submenu)
					<!--<li class="kjmulti-dropdown nav-item dropdown">-->
                                        <li class="kjmulti-dropdown nav-item dropdown">
                                            <a class="dropdown-item {{ $submenu->reviewSubmenus->isNotEmpty() ? 'dropdown-toggle' : '' }}"
                                               href="{{ (strpos($submenu->PageLink, 'http') === 0) ? $submenu->PageLink : url($item->PageLink . '/' . $submenu->Code) }}"
                                               {{ $submenu->reviewSubmenus->isNotEmpty() ? 'data-bs-toggle=dropdown' : '' }}>
                                                {{ $submenu->Name }}
                                            </a>
                                            @if($submenu->reviewSubmenus->isNotEmpty())
                                                <ul class="dropdown-menu">
                                                    @php
                                                        // For Bikes/Scooters, move "First Ride" to the top and keep others' order
                                                        if (isset($submenu->Name) && strtolower($submenu->Name) === 'bikes/scooters') {
                                                            $firstRide = $submenu->reviewSubmenus->filter(function ($r) { return strtolower($r->Name) === 'first ride'; });
                                                            $otherReviews = $submenu->reviewSubmenus->reject(function ($r) { return strtolower($r->Name) === 'first ride'; });
                                                            $reviewSubmenusOrdered = $firstRide->concat($otherReviews);
                                                        } else {
                                                            $reviewSubmenusOrdered = $submenu->reviewSubmenus;
                                                        }
                                                    @endphp
                                                    @foreach($reviewSubmenusOrdered as $reviewSubmenu)
                                                        <li>
                                                           <a class="dropdown-item" href="{{ url('reviews/' . $submenu->Code . '/' . $reviewSubmenu->Code) }}">
                                                                {{ $reviewSubmenu->Name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach

                                    @if($item->ID == 3 && $item->dynamicSubmenus->isNotEmpty())
                                        @foreach($item->dynamicSubmenus as $dynamicSubmenu)
                                            <li>
                                                <a class="dropdown-item" href="{{ url('features/' . $dynamicSubmenu->Code) }}">
                                                    {{ $dynamicSubmenu->Name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <div class="nav-search">
                    <button class="tg-search">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" stroke="currentColor" fill="currentColor" stroke-width="0" width="20" height="20" data-testid="SvgGelIconSearch">
                            <path d="M13 24.3c6.5 0 11.7-5.1 11.7-11.7S19.6 1 13 1 1.4 6.1 1.4 12.7 6.5 24.3 13 24.3zm0-2.6c-5.1 0-9-3.9-9-9.1s3.9-9.1 9-9.1 9 3.9 9 9.1-3.9 9.1-9 9.1zm5.8.4l8.9 8.9 2.9-2.9-8.9-8.9-2.9 2.9z" stroke="none"></path>
                        </svg>
                    </button>
                    <form class="d-flex tg-searchform" action="{{ url('search') }}" name="searchFrm" method="get">
                        <div class="container">
                            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="container tg-dropdown-wrap"></div>

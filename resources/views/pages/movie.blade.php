@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a
                                        href="{{ route('category', [$movie->category->slug]) }}">{{ $movie->category->slug }}</a>
                                    » <span><a
                                            href="{{ route('country', $movie->country->slug) }}">{{ $movie->country->title }}</a>
                                        @foreach ($movie->movie_genre as $gen)
                                            » <span><a href="{{ route('genre', $gen->slug) }}">{{ $gen->title }}</a>
                                        @endforeach

                                        » <span class="breadcrumb_last" aria-current="page">{{ $movie->title }}</span>
                                    </span></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content" class="test">
                <div class="clearfix wrap-content">

                    <div class="halim-movie-wrapper">
                        <div class="title-block">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                <div class="halim-pulse-ring"></div>
                            </div>
                            <div class="title-wrapper" style="font-weight: bold;">
                                Bookmark
                            </div>
                        </div>
                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-3">
                                <img class="movie-thumb" src="{{ asset('uploads/movie/' . $movie->image) }}"
                                    alt="{{ $movie->title }}">
                                @if ($movie->resolution != 5)
                                    @if ($episode_current_list_count > 0)
                                        <div class="bwa-content">
                                            <div class="loader"></div>
                                            <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $episode_tapdau->practice . '/server-' . $episode_tapdau->server) }}"
                                                class="bwac-btn">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <a href="#watch_trailer" class="btn btn-primary watch_trailer"
                                        style="display: block">Xem Trailer</a>
                                @endif


                            </div>
                            <div class="film-poster col-md-9">
                                <h1 class="movie-title title-1"
                                    style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                    {{ $movie->title }}</h1>
                                <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->name_eng }}</h2>
                                <ul class="list-info-group">
                                    <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                                            @if ($movie->resolution == 0)
                                                HD
                                            @elseif($movie->resolution == 1)
                                                SD
                                            @elseif($movie->resolution == 2)
                                                HDCam
                                            @elseif($movie->resolution == 3)
                                                Cam
                                            @elseif($movie->resolution == 4)
                                                FullHD
                                            @else
                                                Trailer
                                            @endif
                                        </span>
                                        @if ($movie->resolution != 5)
                                            <span class="episode">
                                                @if ($movie->sub == 0)
                                                    Phụ đề
                                                @else
                                                    Thuyết minh
                                                @endif
                                            </span>
                                        @endif

                                    </li>
                                 
                                    <li class="list-info-group-item"><span>Thời lượng</span> : {{ $movie->time_movie }}
                                    </li>
                                    {{-- <li class="list-info-group-item"><span>Tập phim</span> :
                                        @if ($movie->belong_movie == 'phimbo')
                                            {{ $episode_current_list_count }}/{{ $movie->episode }} -
                                            @if ($episode_current_list_count == $movie->episode)
                                                Hoàn thành
                                            @else
                                                Đang cập nhập
                                            @endif
                                        @else
                                            HD
                                        @endif

                                    </li> --}}
                                    @if ($movie->season != 0)
                                        <li class="list-info-group-item"><span>Season</span> : {{ $movie->season }}
                                        </li>
                                    @endif
                                    <li class="list-info-group-item"><span>Thể loại</span> :
                                        {{-- <a href="{{ route('genre', [$movie->genre->slug]) }}"
                                            rel="category tag">{{ $movie->genre->title }}</a> --}}
                                        @foreach ($movie->movie_genre as $gen)
                                            <a href="{{ route('genre', $gen->slug) }}">{{ $gen->title }}</a>
                                        @endforeach
                                    </li>
                                    <li class="list-info-group-item"><span>Thể loại</span> :
                                        {{-- <a href="{{ route('genre', [$movie->genre->slug]) }}"
                                            rel="category tag">{{ $movie->genre->title }}</a> --}}
                                        @foreach ($movie->movie_category as $categ)
                                            <a href="{{ route('category', $categ->slug) }}">{{ $categ->title }}</a>
                                        @endforeach
                                    </li>

                                    <li class="list-info-group-item"><span>Quốc gia</span> : <a
                                            href="{{ route('country', [$movie->country->slug]) }}"
                                            rel="tag">{{ $movie->country->title }}</a></li>

                                    <li class="list-info-group-item"><span>Tập phim mới nhất</span> :
                                        @if ($episode_current_list_count > 0)


                                            @if ($movie->belong_movie == 'phimbo')
                                                @foreach ($episode as $ep)
                                                    <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $ep->practice . '/server-' . $ep->server) }}"
                                                        rel="tag">Tập {{ $ep->practice }}
                                                    </a>
                                                @endforeach
                                            @elseif($movie->belong_movie == 'phimle')
                                                @foreach ($episode as $ep_pl)
                                                    <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $ep_pl->practice . '/server-' . $ep_pl->server)}}"
                                                        rel="tag">{{ $ep_pl->practice }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        @else
                                            Đang cập nhật
                                        @endif
                                    </li>
                                    {{-- <ul class="list-inline rating" title="Average Rating">

                                        @for ($count = 1; $count <= 5; $count++)
                                            @php

                                                if ($count <= $rating) {
                                                    $color = 'color:#ffcc00;'; //mau vang
                                                } else {
                                                    $color = 'color:#ccc;'; //mau xam
                                                }

                                            @endphp

                                            <li title="star_rating" id="{{ $movie->id }}-{{ $count }}"
                                                data-index="{{ $count }}" data-movie_id="{{ $movie->id }}"
                                                data-rating="{{ $rating }}" class="rating"
                                                style="cursor:pointer; {{ $color }} 

                                          font-size:30px;">
                                                &#9733;</li>
                                        @endfor

                                    </ul> --}}

                                </ul>
                                <div class="movie-trailer ">
                                    @php
                                        $current_url = Request::url();
                                    @endphp
                                    <div class="fb-like" data-href="{{ $current_url }}" data-width="" data-layout="button_count"
                                        data-action="" data-size="" data-share="true"></div>
                                    <div class="fb-save" data-uri="http://127.0.0.1:8000/phim/cuoc-chien-ai%E2%80%93atlas"
                                        data-size="small"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>
                    <div class="clearfix"></div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                <p>{{$movie->description}}</p>
                              
                            </article>
                        </div>
                    </div>

                    {{-- Tag phim --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Tags Phim</span></h2>
                    </div>

                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content"id="watch_trailer">
                                @if ($movie->tags != null)
                                    @php
                                        $tags = [];
                                        $tags = explode(',', $movie->tags);

                                    @endphp
                                    @foreach ($tags as $tag)
                                        <a href="{{ url('tags/' . $tag) }}">{{ $tag }}</a>
                                    @endforeach
                                @else
                                    {{ $movie->title }}
                                @endif
                            </article>
                        </div>
                    </div>
                    {{-- Comment facebook --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                    </div>
                    @php
                        $current_url = Request::url();
                    @endphp
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content"id="watch_trailer">
                                <div class="fb-comments" data-href="{{ $current_url }}" data-width=""
                                    data-numposts="20">
                                </div>
                            </article>
                        </div>
                    </div>
                    {{-- trailer phim --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Trailer Phim</span></h2>
                    </div>

                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="watch_trailer" class="item-content">
                                <iframe width="100%" height="315"
                                    src="https://www.youtube.com/embed/{{ $movie->trailer }}?si=huYuXUbnewqnm5dm&amp;start=1"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                    </div>
                    <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                        @foreach ($movie_related as $hot)
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie', $hot->slug) }}"
                                        title="{{ $hot->title }}">
                                        <figure><img class="lazy img-responsive"
                                                src="{{ asset('uploads/movie/' . $hot->image) }}" alt="Đại Thánh Vô Song"
                                                title="Đại Thánh Vô Song"></figure>
                                        <span class="status">
                                            @if ($hot->resolution == 0)
                                                HD
                                            @elseif($hot->resolution == 1)
                                                SD
                                            @elseif($hot->resolution == 2)
                                                HDCam
                                            @elseif($hot->resolution == 3)
                                                Cam
                                            @elseif($hot->resolution == 4)
                                                FullHD
                                            @endif
                                        </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                            @if ($hot->sub == 0)
                                                Phụ đề
                                            @else
                                                Thuyết minh
                                            @endif
                                        </span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">{{ $hot->title }}</p>
                                                <p class="original_title">{{ $hot->name_eng }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        @endforeach



                    </div>
                    <script>
                        jQuery(document).ready(function($) {
                            var owl = $('#halim_related_movies-2');
                            owl.owlCarousel({
                                loop: true,
                                margin: 4,
                                autoplay: true,
                                autoplayTimeout: 4000,
                                autoplayHoverPause: true,
                                nav: true,
                                navText: ['<i class="hl-down-open rotate-left"></i>',
                                    '<i class="hl-down-open rotate-right"></i>'
                                ],
                                responsiveClass: true,
                                responsive: {
                                    0: {
                                        items: 2
                                    },
                                    480: {
                                        items: 3
                                    },
                                    600: {
                                        items: 4
                                    },
                                    1000: {
                                        items: 5
                                    }
                                }
                            })
                        });
                    </script>
                </div>
            </section>
        </main>
        @include('pages.include.sidebar')

    </div>
@endsection

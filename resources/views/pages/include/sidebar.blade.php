<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim hot</span>

            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>

                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach ($phimhot_sidebar as $item)
                        <div class="item post-37176">
                            <a href="{{ route('movie', $item->slug) }}" title="{{ $item->title }}">
                                <div class="item-link">
                                    <img src="{{ asset('uploads/movie/' . $item->image) }}" class="lazy post-thumb"
                                        alt="{{ $item->title }}" title="{{ $item->title }}" />
                                    <span class="is_trailer">
                                        @if ($item->resolution == 0)
                                            HD
                                        @elseif($item->resolution == 1)
                                            SD
                                        @elseif($item->resolution == 2)
                                            HDCam
                                        @elseif($item->resolution == 3)
                                            Cam
                                        @elseif($item->resolution == 4)
                                            FullHD
                                        @else
                                            Trailer
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $item->title }}</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">
                                @if ($item->count_views > 0)
                                    {{$item->count_views}} Lượt quan tâm
                                @else
                                    @php
                                        echo rand(100,99999)
                                    @endphp
                                    Lượt quan tâm
                                @endif

                            </div>
                            <div style="float: left;">
                                
                                <ul class="list-inline rating" title="Average Rating">
                                    @for ($count = 1; $count <= 5; $count++)
                                        <li title="star_rating" style="font-size:20px;color:#ffcc00;padding:0px;">
                                            &#9733;
                                        </li>
                                    @endfor


                                </u>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>

<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim Sắp chiếu</span>

            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>

                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach ($phimhot_trailer as $item)
                        <div class="item post-37176">
                            <a href="{{ route('movie', $item->slug) }}" title="{{ $item->title }}">
                                <div class="item-link">
                                    <img src="{{ asset('uploads/movie/' . $item->image) }}" class="lazy post-thumb"
                                        alt="{{ $item->title }}" title="{{ $item->title }}" />
                                    <span class="is_trailer">
                                        @if ($item->resolution == 0)
                                            HD
                                        @elseif($item->resolution == 1)
                                            SD
                                        @elseif($item->resolution == 2)
                                            HDCam
                                        @elseif($item->resolution == 3)
                                            Cam
                                        @elseif($item->resolution == 4)
                                            FullHD
                                        @else
                                            Trailer
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $item->title }}</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div class="viewsCount" style="color: #9d9d9d;">{{ $item->year }}</div>

                            <div style="float: left;">
                                {{-- <span  class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span> --}}
                                <ul class="list-inline rating" title="Average Rating">
                                    @for ($count = 1; $count <= 5; $count++)
                                        <li title="star_rating" style="font-size:20px;color:#ffcc00;padding:0px;">
                                            &#9733;
                                        </li>
                                    @endfor


                                </u>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>

<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>


            </div>

        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link fiter-sidebar" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab"
                    aria-controls="pills-home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fiter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#tuan"
                    role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fiter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#thang"
                    role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade " id="ngay" role="tabpanel" aria-labelledby="pills-home-tab">
                <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                    <div class="halim-ajax-popular-post-loading hidden"></div>
                    <div id="halim-ajax-popular-post" class="popular-post">
                        {{-- <div class="item post-37176">
                            <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                                <div class="item-link">
                                    <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798"
                                        class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ"
                                        title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                    <span class="is_trailer">Trailer</span>
                                </div>
                                <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div> --}}
                        <span id="show0"></span>



                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                    <div class="halim-ajax-popular-post-loading hidden"></div>
                    <div id="halim-ajax-popular-post" class="popular-post">
                        {{-- <div class="item post-37176">
                            <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                                <div class="item-link">
                                    <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798"
                                        class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ"
                                        title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                    <span class="is_trailer">Trailer</span>
                                </div>
                                <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div> --}}

                        <span id="show1"></span>


                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                    <div class="halim-ajax-popular-post-loading hidden"></div>
                    <div id="halim-ajax-popular-post" class="popular-post">
                        {{-- <div class="item post-37176">
                            <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                                <div class="item-link">
                                    <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798"
                                        class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ"
                                        title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                    <span class="is_trailer">Trailer</span>
                                </div>
                                <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div> --}}

                        <span id="show2"></span>


                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

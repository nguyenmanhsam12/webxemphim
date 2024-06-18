@extends('admin.index')


@section('content')
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}

    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="video_title"></h5>
                    <h6 id ="video_desc"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"id="video_link">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>


    <a href="{{ route('admin.movie.add') }}">
        <button class="btn btn-primary"style="margin-top:50px;">
            Thêm Phim
        </button>
    </a>
    <h1>Quản lý phim</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive" id="">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Tập phim</th>
                            <th scope="col">Số tập</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Name_ENG</th>
                            <th scope="col">Time_Movie</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Tùy Chỉnh</th>



                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movie as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td><a href="{{ route('add-episode', [$item->id]) }}"class="btn btn-success btn-sm">Thêm tập
                                        phim</a>
                                    @foreach ($item->practice as $epids)
                                        <a class="show-video"data-movie_video_id="{{ $epids->movie_id }}"
                                            data-video_episode="{{ $epids->practice }}" style="color:#fff;cursor:pointer;">
                                            <span class="badge badge-dark ">{{ $epids->practice }}</span>
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $item->practice_count . '/' . $item->episode }}
                                </td>
                                <td>{{ $item->tags }}</td>
                                <td>{{ $item->name_eng }}</td>
                                <td>{{ $item->time_movie }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    @php
                                        $image_check = substr($item->image,0,5);
                                    @endphp

                                    @if($image_check=='https')
                                        <img src="{{ $item->image }}" alt=""width="100px">
                                    @else
                                        <img src="{{ asset('uploads/movie/' . $item->image) }}" alt=""
                                            width="150"height="200">
                                    @endif
                                </td>
                                <td>
                                    <p>Phim hot</p>
                                    <select name="phim_hot" id="{{ $item->id }}" class="form-control phimhot">
                                        <option value="0" {{ $item->phim_hot == 0 ? 'selected' : '' }}>Không</option>
                                        <option value="1" {{ $item->phim_hot == 1 ? 'selected' : '' }}>Hot</option>
                                    </select>
                                    <p>Reselution</p>
                                    @php
                                        $options = [
                                            '0' => 'HD',
                                            '1' => 'SD',
                                            '2' => 'HDCam',
                                            '3' => 'Cam',
                                            '4' => 'FullHD',
                                            '5' => 'Trailer',
                                        ];
                                    @endphp
                                    <select name="resolution" id="{{ $item->id }}"
                                        class="form-control resolution_choose">
                                        @foreach ($options as $key => $resolution)
                                            <option value="{{ $key }}"
                                                {{ $item->resolution == $key ? 'selected' : '' }}>{{ $resolution }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p>Sub</p>
                                    <select name="sub" id="{{ $item->id }}"class="form-control sub_choose">
                                        <option value="0" {{ $item->resolution == 0 ? 'selected' : '' }}>Phụ đề
                                        </option>
                                        <option value="1" {{ $item->resolution == 1 ? 'selected' : '' }}>Thuyết minh
                                        </option>
                                    </select>
                                    <p>Hiển thị</p>
                                    <select name="status" id="{{ $item->id }}" class="form-control trangthai_choose">
                                        @if ($item->status == 0)
                                            <option value="0"selected>Không</option>
                                            <option value="1">Hiển thị</option>
                                        @else
                                            <option value="0">Không</option>
                                            <option value="1"selected>Hiển thị</option>
                                        @endif
                                    </select>
                                    <p>Danh mục phim</p>
                                    {{-- <select name="category_id" class="form-control category_choose"
                                        id="{{ $item->id }}">
                                        @foreach ($category_list as $id => $title)
                                            <option value="{{ $id }}"
                                                {{ $item->category_id == $id ? 'selected' : '' }}>{{ $title }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    @foreach ($item->movie_category as $mg)
                                        <span class="badge text-bg-dark">{{ $mg->title }}</span>
                                    @endforeach
                                    <p>Belong_movie</p>
                                    <select name="belong_movie" id="{{ $item->id }}"
                                        class="form-control thuocphim_choose">
                                        @if ($item->belong_movie == 'phimle')
                                            <option value="phimle"selected>Phim lẻ</option>
                                            <option value="phimbo">Phim bộ</option>
                                        @else
                                            <option value="phimle">Phim lẻ</option>
                                            <option value="phimbo"selected>Phim bộ</option>
                                        @endif
                                    </select>
                                    <p>Thể loại</p>
                                    @foreach ($item->movie_genre as $mg)
                                        <span class="badge text-bg-dark">{{ $mg->title }}</span>
                                    @endforeach
                                    <p>Quốc gia</p>
                                    <select name="country_id" class="form-control country_choose" id="{{ $item->id }}">
                                        @foreach ($country_list as $id => $title)
                                            <option value="{{ $id }}"
                                                {{ $item->country_id == $id ? 'selected' : '' }}>{{ $title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p>Năm sản xuất</p>
                                    <select class="select-year" id="{{ $item->id }}"name="year">
                                        <option>--Năm Phim--</option>
                                        <option value="2000"{{ $item->year == 2000 ? 'selected' : '' }}>2000</option>
                                        <option value="2001"{{ $item->year == 2001 ? 'selected' : '' }}>2001</option>
                                        <option value="2002"{{ $item->year == 2002 ? 'selected' : '' }}>2002</option>
                                        <option value="2003"{{ $item->year == 2003 ? 'selected' : '' }}>2003</option>
                                        <option value="2004"{{ $item->year == 2004 ? 'selected' : '' }}>2004</option>
                                        <option value="2005"{{ $item->year == 2005 ? 'selected' : '' }}>2005</option>
                                        <option value="2006"{{ $item->year == 2006 ? 'selected' : '' }}>2006</option>
                                        <option value="2007"{{ $item->year == 2007 ? 'selected' : '' }}>2007</option>
                                        <option value="2008"{{ $item->year == 2008 ? 'selected' : '' }}>2008</option>
                                        <option value="2009"{{ $item->year == 2009 ? 'selected' : '' }}>2009</option>
                                        <option value="2010"{{ $item->year == 2010 ? 'selected' : '' }}>2010</option>
                                        <option value="2011"{{ $item->year == 2011 ? 'selected' : '' }}>2011</option>
                                        <option value="2012"{{ $item->year == 2012 ? 'selected' : '' }}>2012</option>
                                        <option value="2013"{{ $item->year == 2013 ? 'selected' : '' }}>2013</option>
                                        <option value="2014"{{ $item->year == 2014 ? 'selected' : '' }}>2014</option>
                                        <option value="2015"{{ $item->year == 2015 ? 'selected' : '' }}>2015</option>
                                        <option value="2016"{{ $item->year == 2016 ? 'selected' : '' }}>2016</option>
                                        <option value="2017"{{ $item->year == 2017 ? 'selected' : '' }}>2017</option>
                                        <option value="2018"{{ $item->year == 2018 ? 'selected' : '' }}>2018</option>
                                        <option value="2019"{{ $item->year == 2019 ? 'selected' : '' }}>2019</option>
                                        <option value="2020"{{ $item->year == 2020 ? 'selected' : '' }}>2020</option>
                                        <option value="2021"{{ $item->year == 2021 ? 'selected' : '' }}>2021</option>
                                        <option value="2022"{{ $item->year == 2022 ? 'selected' : '' }}>2022</option>
                                        <option value="2023"{{ $item->year == 2023 ? 'selected' : '' }}>2023</option>
                                        <option value="2024"{{ $item->year == 2024 ? 'selected' : '' }}>2024</option>
                                    </select>
                                    <p>Top views</p>
                                    <select name="topview" id="{{ $item->id }}" class="select-topview">
                                        <option>--Views--</option>

                                        <option value="0">Ngày</option>
                                        <option value="1">Tuần</option>
                                        <option value="2">Tháng</option>
                                    </select>
                                    <p>Season</p>
                                    <form action="POST">
                                        @csrf
                                        <select name="season" id="{{ $item->id }}" class="select-season">
                                            <option>--Tập Phim--</option>
                                            <option value="0"{{ $item->season == 0 ? 'selected' : '' }}>0</option>
                                            <option value="1"{{ $item->season == 1 ? 'selected' : '' }}>1</option>
                                            <option value="2"{{ $item->season == 2 ? 'selected' : '' }}>2</option>
                                            <option value="3"{{ $item->season == 3 ? 'selected' : '' }}>3</option>
                                            <option value="4"{{ $item->season == 4 ? 'selected' : '' }}>4</option>
                                            <option value="5"{{ $item->season == 5 ? 'selected' : '' }}>5</option>
                                            <option value="6"{{ $item->season == 6 ? 'selected' : '' }}>6</option>
                                            <option value="7"{{ $item->season == 7 ? 'selected' : '' }}>7</option>
                                            <option value="8"{{ $item->season == 8 ? 'selected' : '' }}>8</option>
                                            <option value="9"{{ $item->season == 9 ? 'selected' : '' }}>9</option>
                                            <option value="10"{{ $item->season == 10 ? 'selected' : '' }}>10</option>
                                            <option value="11"{{ $item->season == 11 ? 'selected' : '' }}>11</option>
                                            <option value="12"{{ $item->season == 12 ? 'selected' : '' }}>12</option>
                                            <option value="13"{{ $item->season == 13 ? 'selected' : '' }}>13</option>
                                            <option value="14"{{ $item->season == 14 ? 'selected' : '' }}>14</option>
                                            <option value="15"{{ $item->season == 15 ? 'selected' : '' }}>15</option>
                                            <option value="16"{{ $item->season == 16 ? 'selected' : '' }}>16</option>
                                            <option value="17"{{ $item->season == 17 ? 'selected' : '' }}>17</option>
                                            <option value="18"{{ $item->season == 18 ? 'selected' : '' }}>18</option>
                                            <option value="19"{{ $item->season == 19 ? 'selected' : '' }}>19</option>
                                            <option value="20"{{ $item->season == 20 ? 'selected' : '' }}>20</option>
                                        </select>
                                    </form>

                                </td>

                                <td>
                                    <a href="{{ route('admin.movie.edit', ['id' => $item->id]) }}">
                                        <button class="btn btn-warning">Sửa</button>
                                    </a>
                                    <a
                                        href="{{ route('admin.movie.delete', ['id' => $item->id]) }}"onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        <button class="btn btn-danger">Xóa</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

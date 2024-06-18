@extends('admin.index')

@section('content')
    <div class="container" style="margin-top:5px;">
        <h1>Thêm Phim</h1>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.movie.update', ['id' => $movie->id]) }}"method="POST"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Tiêu đề phim</label>
                        <input type="text"class="form-control" placeholder="Nhập tên title" name="title" id="slug"
                            onkeyup="ChangeToSlug()" value="{{ $movie->title }}">
                    </div>
                    <div class="form-group">
                        <label for="">Tiêu đề tiếng anh</label>
                        <input type="text"class="form-control" placeholder="Nhập tên title" name="name_eng"
                            value="{{ $movie->name_eng }}">
                    </div>
                    <div class="form-group">
                        <label for="">Số tập phim</label>
                        <input type="text"class="form-control" placeholder="Nhập tên title" name="episode"
                            value="{{ $movie->episode }}">
                    </div>
                    <div class="form-group">
                        <label for="">Trailer</label>
                        <input type="text"class="form-control" placeholder="..." name="trailer"
                            value="{{ $movie->trailer }}">
                    </div>
                    <div class="form-group">
                        <label for="">Thời lượng phim</label>
                        <input type="text"class="form-control" placeholder="Nhập time_movie" name="time_movie"
                            value="{{ $movie->time_movie }}">
                    </div>
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input type="text"class="form-control" placeholder="Nhập tên slug" name="slug"
                            id="convert_slug"value="{{ $movie->slug }}">
                    </div>
                    <div class="form-group">
                        <label for="">Tags Phim</label>
                        <textarea cols="30" rows="10" class="form-control" name="tags">{{ $movie->tags }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả phim</label>
                        <textarea cols="30" rows="10"name="description" class="form-control">{{ $movie->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status"class="form-control">
                            <option value="0" {{ $movie->status == 0 ? 'selected' : '' }}>Không hiển thị</option>
                            <option value="1" {{ $movie->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Độ phân giải</label>
                        <select name="resolution"class="form-control">
                            <option value="0"{{ $movie->resolution == 0 ? 'selected' : '' }}>HD</option>
                            <option value="1"{{ $movie->resolution == 1 ? 'selected' : '' }}>SD</option>
                            <option value="2"{{ $movie->resolution == 2 ? 'selected' : '' }}>HDCam</option>
                            <option value="3"{{ $movie->resolution == 3 ? 'selected' : '' }}>Cam</option>
                            <option value="4"{{ $movie->resolution == 4 ? 'selected' : '' }}>FullHD</option>
                            <option value="5"{{ $movie->resolution == 5 ? 'selected' : '' }}>Trailer</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Sub</label>
                        <select name="sub"class="form-control">
                            <option value="0"{{ $movie->sub == 0 ? 'selected' : '' }}>Phụ đề</option>
                            <option value="1"{{ $movie->sub == 1 ? 'selected' : '' }}>Thuyết minh</option>
                        </select>
                    </div>
                   
                    <div class="form-group">
                        <label for="">Thuộc phim</label>
                        <select name="belong_movie" id="" class="form-control">
                            <option value="phimle" {{$movie->belong_movie == 'phimle' ? 'selected' : ''}}>Phim lẻ</option>
                            <option value="phimbo" {{$movie->belong_movie == 'phimbo' ? 'selected' : ''}}>Phim bộ</option>
                        </select>
                    </div>
                    <div class="form-group">

                        <div class="mt-3">
                            <label for=""class="form-label">Danh mục phim</label>
                        </div>
                        <div class="mb-3">
                            @foreach ($category as $item)
                                <input type="checkbox" name="category[]" value="{{ $item->id }}"
                                @if (in_array($item->id,$movie_category)) 
                                    checked
                                @endif
                                >
                                <label for="">{{ $item->title }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="mt-3">
                            <label for=""class="form-label">Thể loại</label>
                        </div>
                        <div class="mb-3">
                            @foreach ($genre as $item)
                                <input type="checkbox" name="genre[]" value="{{ $item->id }}"
                                @if (in_array($item->id,$movie_genre)) 
                                    checked
                                @endif
                                >
                                <label for="">{{ $item->title }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Quốc gia</label>
                        <select name="country_id"class="form-control">
                            @foreach ($country as $item)
                                <option
                                    value="{{ $item->id }} "{{ $movie->country_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">PHIM HOT</label>
                        <select name="phim_hot"class="form-control">
                            <option value="0"{{ $movie->phim_hot == 0 ? 'selected' : '' }}>Không</option>
                            <option value="1"{{ $movie->phim_hot == 1 ? 'selected' : '' }}>Có</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file"name="image" class="form-control-file">
                        @if ($movie)
                            <div class="row">
                                <img src="{{ asset('uploads/movie/' . $movie->image) }}"width="200" height="200">
                            </div>
                        @endif

                    </div>


                    <button type="submit"class="btn btn-primary">Cập nhập phim</button>



                    @csrf
                </form>
            </div>
        </div>

    </div>
@endsection

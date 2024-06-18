@extends('admin.index')

@section('content')
    <div class="container" style="margin-top:5px;">
        <h1>Thêm Phim</h1>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.movie.postStore') }}"method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Tiêu đề phim</label>
                        <input type="text"class="form-control" placeholder="Nhập tên title" name="title" id="slug"
                            onkeyup="ChangeToSlug()">
                    </div>
                    <div class="form-group">
                        <label for="">Tiêu đề tiếng anh</label>
                        <input type="text"class="form-control" placeholder="..." name="name_eng">
                    </div>
                    <div class="form-group">
                        <label for="">Số tập phim</label>
                        <input type="text"class="form-control" placeholder="..." name="episode">
                    </div>
                    <div class="form-group">
                        <label for="">Trailer</label>
                        <input type="text"class="form-control" placeholder="..." name="trailer">
                    </div>
                    <div class="form-group">
                        <label for="">Thời lượng phim</label>
                        <input type="text"class="form-control" placeholder="Nhập time_movie" name="time_movie">
                    </div>
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input type="text"class="form-control" placeholder="Nhập tên slug" name="slug"
                            id="convert_slug">
                    </div>
                    <div class="form-group">
                        <label for="">Tags Phim</label>
                        <textarea cols="30" rows="10" class="form-control" name="tags"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả phim</label>
                        <textarea cols="30" rows="10"name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status"class="form-control">
                            <option value="0">Không hiển thị</option>
                            <option value="1">Hiển thị</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Độ phân giải</label>
                        <select name="resolution"class="form-control">
                            <option value="0">HD</option>
                            <option value="1">SD</option>
                            <option value="2">HDCam</option>
                            <option value="3">Cam</option>
                            <option value="4">FullHD</option>
                            <option value="5">Trailer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Sub</label>
                        <select name="sub"class="form-control">
                            <option value="0">Phụ đề</option>
                            <option value="1">Thuyết minh</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Thuộc phim</label>
                        <select name="belong_movie" id="" class="form-control">
                            <option value="phimle">Phim lẻ</option>
                            <option value="phimbo">Phim bộ</option>
                        </select>
                    </div>
                    <div class="form-group">

                        <div class="mt-3">
                            <label for=""class="form-label">Danh mục phim</label>
                        </div>
                        <div class="mb-3">
                            @foreach ($category as $item)
                                <input type="checkbox" name="category[]" value="{{ $item->id }}">
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
                                <input type="checkbox" name="genre[]" value="{{ $item->id }}">
                                <label for="">{{ $item->title }}</label>
                            @endforeach
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="">Quốc gia</label>
                        <select name="country_id"class="form-control">
                            @foreach ($country as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">PHIM HOT</label>
                        <select name="phim_hot"class="form-control">
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file"name="image" class="form-control-file">
                    </div>


                    <button type="submit"class="btn btn-primary">Thêm phim</button>



                    @csrf
                </form>
            </div>
        </div>

    </div>
@endsection

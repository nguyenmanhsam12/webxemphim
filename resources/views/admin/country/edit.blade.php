@extends('admin.index')

@section('content')
    <div class="content">
        <div class="container-fluid" style="margin-top:50px;">
            <div class="row">
                <h1>Sửa quốc gia phim</h1>
                <div class="col-md-6">
                    <form action="{{route('admin.country.update',['id'=>$country->id])}}"method="POST">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text"class="form-control" placeholder="Nhập tên title" name="title"id="slug" onkeyup="ChangeToSlug()"
                            value="{{ $country->title }}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text"class="form-control" placeholder="Nhập tên slug" name="slug" id="convert_slug"
                            value="{{$country->slug}}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea cols="30" rows="10"name="description"class="form-control">{{$country->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status"class="form-control">
                                <option value="0" {{ $country->status == 0 ? 'selected' : ''}}>Không hiển thị</option>
                                <option value="1" {{ $country->status == 1 ? 'selected' : ''}}>Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

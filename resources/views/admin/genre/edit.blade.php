@extends('admin.index')

@section('content')
    <div class="content">
        <div class="container-fluid" style="margin-top:50px;">
            <div class="row">
                <h1>Sửa sản phẩm</h1>
                <div class="col-md-6">
                    <form action="{{route('admin.genre.update',['id'=>$genre->id])}}"method="POST">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text"class="form-control" placeholder="Nhập tên title" name="title"id="slug" onkeyup="ChangeToSlug()"
                            value="{{ $genre->title }}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text"class="form-control" placeholder="Nhập tên slug" name="slug" id="convert_slug"
                            value="{{$genre->slug}}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea cols="30" rows="10"name="description"class="form-control">{{$genre->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status"class="form-control">
                                <option value="0" {{ $genre->status == 0 ? 'selected' : ''}}>Không hiển thị</option>
                                <option value="1" {{ $genre->status == 1 ? 'selected' : ''}}>Hiển thị</option>
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

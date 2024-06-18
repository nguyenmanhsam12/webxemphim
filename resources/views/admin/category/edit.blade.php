@extends('admin.index')

@section('content')
    <div class="content">
        <div class="container-fluid" style="margin-top:50px;">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('admin.category.update',['id'=>$category->id])}}"method="POST">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text"class="form-control" placeholder="Nhập tên title" name="title"id="slug" onkeyup="ChangeToSlug()"
                            value="{{ $category->title }}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text"class="form-control" placeholder="Nhập tên slug" name="slug" id="convert_slug"
                            value="{{$category->slug}}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea cols="30" rows="10"name="description"class="form-control">{{$category->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status"class="form-control">
                                <option value="0" {{ $category->status == 0 ? 'selected' : ''}}>Không hiển thị</option>
                                <option value="1" {{ $category->status == 1 ? 'selected' : ''}}>Hiển thị</option>
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

@extends('admin.index')

@section('content')
    <div class="content">
        <div class="container-fluid" style="margin-top:50px;">
            <div class="row">
                <div class="col-md-6">
                    <h1>Thêm danh mục phim</h1>
                    <form action="{{route('admin.info.update',['id'=>$info->id])}}"method="POST"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tiều đề website</label>
                            <input type="text"class="form-control" placeholder="..." name="title" value={{ $info->title }}
                            >
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả website</label>
                            <textarea cols="30" rows="10"name="description"class="form-control">{{ $info->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Logo website</label><br>
                            <input type="file"name="logo" class="form-control-file">
                            @if ($info)
                            <div class="row">
                                <img src="{{ asset('uploads/logo/' . $info->logo) }}"width="200" height="200">
                            </div>
                        @endif
                        </div>
                   
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

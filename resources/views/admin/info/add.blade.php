@extends('admin.index')

@section('content')
    <div class="content">
        <div class="container-fluid" style="margin-top:50px;">
            <div class="row">
                <div class="col-md-6">
                    <h1>Thêm danh mục phim</h1>
                    <form action="{{route('admin.info.postStore')}}"method="POST"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tiều đề website</label>
                            <input type="text"class="form-control" placeholder="..." name="title"
                            >
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả website</label>
                            <textarea cols="30" rows="10"name="description"class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Logo website</label><br>
                            <input type="file"name="logo" class="form-control-file">
                        </div>
                   
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

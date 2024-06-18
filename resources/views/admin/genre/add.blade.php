@extends('admin.index')

@section('content')
    <div class="content">
        <div class="container-fluid" style="margin-top:50px;">
            <h1>Thêm thể loại</h1>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('admin.genre.postStore')}}"method="POST">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text"class="form-control" placeholder="Nhập tên title" name="title"
                            id="slug" onkeyup="ChangeToSlug()"
                            >
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text"class="form-control" placeholder="Nhập tên slug" name="slug" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea cols="30" rows="10"name="description"class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status"class="form-control">
                                <option value="0">Không hiển thị</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

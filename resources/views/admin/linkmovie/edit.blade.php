@extends('admin.index')

@section('content')
    <div class="content">
        <div class="container-fluid" style="margin-top:50px;">
            <div class="row">
                <div class="col-md-6">
                    <h1>Thêm Link phim</h1>
                    <form action="{{route('admin.linkmovie.update',['id'=>$linkphim->id])}}"method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Link phim</label>
                            <input type="text"class="form-control" placeholder="..." name="title"
                            value="{{$linkphim->title}}"
                            >
                        </div>
                     
                     
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea cols="30" rows="10"name="description"class="form-control">{{$linkphim->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="status"class="form-control">
                                <option value="0" {{$linkphim->status == 0 ? 'selected' : ''}}>Không hiển thị</option>
                                <option value="1" {{$linkphim->status == 1 ? 'selected' : ''}}>Hiển thị</option>
                            </select>
                        </div>
                   
                        <button type="submit" class="btn btn-primary mt-3">Cập nhập</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

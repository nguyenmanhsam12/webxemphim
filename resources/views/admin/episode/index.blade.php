@extends('admin.index')


@section('content')
    <a href="{{ route('admin.episode.add') }}">
        <button class="btn btn-primary"style="margin-top:50px;">
            Thêm mới
        </button>
    </a>
    <h1>Quản lý tập phim</h1>
    <div class="col-md-12">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Link phim</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_episode as $episode)
                   
                    <tr>
                        <td>{{$episode->id}}</td>
                        <td>{{$episode->movie->title}}</td>
                        <td>{{$episode->practice}}</td>
                        <td>{{$episode->linkphim}}</td>
                        <td></td>
                        <td>
                            <a href="{{route('admin.episode.edit',['id'=>$episode->id])}}">
                                <button class="btn btn-warning">Sửa</button>
                                </a>
                                <a href="{{route('admin.episode.delete',['id'=>$episode->id])}}"onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                <button class="btn btn-danger">Xóa</button>
                                </a>
                        </td>
                    </tr>
                  
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

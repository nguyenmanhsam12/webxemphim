@extends('admin.index')


@section('content')
    <a href="{{ route('admin.episode.add') }}">
        <button class="btn btn-primary"style="margin-top:50px;">
            Thêm mới
        </button>
    </a>
    <h1>Quản lý tập phim</h1>

    <div class="col-md-6">
        <form action="{{ route('admin.episode.postStore') }}"method="POST">
            <div class="form-group">
                <label for="">Chọn phim</label>
                <input type="text"name="movie_title"class="form-control"value="{{$movie->title}}"readonly>
                <input type="hidden"name="movie_id"value="{{$movie->id}}">
            </div>
            <div class="form-group mt-3">
                <label for="">Linkphim</label>
                <input type="text" name="linkphim" placeholder="...." class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="">Tập phim</label>
                <select name="practice" class="form-control" id="show_movie">
                    @for ($i = 1; $i <= $movie->episode; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor

                </select>
            </div>
            <div class="form-group mt-3">
                <label for="">Link Server</label>
                <select name="linkserver" class="form-control">
                    @foreach ($linkphim as $lp)
                        <option value="{{$lp->id}}" >{{$lp->title}}</option>
                    @endforeach

                </select>
            </div>



            <button type="submit" class="btn btn-primary mt-3">Thêm tập phim</button>
            @csrf
        </form>
    </div>
    <hr>
    <div class="col-md-12">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Link phim</th>
                    <th scope="col">Link server</th>
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
                        <td>
                            {{$episode->server}}
                        </td>
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

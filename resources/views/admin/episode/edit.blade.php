@extends('admin.index')

@section('content')
    <div class="content">
        <div class="container-fluid" style="margin-top:50px;">
            <h1>Thêm tập phim</h1>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.episode.update',['id'=>$episode->id]) }}"method="POST">
                        <div class="form-group">
                            <label for="">Chọn phim</label>
                            <select name="movie_id" id="" class="form-control select-movie">
                                <option value="0">Chọn phim</option>
                                @foreach ($list_movie as $mov)
                                    <option value="{{ $mov->id }}" {{ $episode->movie_id == $mov->id ? 'selected' : '' }}>{{ $mov->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Linkphim</label>
                            <input type="text" name="linkphim" placeholder="...." class="form-control"value="{{$episode->linkphim}}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Tập phim</label>
                            <input type="text"name="practice" class="form-control" value="{{$episode->practice}}"readonly>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Link Server</label>
                            <select name="linkserver" class="form-control">
                                @foreach ($linkphim as $lp)
                                    <option value="{{$lp->id}}" {{$lp->id == $episode->server ? 'selected' : ''}}>{{$lp->title}}</option>
                                @endforeach
            
                            </select>
                        </div>
            

                        <button type="submit" class="btn btn-primary mt-3">Cập nhập phim</button>
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

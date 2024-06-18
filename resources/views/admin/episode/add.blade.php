@extends('admin.index')

@section('content')
    <div class="content">
        <div class="container-fluid" style="margin-top:50px;">
            <h1>Thêm tập phim</h1>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.episode.postStore') }}"method="POST">
                        <div class="form-group">
                            <label for="">Chọn phim</label>
                            <select name="movie_id" id="" class="form-control select-movie">
                                <option value="0">Chọn phim</option>
                                @foreach ($list_movie as $mov)
                                    <option value="{{ $mov->id }}">{{ $mov->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Linkphim</label>
                            <input type="text" name="linkphim" placeholder="...." class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Tập phim</label>
                            <select name="practice" class="form-control" id="show_movie">
                             

                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Thêm tập phim</button>
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@extends('admin.index')


@section('content')
    <div class="col-md-12">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Tên chính thức</th>
                    <th scope="col">Hình Ảnh phim</th>
                    <th scope="col">Hình Ảnh poster</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Id</th>
                    <th scope="col">Năm phim</th>
                    <th scope="col">Quản lý</th>

                </tr>
            </thead>
            <tbody class="order_position">
                @foreach ($resp['items'] as $key => $res)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $res['name'] }}</td>
                        <td>{{ $res['origin_name'] }}</td>
                        <td><img src="{{ $resp['pathImage'] . $res['thumb_url'] }}" alt=""width="80px"
                                height="100">
                        </td>
                        <td><img src="{{ $resp['pathImage'] . $res['poster_url'] }}" alt=""width="80px"
                                height="100">
                        </td>
                        <td>{{ $res['slug'] }}</td>
                        <td>{{ $res['_id'] }}</td>
                        <td>{{ $res['year'] }}</td>

                        <td>




                            <a href="{{ route('leech-details', $res['slug']) }}" class="btn btn-primary btn-sm">Chi tiết
                                phim</a>
                            <a href="{{ route('leech-episode', $res['slug']) }}" class="btn btn-warning btn-sm">Xem tập
                                phim</a>


                            @php
                                $movie = \App\Models\Movie::where('slug', $res['slug'])->first();
                            @endphp

                            @if (!$movie)
                                <form action="{{ route('leech-store', $res['slug']) }}" method="post">
                                    @csrf
                                    <input type="submit"class="btn btn-success btn-sm" value="Add_movie">
                                </form>
                            @else
                                <a href="{{ route('admin.movie.delete', $movie->id) }}" class="btn btn-danger btn-sm">Xóa
                                    phim</a>
                            @endif

                        </td>




                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

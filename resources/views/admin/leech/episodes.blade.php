@extends('admin.index')


@section('content')
    
    <div class="col-md-12">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Link Embed</th>
                    <th scope="col">Link M3u8</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Slug phim</th>
                    <th scope="col">Số tập</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Quản lý</th>

                </tr>
            </thead>
            <tbody class="order_position">
                @foreach ($resp['episodes'] as $key => $res)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>
                            @foreach ($res['server_data'] as $key => $server_1)
                                <ul>
                                    <li>Tập {{ $server_1['name'] }}
                                        <input type="text" class="form-control" value={{ $server_1['link_embed'] }}>
                                    </li>

                                </ul>
                            @endforeach
                        </td>
                        <td>
                            @foreach($res['server_data'] as $key => $server_2)
                                <ul>
                                    <li>Tập {{ $server_2['name'] }}
                                        <input type="text" class="form-control" value={{ $server_1['link_m3u8'] }}>
                                    </li>

                                </ul>
                            @endforeach
                        </td>
                        <td>{{ $resp['movie']['name'] }}</td>
                        <td>{{ $resp['movie']['slug'] }}</td>
                        <td>{{ $resp['movie']['episode_total'] }}</td>

                        <td>
                            {{ $res['server_name'] }}
                        </td>
                        <td>
                            <form  action="{{route('episode-store',$resp['movie']['slug'])}}" method="post">
                                @csrf
                                <input type="submit"value="Thêm tập phim" class="btn btn-success btn-sm">
                            </form>

                            <form action="POST" action="">
                                @csrf
                                <input type="submit"value="Xóa tập phim" class="btn btn-danger btn-sm">
                            </form>

                        </td>



                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('admin.index')


@section('content')
   
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">_id</th>
                        <th scope="col">name</th>
                        <th scope="col">slug</th>
                        <th scope="col">origin_name</th>
                        <th scope="col">content</th>
                        <th scope="col">type</th>
                        <th scope="col">status</th>
                        <th scope="col">thumb_url</th>
                        <th scope="col">poster_url</th>
                        <th scope="col">time</th>
                        <th scope="col">episode_current</th>
                        <th scope="col">episode_total</th>
                        <th scope="col">quality</th>
                        <th scope="col">lang</th>
                        <th scope="col">year</th>
                        <th scope="col">actor</th>
                        <th scope="col">director</th>
                        <th scope="col">category</th>
                        <th scope="col">country</th>
                       



                    </tr>
                </thead>
                <tbody class="order_position">
                    @foreach ($resp_movie as $key => $res)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $res['_id'] }}</td>
                            <td>{{ $res['name'] }}</td>
                            <td>{{ $res['slug'] }}</td>
                            <td>{{ $res['origin_name'] }}</td>
                            <td>{!! $res['content'] !!}</td>

                            <td>{{ $res['type'] }}</td>
                            <td>{{ $res['status'] }}</td>
                            <td><img src="{{ $res['thumb_url'] }}" alt=""width="80px" height="80px"></td>
                            <td><img src="{{ $res['poster_url'] }}" alt=""width="80px" height="80px"></td>
                            <td>{{ $res['time'] }}</td>

                            <td>{{ $res['episode_current'] }}</td>
                            <td>{{ $res['episode_total'] }}</td>
                            <td>{{ $res['quality'] }}</td>
                            <td>{{ $res['lang'] }}</td>
                            <td>{{ $res['year'] }}</td>
                            <td>
                                @foreach ($res['actor'] as $actor)
                                    <span class="badge text-bg-dark">{{ $actor }}</span>
                                @endforeach
                            </td>

                            <td>
                                @foreach ($res['director'] as $director)
                                    <span class="badge text-bg-dark">{{ $director }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($res['category'] as $category)
                                    <span class="badge text-bg-dark">{{ $category['name'] }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($res['country'] as $country)
                                    <span class="badge text-bg-dark">{{ $country['name'] }}</span>
                                @endforeach
                            </td>









                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

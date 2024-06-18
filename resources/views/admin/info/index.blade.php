@extends('admin.index')


@section('content')
    <a href="{{route('admin.info.add')}}">
        <button class="btn btn-primary mb-2"style="margin-top:50px;">
            Thêm mới
        </button>
    </a>
    <div class="col-md-12">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tiều đề website</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody class="order_position">
                @foreach ($info as $item)
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->description}}</td>
                    <td></td>
                    <td>
                        <a href="{{ route('admin.info.edit', ['id' => $item->id]) }}">
                            <button class="btn btn-warning">Sửa</button>
                        </a>
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

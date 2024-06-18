@extends('admin.index')


@section('content')
    <a href="{{ route('admin.category.add') }}">
        <button class="btn btn-primary"style="margin-top:50px;">
            Thêm mới
        </button>
    </a>
    <div class="col-md-12">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Link phim</th>
                    <th scope="col">Mô tả link</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody class="order_position">
                @foreach ($linkphim as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->status }}</td>
    
                        <td>
                            <a href="{{route('admin.linkmovie.edit',['id'=>$item->id])}}">
                            <button class="btn btn-warning">Sửa</button>
                            </a>
                            <a href="{{route('admin.linkmovie.delete',['id'=>$item->id])}}"onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                            <button class="btn btn-danger">Xóa</button>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

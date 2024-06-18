@extends('admin.index')


@section('content')
    <a href="{{route('admin.country.add')}}">
        <button class="btn btn-primary"style="margin-top:50px;">
            Thêm mới
        </button>
    </a>
    <h1>Quản lý quốc gia phim</h1>
    <div class="col-md-12">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listCategory as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->slug}}</td>

                        <td>
                            @if ($item->status)
                                Hiển thị
                            @else
                                Không hiển thị                                    
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.country.edit',['id'=>$item->id])}}">
                            <button class="btn btn-warning">Sửa</button>
                            </a>
                            <a href="{{route('admin.country.delete',['id'=>$item->id])}}"onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                            <button class="btn btn-danger">Xóa</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

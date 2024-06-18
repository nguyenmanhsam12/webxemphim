@extends('admin.index')

@section('content')
    <div class="container" style="margin-top:20px;">
        <h1 class="">Sắp xếp phim</h1>
    </div>
    <style>
        
        .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
    </style>
    <nav class="navbar navbar-primary bg-dark">
        <div class="container-fluid">
            <ul class="nav navbar-nav" id="sortable_navbar">
                <li class="active ui-state-default"><a href="{{ url('/') }}">Trang chủ</a></li>
                @foreach ($category as $item)
                    <li><a title="{{ $item->title }}"class="ui-state-default"
                        href="{{ route('category', $item->slug) }}">{{ $item->title }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
    </nav>
@endsection

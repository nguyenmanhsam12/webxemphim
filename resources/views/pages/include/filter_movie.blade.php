<style>
    .stylist_filter {
        border: 0;
        background: #12171b;
        color: #fff;
    }

    .btn_filter {
        border: 0 #218ae1;
        background-color: #12171b;
        color: #fff;
        padding: 9px;
    }
</style>


<form action="{{ route('loc-phim') }}"method="GET">


    <div class="col-md-2">

        <div class="form-group">
            <select name="order" id=""class="form-control stylist_filter">
                <option value="">-Sắp xếp-</option>
                <option value="create">Ngày đăng mới nhất</option>
                <option value="year">Năm sản xuất</option>
                <option value="title">Tên Phim</option>
                <option value="topview">Lượt xem</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <select name="genre" id=""class="form-control stylist_filter">
                <option value="">-Thể loại-</option>
                @foreach ($genre as $gen_filter)
                    <option value="{{ $gen_filter->id }}" {{ isset($_GET['genre']) && $_GET['genre'] == $gen_filter->id ? 'selected' : '' }}>{{ $gen_filter->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">

        <div class="form-group">
            <select name="country" id=""class="form-control stylist_filter">
                <option value="">-Quốc gia-</option>

                @foreach ($country as $cout_filter)
                    <option value="{{ $cout_filter->id }}" {{ isset($_GET['country']) && $_GET['country'] == $cout_filter->id ? 'selected' : '' }}>{{ $cout_filter->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">

        <div class="form-group">
            <select class="select-year form-control stylist_filter" name="year">
                <option value="">--Năm Phim--</option>
                <option value="2011" {{ isset($_GET['year']) && $_GET['year'] == 2011 ? 'selected' : '' }}>2011</option>
                <option value="2012" {{ isset($_GET['year']) && $_GET['year'] == 2012 ? 'selected' : '' }}>2012</option>
                <option value="2013" {{ isset($_GET['year']) && $_GET['year'] == 2013 ? 'selected' : '' }}>2013</option>
                <option value="2014" {{ isset($_GET['year']) && $_GET['year'] == 2014 ? 'selected' : '' }}>2014</option>
                <option value="2015" {{ isset($_GET['year']) && $_GET['year'] == 2015 ? 'selected' : '' }}>2015</option>
                <option value="2016" {{ isset($_GET['year']) && $_GET['year'] == 2016 ? 'selected' : '' }}>2016</option>
                <option value="2017" {{ isset($_GET['year']) && $_GET['year'] == 2017 ? 'selected' : '' }}>2017</option>
                <option value="2018" {{ isset($_GET['year']) && $_GET['year'] == 2018 ? 'selected' : '' }}>2018</option>
                <option value="2019" {{ isset($_GET['year']) && $_GET['year'] == 2019 ? 'selected' : '' }}>2019</option>
                <option value="2020" {{ isset($_GET['year']) && $_GET['year'] == 2020 ? 'selected' : '' }}>2020</option>
                <option value="2021" {{ isset($_GET['year']) && $_GET['year'] == 2021 ? 'selected' : '' }}>2021</option>
                <option value="2022" {{ isset($_GET['year']) && $_GET['year'] == 2022 ? 'selected' : '' }}>2022</option>
                <option value="2023" {{ isset($_GET['year']) && $_GET['year'] == 2023 ? 'selected' : '' }}>2023</option>
                <option value="2024" {{ isset($_GET['year']) && $_GET['year'] == 2024 ? 'selected' : '' }}>2024</option>
            </select>

        </div>
    </div>

    <input type="submit" value="Lọc phim" class="btn btn-sm btn-default btn_filter">

</form>


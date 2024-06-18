<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Info;
use App\Models\Country;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Sử dụng để hiển thị các dữ liệu chung ra view

        //Thống kê đếm số lượng bản ghi
        $category_total = Category::all()->count();
        $country_total = Country::all()->count();
        $genre_total = Genre::all()->count();
        $movie_total = Movie::all()->count();



        $info = Info::all();
        View::share([
            'info'=>$info,
            'category_total'=>$category_total,
            'country_total'=>$country_total,
            'genre_total'=>$genre_total,
            'movie_total'=>$movie_total
        ]);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
//Admin controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LinkMovieController;
use App\Http\Controllers\LoginGoogleController;

use App\Http\Controllers\LeechMovieController;








use App\Http\Controllers\Dashboard;

//middleware
use App\Http\Middleware\AuthenticationMiddleware;
use App\Http\Middleware\LoginMiddleware;

use App\Http\Controllers\LoginController;



//Giao diện
Route::get('/',[IndexController::class,'home'])->name('homepage');
Route::get('/danh-muc/{slug}',[IndexController::class,'category'])->name('category');
Route::get('/the-loai/{slug}',[IndexController::class,'genre'])->name('genre');
Route::get('/quoc-gia/{slug}',[IndexController::class,'country'])->name('country');
Route::get('/phim/{slug}',[IndexController::class,'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}/{server_actice}',[IndexController::class,'watch'])->name('watch');
Route::get('/episode',[IndexController::class,'episode'])->name('episode');
Route::get('/nam/{year}',[IndexController::class,'year']);
Route::get('/tags/{tag}',[IndexController::class,'tag']);
Route::get('/tim-kiem',[IndexController::class,'timkiem'])->name('tim-kiem');
Route::get('/loc-phim',[IndexController::class,'loc_phim'])->name('loc-phim');

//login bằng google
Route::get('auth/google',[LoginGoogleController::class,'redirectToGoogle'])->name('login-by-google');
Route::get('auth/google/callback',[LoginGoogleController::class,'handleGoogleCallback']);





//Login
Route::get('/login',[LoginController::class,'index'])->name('loginAdmin')->middleware(LoginMiddleware::class);
Route::post('aulogin',[LoginController::class,'postlogin'])->name('auth.login');
Route::get('logout',[LoginController::class,'Aulogout'])->name('auth.logout');

//Admin route
Route::prefix('admin')->group(function(){
    Route::get('index',[Dashboard::class,'index'])->name('admin.index')->middleware(AuthenticationMiddleware::class);
    Route::prefix('info')->group(function(){
        Route::get('list',[InfoController::class,'index'])->name('admin.info.list');
        Route::get('add',[InfoController::class,'create'])->name('admin.info.add');
        Route::post('postStore',[InfoController::class,'store'])->name('admin.info.postStore');
        // Route::get('delete/{id}',[MovieController::class,'Delete'])->name('admin.category.delete');
        Route::get('edit/{id}',[InfoController::class,'Edit'])->name('admin.info.edit');
        Route::post('update/{id}',[InfoController::class,'Update'])->name('admin.info.update');

    });
    Route::prefix('linkmovie')->group(function(){
        Route::get('list',[LinkMovieController::class,'index'])->name('admin.linkmovie.list');
        Route::get('add',[LinkMovieController::class,'create'])->name('admin.linkmovie.add');
        Route::post('postStore',[LinkMovieController::class,'store'])->name('admin.linkmovie.postStore');
        Route::get('delete/{id}',[LinkMovieController::class,'Delete'])->name('admin.linkmovie.delete');
        Route::get('edit/{id}',[LinkMovieController::class,'Edit'])->name('admin.linkmovie.edit');
        Route::post('update/{id}',[LinkMovieController::class,'Update'])->name('admin.linkmovie.update');

    });
    Route::prefix('category')->group(function(){
        Route::get('list',[CategoryController::class,'index'])->name('admin.category.list');
        Route::get('add',[CategoryController::class,'create'])->name('admin.category.add');
        Route::post('postStore',[CategoryController::class,'store'])->name('admin.category.postStore');
        Route::get('delete/{id}',[CategoryController::class,'Delete'])->name('admin.category.delete');
        Route::get('edit/{id}',[CategoryController::class,'Edit'])->name('admin.category.edit');
        Route::post('update/{id}',[CategoryController::class,'Update'])->name('admin.category.update');

    });
    Route::prefix('genre')->group(function(){
        Route::get('list',[GenreController::class,'index'])->name('admin.genre.list');
        Route::get('add',[GenreController::class,'create'])->name('admin.genre.add');
        Route::post('postStore',[GenreController::class,'store'])->name('admin.genre.postStore');
        Route::get('delete/{id}',[GenreController::class,'Delete'])->name('admin.genre.delete');
        Route::get('edit/{id}',[GenreController::class,'Edit'])->name('admin.genre.edit');
        Route::post('update/{id}',[GenreController::class,'Update'])->name('admin.genre.update');
        
    });
    Route::prefix('country')->group(function(){
        Route::get('list',[CountryController::class,'index'])->name('admin.country.list');
        Route::get('add',[CountryController::class,'create'])->name('admin.country.add');
        Route::post('postStore',[CountryController::class,'store'])->name('admin.country.postStore');
        Route::get('delete/{id}',[CountryController::class,'Delete'])->name('admin.country.delete');
        Route::get('edit/{id}',[CountryController::class,'Edit'])->name('admin.country.edit');
        Route::post('update/{id}',[CountryController::class,'Update'])->name('admin.country.update');

    });
    Route::prefix('movie')->group(function(){
        Route::get('list',[MovieController::class,'index'])->name('admin.movie.list');
        Route::get('add',[MovieController::class,'create'])->name('admin.movie.add');
        Route::post('postStore',[MovieController::class,'store'])->name('admin.movie.postStore');
        Route::get('delete/{id}',[MovieController::class,'Delete'])->name('admin.movie.delete');
        Route::get('edit/{id}',[MovieController::class,'Edit'])->name('admin.movie.edit');
        Route::post('update/{id}',[MovieController::class,'Update'])->name('admin.movie.update');
        Route::get('sort_movie',[MovieController::class,'sort_movie'])->name('sort_movie');

    });
    Route::prefix('episode')->group(function(){
        Route::get('list',[EpisodeController::class,'index'])->name('admin.episode.list');
        Route::get('add',[EpisodeController::class,'create'])->name('admin.episode.add');
        Route::post('postStore',[EpisodeController::class,'store'])->name('admin.episode.postStore');
        Route::get('delete/{id}',[EpisodeController::class,'Delete'])->name('admin.episode.delete');
        Route::get('edit/{id}',[EpisodeController::class,'Edit'])->name('admin.episode.edit');
        Route::post('update/{id}',[EpisodeController::class,'Update'])->name('admin.episode.update');
        Route::get('/add-episode/{id}',[EpisodeController::class,'add_episode'])->name('add-episode');

    });

});

//Những router có ajax
Route::get('/update-year-phim',[MovieController::class,'update_year']);
Route::get('/update-topview-phim',[MovieController::class,'update_topview']);
Route::get('/filter-topview-phim',[MovieController::class,'filter_topview']);
Route::post('/update-season-phim',[MovieController::class,'update_season']);
Route::get('select-movie',[EpisodeController::class,'select_movie'])->name('select-movie');
Route::get('category-choose',[MovieController::class,'category_choose'])->name('category-choose');
Route::get('country-choose',[MovieController::class,'country_choose'])->name('country-choose');
Route::get('trangthai-choose',[MovieController::class,'trangthai_choose'])->name('trangthai-choose');
Route::get('thuocphim-choose',[MovieController::class,'thuocphim_choose'])->name('thuocphim-choose');
Route::get('phimhot-choose',[MovieController::class,'phimhot_choose'])->name('phimhot-choose');
Route::get('resolution-choose',[MovieController::class,'resolution_choose'])->name('resolution-choose');
Route::post('watch-video',[MovieController::class,'watch_video'])->name('watch-video');
Route::get('sub-choose',[MovieController::class,'sub_choose'])->name('sub-choose');

//Lấy dữ liệu phim bằng api
// Route leech movie
Route::get('leech-movie',[LeechMovieController::class,'leech_movie'])->name('leech-movie');
Route::get('/leech-details/{slug}',[LeechMovieController::class,'leech_details'])->name('leech-details');
Route::get('/leech-episode/{slug}',[LeechMovieController::class,'leech_episode'])->name('leech-episode');
Route::post('/leech-store/{slug}',[LeechMovieController::class,'leech_store'])->name('leech-store');

Route::post('/episode-store/{slug}',[LeechMovieController::class,'episode_store'])->name('episode-store');

























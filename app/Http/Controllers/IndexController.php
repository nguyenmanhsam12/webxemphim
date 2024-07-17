<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\movie_genre;
use App\Models\Movie_Category;
use App\Models\Info;
use App\Models\LinkMovie;



use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    private $category;
    private $country;
    private $genre;

    public function __construct(Category $category, Genre $genre, Country $country)
    {
        $this->category = $category;
        $this->genre = $genre;
        $this->country = $country;
    }

    public function timkiem()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
            $genre = $this->genre->orderBy('id', 'desc')->get();
            $country = $this->country->orderBy('id', 'desc')->get();
            $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(5)->get();
            $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();


            $movie = Movie::withCount('practice')->where('title', 'LIKE', '%' . $search . '%')->orderBy('update', 'DESC')->paginate(10);
            return view('pages.search', compact('category', 'country', 'genre', 'search', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
        } else {
            redirect()->to('/');
        }
    }

    public function home()
    {
        
        $phimhot = Movie::withCount('practice')->where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(5)->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();
        $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
        $genre = $this->genre->orderBy('id', 'desc')->get();
        $country = $this->country->orderBy('id', 'desc')->get();

        //nested trong laravel
        $category_home = $this->category->with(['movie' => function ($q) {
            $q->withCount('practice')->where('status',1);
        }])->orderBy('id', 'desc')->where('status', 1)->get();
        
        return view('pages.home', compact('category', 'country', 'genre', 'category_home', 'phimhot', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function category($slug)
    {

        $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
        $genre = $this->genre->orderBy('id', 'desc')->get();
        $country = $this->country->orderBy('id', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(5)->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();

        //Lấy danh mục dựa theo slug và lấy duy nhất 1 bản ghi
        $cate_slug = $this->category->where('slug', $slug)->first();

        //Lấy phim dựa theo id của category_slug
        $movie = Movie::withCount('practice')->where('category_id', $cate_slug->id)->orderBy('update', 'DESC')->paginate(10);
        
         //Nhiều danh mục
         $movie_category = Movie_Category::where('category_id', $cate_slug->id)->get();
         $many_category = [];
         foreach ($movie_category as $key => $movi) {
             $many_category[] = $movi->movie_id;
         }  
 
         $movie = Movie::withCount('practice')->whereIn('id', $many_category)->orderBy('update', 'DESC')->paginate(10);


        return view('pages.category', compact('category', 'country', 'genre', 'cate_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }

    public function genre($slug)
    {
        $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
        $genre = $this->genre->orderBy('id', 'desc')->get();
        $country = $this->country->orderBy('id', 'desc')->get();
        $genre_slug = $this->genre->where('slug', $slug)->first();
        
        $phimhot_sidebar = Movie::withCount('practice')->where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(15)->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();

        //Nhiều thể loại 
        $movie_genre = movie_genre::where('genre_id', $genre_slug->id)->get();
        
        $many_genre = [];

        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }

        $movie = Movie::withCount('practice')->whereIn('id', $many_genre)->orderBy('update', 'DESC')->paginate(10);

        return view('pages.genre', compact('category', 'country', 'genre', 'genre_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }

    public function year($year)
    {

        $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
        $genre = $this->genre->orderBy('id', 'desc')->get();
        $country = $this->country->orderBy('id', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(15)->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();

        //Lấy danh mục dựa theo slug và lấy duy nhất 1 bản ghi
        $year = $year;

        //Lấy phim dựa theo id của category_slug
        $movie = Movie::withCount('practice')->where('year', $year)->orderBy('update', 'DESC')->paginate(10);



        return view('pages.year', compact('category', 'country', 'genre', 'year', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }

    public function tag($tag)
    {
        $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
        $genre = $this->genre->orderBy('id', 'desc')->get();
        $country = $this->country->orderBy('id', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(15)->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();

        $tag = $tag;

        $movie = Movie::withCount('practice')->where('tags', 'LIKE', '%' . $tag . '%')->orderBy('update', 'DESC')->paginate(10);

        return view('pages.tags', compact('category', 'country', 'genre', 'movie', 'tag', 'phimhot_sidebar', 'phimhot_trailer'));
    }

    
    public function country($slug)
    {

        $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
        $genre = $this->genre->orderBy('id', 'desc')->get();
        $country = $this->country->orderBy('id', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(15)->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();

        $country_slug = $this->country->where('slug', $slug)->first();

        $movie = Movie::withCount('practice')->where('country_id', $country_slug->id)->orderBy('update', 'DESC')->paginate(10);


        return view('pages.country', compact('category', 'country', 'genre', 'country_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function movie($slug)
    {

        $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
        $genre = $this->genre->orderBy('id', 'desc')->get();
        $country = $this->country->orderBy('id', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(15)->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();

        $movie = Movie::with('category', 'country', 'genre', 'movie_genre','movie_category')->where('slug', $slug)->where('status', 1)->first();
        //Lấy các tập mới nhất 3 tập
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('practice', 'desc')->take(3)->get();

        //Lấy tập đầu 1  
        $episode_tapdau = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('practice', 'asc')->take(1)->first();

        //Lấy tổng tập phim 
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();
        // dd($episode_current_list_count); 


        $movie_related = Movie::with('category', 'country', 'genre')->where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->get();
        // dd($movie_related);  


        //Tăng lượt quan tâm
        $count_views = $movie->count_views;
        $count_views = $count_views + 1;
        $movie->count_views = $count_views;
        $movie->save();

        return view('pages.movie', compact('category', 'country', 'genre', 'movie', 'movie_related', 'phimhot_sidebar', 'phimhot_trailer', 'episode', 'episode_tapdau', 'episode_current_list_count'));
    }
    public function watch($slug, $tap , $server_actice)
    {

        $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
        $genre = $this->genre->orderBy('id', 'desc')->get();
        $country = $this->country->orderBy('id', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(15)->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();

        $movie = Movie::with('category', 'country', 'genre', 'movie_genre', 'practice','movie_category')->where('slug', $slug)->where('status', 1)->first();

        //Lấy tập 1 , fullhd , hd
        if (isset($tap)) {
            $tapphim = $tap;
            //Hàm này dùng để cắt chuỗi
            $tapphim = substr($tap, 4, 20);
            $episode = Episode::where('movie_id', $movie->id)->where('practice', $tapphim)->first();
        } else {
            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('practice', $tapphim)->first();
        }



        //
        $movie_related = Movie::with('category', 'country', 'genre')->where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->get();
        //Lay ra link phim
        $serve = LinkMovie::orderBy('id','desc')->get();

        //Lay ra cac tap phim
        $episode_movie = Episode::where('movie_id',$movie->id)->orderBy('id','asc')->get()->unique('server');
        //lấy ra tất cả các số tập dựa vào movie_id

        $episode_list = Episode::where('movie_id',$movie->id)->orderBy('practice','asc')->get();

        
        //server_actice
        

        return view('pages.watch', compact('category', 'country', 'genre', 'movie', 'phimhot_sidebar', 'phimhot_trailer', 'episode', 'tapphim', 'movie_related','serve','episode_movie','episode_list','server_actice'));
    }
    public function episode()
    {
        return view('pages.episode');
    }

    public function loc_phim()
    {
        $sapxep = $_GET['order'];
        $genre_get = $_GET['genre'];
       
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];

        if ($sapxep == '' && $genre_get == '' && $country_get == '' && $year_get == '') {
            return redirect()->back();
        } else {
            $category = $this->category->orderBy('id', 'desc')->where('status', 1)->get();
            $genre = $this->genre->orderBy('id', 'desc')->get();
            $country = $this->country->orderBy('id', 'desc')->get();
            $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('update', 'DESC')->take(5)->get();
            $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('update', 'DESC')->take(10)->get();

            //Lấy ra phim và đếm số tập
            $movie_array = Movie::withCount('practice');

            
            if($country_get){
                $movie_array = $movie_array->where('country_id',$country_get);
            }
            if($year_get){
                $movie_array = $movie_array->where('year',$year_get);
            }
            if($sapxep){
                $movie_array = $movie_array->orderBy($sapxep,'desc');
            }
            

            $movie_array = $movie_array->with('movie_genre');
            

            $movie = array();

          
            foreach($movie_array as $mov){  // liệt kê tất cả các phim
                foreach($mov->movie_genre as $mov_gen){ //dùng để liệt kê tất cả genre thuộc id phim đó
                    $movie = $movie_array->whereIn('genre_id',[$mov_gen->genre_id]); 
                }
            }

            $movie  = $movie_array->paginate(40);    

            

         return view('pages.locphim', compact('category','country','genre','movie','phimhot_sidebar','phimhot_trailer'));

        }
    }
}

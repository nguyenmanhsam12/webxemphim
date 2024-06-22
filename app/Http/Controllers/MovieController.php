<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Info;


use App\Models\movie_genre;
use App\Models\Movie_Category;


use Carbon\Carbon;


use Illuminate\Support\Facades\File;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class MovieController extends Controller
{
    private $category;
    private $country;
    private $genre;
    private $movie;

    public function __construct(Category $category, Genre $genre, Country $country, Movie $movie)
    {
        $this->category = $category;
        $this->genre = $genre;
        $this->country = $country;
        $this->movie = $movie;
    }


    public function index()
    {
        

        $movie = $this->movie->with('category','movie_genre','genre', 'country')->withCount('practice')->orderBy('id','DESC')->get();

        $category_list = Category::pluck('title','id');
        $country_list =  Country::pluck('title','id');
       

        //public_path() là 1 helper của laravel nó trả về đường dẫn tuyệt đối tới thu mục public
        // định nghĩa đường dẫn tới thư mục json trong public
        $path = public_path()."/json/";

        // is_dir và mkdir là hàm có sẵn của php 
        //is_dir kiểm tra thư mục có tồn tại hay không nếu không thì tạo mới
        if(!is_dir($path)){
            mkdir($path,0777,true); 
            // 0777 quyền 0777 , cho phép tạo các thư mục con nếu cần
        }

        // Lưu trữ dữ liệu phim vào tệp json 
        // hàm json_encode có sẵn của php cho phép chuyển đổi các dữ liệu từ mảng hoặc đối tượng php sang định dạng json
        File::put($path.'movies.json',json_encode($movie));

        return view('admin.movie.index', compact('movie','category_list','country_list'));
    }


    //sap xep phim
    public function sort_movie(){
        $category = Category::orderBy('id','desc')->get();
        return view('admin.movie.sort_movie',compact('category'));
        
    }

    public function category_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->category_id = $data['category_id'];
        $movie->save();
    }

    public function country_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->country_id = $data['country_id'];
        $movie->save();
    }

    public function trangthai_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->status = $data['trangthai_val'];
        $movie->save();
    }

    public function sub_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->sub = $data['sub_val'];
        $movie->save();
    }

    public function thuocphim_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->belong_movie = $data['thuocphim'];
        $movie->save();
    }

    public function phimhot_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->phim_hot = $data['phimhot'];
        $movie->save();
    }

    public function resolution_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->resolution = $data['resolution'];
        $movie->save();
    }

    public function create()
    {   
        
        $category = $this->category->all();
        $genre = $this->genre->all();
        $country = $this->country->all();
        
        return view('admin.movie.add', compact('category', 'genre', 'country'));
    }

    public function store(Request $request)
    {

        $data = $request->all();
        
        $this->movie->title = $data['title'];
        $this->movie->slug = $data['slug'];
        $this->movie->tags = $data['tags'];
        $this->movie->description = $data['description'];
        $this->movie->status = $data['status'];
        // $this->movie->category_id = $data['category_id'];
        $this->movie->country_id = $data['country_id'];
        $this->movie->phim_hot = $data['phim_hot'];
        $this->movie->name_eng = $data['name_eng'];
        $this->movie->trailer = $data['trailer'];
        $this->movie->resolution = $data['resolution'];
        $this->movie->sub = $data['sub'];
        $this->movie->create = Carbon::now('Asia/Ho_Chi_Minh');
        $this->movie->update = Carbon::now('Asia/Ho_Chi_Minh');
        $this->movie->time_movie = $data['time_movie'];
        $this->movie->episode = $data['episode'];
        $this->movie->belong_movie = $data['belong_movie'];
        $this->movie->count_views = rand(100,99999);

        foreach($data['genre'] as $gen){
            $this->movie->genre_id = $gen[0];
        }

        foreach($data['category'] as $cate){
            $this->movie->category_id = $cate[0];
        }

        

        //Thêm hình ảnh

        $get_image = $request->file('image');


        if ($get_image) {

            $get_image_name = $get_image->getClientOriginalName(); //hinhanh1.jpg

            $name_image = current(explode('.', $get_image_name)); //[0]hinhanh [1]jpg

            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //hinhanh1234.jpg

            $get_image->move('uploads/movie/', $new_image);

            $this->movie->image = $new_image;
        }

        $this->movie->save();

        //Thêm nhiều thể loại cho phim
        $this->movie->movie_genre()->attach($data['genre']);
        $this->movie->movie_category()->attach($data['category']);


        return redirect(route('admin.movie.list'));
    }

    public function Delete($id)
    {
        $movie = $this->movie->find($id);

        //Xóa ảnh
        if (file_exists('uploads/movie/' . $movie->image)) {
            unlink('uploads/movie/' . $movie->image);
        }

        //Xóa thể loại
        movie_genre::whereIn('movie_id',[$movie->id])->delete();

        //Xóa danh mục
        Movie_Category::whereIn('movie_id',[$movie->id])->delete();


        //Xóa tập phim
        Episode::whereIn('movie_id',[$movie->id])->delete();

        $movie->delete();

        return redirect(route('admin.movie.list'));
        
    }

    public function Edit($id)
    {
        $category = $this->category->all();
        $genre = $this->genre->all();
        $country = $this->country->all();
        $movie = $this->movie->find($id);

        //lấy dữ liệu và chuyển đổi dữ liệu thành 1 mảng 
        //hàm  toArray() là 1 helper của laravel
        $movie_genre = $movie->movie_genre()->pluck('genre_id')->toArray();
        
        $movie_category = $movie->movie_category()->pluck('category_id')->toArray();

        return view('admin.movie.edit', compact('movie', 'category', 'genre', 'country','movie_genre','movie_category'));
    }

    public function Update($id, Request $request)
    {

        $data = $request->all();
        $movie = $this->movie->find($id);
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->tags = $data['tags'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->country_id = $data['country_id'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->name_eng = $data['name_eng'];
        $movie->trailer = $data['trailer'];
        $movie->resolution = $data['resolution'];
        $movie->sub = $data['sub'];
        $movie->update = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->time_movie = $data['time_movie'];
        $movie->episode = $data['episode'];
        $movie->belong_movie = $data['belong_movie'];
        
        // $movie->count_views = rand(100,99999);

        // $movie->genre_id = $data['genre_id'];
        // $movie->category_id = $data['category_id'];

        foreach($data['genre'] as $gen){
            $this->movie->genre_id = $gen[0];
        }

        //Xử lý cập nhập danh mục
        foreach($data['category'] as $cate){
            $this->movie->category_id = $cate[0];
        }

        //Thêm hình ảnh

        $get_image = $request->file('image');


        if ($get_image) {

            if (file_exists('uploads/movie/' . $movie->image)) {
                unlink('uploads/movie/' . $movie->image);
            } else {
                $get_image_name = $get_image->getClientOriginalName(); //hinhanh1.jpg

                $name_image = current(explode('.', $get_image_name)); //[0]hinhanh [1]jpg

                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //hinhanh1234.jpg

                $get_image->move('uploads/movie/', $new_image);

                $movie->image = $new_image;
            }
        }

        $movie->update();
        

        $movie->movie_genre()->sync($data['genre']);
        $movie->movie_category()->sync($data['category']);

        return redirect(route('admin.movie.list'));
    }

    public function update_year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }

    public function update_season(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->season = $data['season'];
        $movie->save();
    }

    public function update_topview(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }

    public function filter_topview(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview',$data['value'])->orderBy('ngaycapnhap','DESC')->take(20)->get();
    
        $output = '';
        foreach($movie as $mov){
            if($mov->resolution == 0){
                $text  = 'HD';
            }else if($mov->resolution == 1){
                $text  = 'SD';
            }else if($mov->resolution == 2){
                $text = 'HDCam';
            }else{
                $text = 'FullHD';
            }

            $output .= '
            <div class="item ">
                            <a href="'.url('phim/{slug}').'" title="'.$mov->title.'">
                                <div class="item-link">
                                    <img src="'.url('uploads/movie/'.$mov->image).'"
                                        class="lazy post-thumb" alt="'.$mov->title.'"
                                        title="'.$mov->title.'" />
                                    <span class="is_trailer">'.$text.'</span>
                                </div>
                                <p class="title">'.$mov->title.'</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
            ';
           
        }
        echo $output; 
        
    }

    public function watch_video(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $video = Episode::where('movie_id',$data['movie_id'])->where('practice',$data['episode_id'])->first();
        $output['video_title'] = $movie->title.'-tập '.$video->practice;
        $output['video_desc'] = $movie->description;
        $output['video_link'] = $video->linkphim;

        echo json_encode($output);
        
    }



}

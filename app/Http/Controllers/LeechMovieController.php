<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;




use Carbon\Carbon;



class LeechMovieController extends Controller
{

    //Định dạng dữ liệu json Cài đặt Guzzle HTTP Client:composer require guzzlehttp/guzzle

    //Liệt kê phim theo api
    public function leech_movie()
    {
        //Sử dụng facedes http:gửi yêu cầu dữ liệu và nhận lại dữ liêu json
        $resp = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1")->json();
        return  view('admin.leech.index', compact('resp'));
    }
    
    public function leech_episode($slug){
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();
        return  view('admin.leech.episodes', compact('resp'));
    }


    //Thêm tập phim
    public function episode_store(Request $request , $slug){
        $movie = Movie::where('slug',$slug)->first();
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();
        foreach($resp['episodes'] as $key => $res){
            foreach($res['server_data'] as $key => $res_data){
                $ep = new Episode();
                $ep->movie_id = $movie->id;
                $ep->linkphim = "<p>
                <iframe width="100%" height="315" src=" allowfullscreen></iframe>
                </p>"
                $ep->practice = $data['practice'];
                $ep->server = $data['linkserver'];
               
                $ep->save();
            }
            
        }
    }

    //Chi tiết phim
    public function leech_details($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();

        // chuyển đổi thành mảng
        $resp_movie[] = $resp['movie'];

        return  view('admin.leech.details', compact('resp_movie'));
    }

    public function leech_store(Request $request, $slug)
    {
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();

        // chuyển đổi thành mảng
        $resp_movie[] = $resp['movie'];

        $movie = new Movie();

        foreach ($resp_movie as $key => $res) {
            
            $movie->title = $res['name'];
            $movie->slug = $res['slug'];
            $movie->tags = $res['name'].','.$res['slug'];
            $movie->description = $res['content'];
            $movie->status = 1;

            $category = Category::orderBy('id','desc')->first();

            $movie->category_id = $category->id;

            $country = Country::orderBy('id','desc')->first();

            $movie->country_id = $country->id;

            $genre = Genre::orderBy('id','desc')->first();

            $movie->genre_id = $genre->id;

            $movie->phim_hot = 1;

            $movie->name_eng = $res['origin_name'];
            $movie->trailer = $res['trailer_url'];
            $movie->resolution = 0;
            $movie->sub = 0;
            $movie->create = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->update = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->time_movie = $res['time'];

            $movie->episode = $res['episode_total'];
            $movie->belong_movie = 'phimle';
            $movie->count_views = rand(100, 99999);

         
            $movie->image = $res['thumb_url'];

            $movie->save();

            //Sau khi thêm phim xong sẽ có id sau đó tiếp tục thêm vào bảng movie_genre

            $movie->movie_genre()->attach($genre);

            return redirect()->back();

          
        }
    }
}

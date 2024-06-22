<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\LinkMovie;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;




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

    public function leech_episode($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();
        return  view('admin.leech.episodes', compact('resp'));
    }


    //Thêm tập phim
    public function episode_store(Request $request, $slug)
    {
        //Lấy id phim dựa theo slug
        $movie = Movie::where('slug', $slug)->first();

        //Lấy dữ liệu phim từ api
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();
        foreach ($resp['episodes'] as $key => $res) {

            foreach ($res['server_data'] as $key_data => $res_data) {
                //Lý do cần phải foreach dòng này tại vì có server là viettsub hoặc thuyết minh
                $ep = new Episode();
                $ep->movie_id = $movie->id;
                $ep->linkphim = '<iframe width="560" height="315" src="' . $res_data['link_embed'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                $ep->practice = $res_data['name'];

                if ($key_data == 0) {
                    $linkmovie = LinkMovie::orderBy('id', 'desc')->first();
                    $ep->server = $linkmovie->id;
                } else {
                    $linkmovie = LinkMovie::orderBy('id', 'desc')->first();
                    $ep->server = $linkmovie->id;
                }
                $ep->save();
            }
        }
        return redirect()->back();
    }

    //Chi tiết phim
    public function leech_details($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();

        // chuyển đổi thành mảng
        $resp_movie[] = $resp['movie'];

        return  view('admin.leech.details', compact('resp_movie'));
    }

    // thêm phim
    public function leech_store(Request $request, $slug)
    {
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();

        // chuyển đổi thành mảng
        $resp_movie[] = $resp['movie'];

        $movie = new Movie();

        foreach ($resp_movie as $key => $res) {

            $movie->title = $res['name'];
            $movie->slug = $res['slug'];
            $movie->tags = $res['name'] . ',' . $res['slug'];
            $movie->description = $res['content'];
            $movie->status = 1;

            $category = Category::orderBy('id', 'desc')->first();

            $movie->category_id = $category->id;

            $country = Country::orderBy('id', 'desc')->first();

            $movie->country_id = $country->id;

            $genre = Genre::orderBy('id', 'desc')->first();

            $movie->genre_id = $genre->id;


            $movie->name_eng = $res['origin_name'];

            //Dùng biểu thức chính quy để lấy ra trailler

            $trailer_url = $res['trailer_url'];

            preg_match('/v=([^&]+)/', $trailer_url, $matches);

            $video_id = $matches[1];

            $movie->trailer = $video_id;



            $movie->phim_hot = 1;
            $movie->resolution = 0;
            $movie->sub = 0;

            $movie->create = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->update = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->time_movie = $res['time'];
            $movie->episode = $res['episode_total'];
            $movie->belong_movie = 'phimle';
            $movie->count_views = rand(100, 99999);


   

            // URL hình ảnh từ API
            $image_url = $res['thumb_url'];

            // Lấy nội dung ảnh từ URL
            $image_contents = file_get_contents($image_url);

            // Kiểm tra xem có tải được nội dung ảnh không
            if ($image_contents === false) {
                // Xử lý lỗi nếu không tải được ảnh
                echo "Failed to download image.";
                return;
            }

            // Lấy tên file từ URL
            $image_name_from_url = basename($image_url); // ngo-tinh-thumb.jpg

            // Tạo tên mới cho file ảnh
            $name_image = pathinfo($image_name_from_url, PATHINFO_FILENAME); // ngo-tinh-thumb
            $new_image_name = $name_image . rand(0, 9999) . '.' . pathinfo($image_name_from_url, PATHINFO_EXTENSION); // ngo-tinh-thumb1234.jpg

            // Đường dẫn đầy đủ để lưu ảnh trong thư mục public/uploads/movie/
            $image_path = '/uploads/movie/' . $new_image_name;

            // Lưu ảnh vào thư mục public/uploads/movie/
            Storage::disk('public')->put($image_path, $image_contents);

            // Gán giá trị $new_image_name vào thuộc tính image của đối tượng $movie
            $movie->image = $new_image_name;


            $movie->save();

            //Sau khi thêm phim xong sẽ có id sau đó tiếp tục thêm vào bảng movie_genre

            $movie->movie_genre()->attach($genre);

            //Sau khi thêm phim xong sẽ có id sau đó tiếp tục thêm vào bảng movie_categori


            $movie->movie_category()->attach($category);


            return redirect()->back();
        }
    }
}

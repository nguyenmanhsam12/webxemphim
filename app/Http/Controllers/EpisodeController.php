<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\LinkMovie;


class EpisodeController extends Controller
{
    public function index()
    {
        $list_episode = Episode::with('movie')->orderBy('movie_id', 'DESC')->get();
        return view('admin.episode.index', compact('list_episode'));
    }

    public function create()
    {

        $list_movie = Movie::orderBy('id', 'DESC')->get();
        return view('admin.episode.add', compact('list_movie'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // $episode_check = Episode::where('practice', $data['practice'])->where('movie_id', $data['movie_id'])->count();

        // if ($episode_check  > 0) {
        //     return redirect()->back();
        // } else {
            $ep = new Episode();
            $ep->movie_id = $data['movie_id'];
            $ep->linkphim = $data['linkphim'];
            $ep->practice = $data['practice'];
            $ep->server = $data['linkserver'];

            $ep->save();
        


        return redirect()->back();
    }

    public function Edit($id)
    {
        $list_movie = Movie::orderBy('id', 'DESC')->get();
        $episode = Episode::find($id);
        $linkphim = LinkMovie::orderBy('id', 'desc')->get();
        return view('admin.episode.edit', compact('episode', 'list_movie','linkphim'));
    }

    public function Update(Request $request, $id)
    {
        $data = $request->all();
        $ep = Episode::find($id);
        $ep->movie_id = $data['movie_id'];
        $ep->linkphim = $data['linkphim'];
        $ep->practice = $data['practice'];
        $ep->server = $data['linkserver'];

        $ep->update();

        return redirect(route('admin.episode.list'));
    }

    public function Delete($id)
    {


        $episode = Episode::find($id)->delete();
        return redirect(route('admin.episode.list'));
    }

    public function select_movie()
    {
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output = '<option>--Chọn tập phim--</option>';
        if ($movie->belong_movie == 'phimbo') {
            for ($i = 1; $i < $movie->episode; $i++) {
                $output .= '
                    <option value="' . $i . '">' . $i . '</option>
                ';
            }
        } else {
            $output .= '
                    <option value="HD">HD</option>
                    <option value="fullHD">FullHD</option>
                    <option value="Cam">Cam</option>
                    <option value="HDCam">HDCam</option>

                ';
        }

        echo $output;
    }

    public function add_episode($id)
    {
        $linkphim = LinkMovie::orderBy('id', 'desc')->get();
        $movie = Movie::find($id);
        $list_episode = Episode::with('movie')->where('movie_id', $id)->orderBy('practice', 'DESC')->get();
        return view('admin.episode.add-episode', compact('list_episode', 'movie', 'linkphim'));
    }
}

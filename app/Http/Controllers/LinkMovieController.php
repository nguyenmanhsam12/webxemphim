<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkMovie;


class LinkMovieController extends Controller
{
    //
    public function index(){
        $linkphim = LinkMovie::orderBy('id','desc')->get();

        return view('admin.linkmovie.index',compact('linkphim'));
    }

    public function create(){
        return view('admin.linkmovie.add');
    }

    public function store(Request $request){
        $data = $request->all();
        $linkphim = new LinkMovie();
        $linkphim->title = $data['title'];
        $linkphim->description = $data['description'];
        $linkphim->status = $data['status'];
        $linkphim->save();
        
        return redirect()->back();
    }

    public function Edit($id){
        $linkphim = LinkMovie::find($id);
        return view('admin.linkmovie.edit',compact('linkphim'));
    }

    public function Update($id , Request $request){
        $data = $request->all();
        $linkphim = new LinkMovie();
        $linkphim = LinkMovie::find($id);
        $linkphim->title = $data['title'];
        $linkphim->description = $data['description'];
        $linkphim->status = $data['status'];
        $linkphim->update();

        return redirect(route('admin.linkmovie.list'));
        
    }   

    public function Delete($id){
        LinkMovie::find($id)->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;


class GenreController extends Controller
{
    private $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function index(){
        $listCategory = $this->genre->latest()->get();
        return view('admin.genre.list',compact('listCategory'));
    }

    public function create(){
    
        return view('admin.genre.add');
    }

    public function store(Request $request){
        $this->genre->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'slug'=>$request->slug,

        ]);
        return redirect(route('admin.genre.list'));
    }

    public function Delete($id){
     
        $this->genre->find($id)->delete();
        return redirect(route('admin.genre.list'));

    }

    public function Edit($id){
        
        $genre = $this->genre->find($id);
        return view('admin.genre.edit',compact('genre'));
    }

    public function Update($id , Request $request){

        $this->genre->find($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'slug'=>$request->slug,

        ]);
        return redirect(route('admin.genre.list'));
        
    }
}

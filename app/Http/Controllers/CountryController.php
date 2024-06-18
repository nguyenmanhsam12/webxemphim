<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;


class CountryController extends Controller
{
    private $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function index(){
        $listCategory = $this->country->latest()->get();
        return view('admin.country.index',compact('listCategory'));
    }

    public function create(){
        return view('admin.country.add');
    }

    public function store(Request $request){
        $this->country->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'slug'=>$request->slug,
        ]);
        return redirect(route('admin.country.list'));
    }

    public function Delete($id){
     
        $this->country->find($id)->delete();
        return redirect(route('admin.country.list'));

    }

    public function Edit($id){
        
        $country = $this->country->find($id);
        return view('admin.country.edit',compact('country'));
    }

    public function Update($id , Request $request){

        $this->country->find($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'slug'=>$request->slug,

        ]);
        return redirect(route('admin.country.list'));
        
    }
}

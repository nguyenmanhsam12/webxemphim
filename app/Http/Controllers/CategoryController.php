<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(){
        $listCategory = $this->category->orderBy('position','ASC')->get();
        return view('admin.category.index',compact('listCategory'));
    }

    public function create(){
        return view('admin.category.add');
    }

    public function store(Request $request){
        $this->category->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'slug'=>$request->slug,
        ]);
        flash()->success('Thêm danh mục phim thành công',['timeout'=>2000]);
        return redirect(route('admin.category.list'));
    }

    public function Delete($id){
     
        $this->category->find($id)->delete();
        flash()->info('Xóa danh mục phim thành công',['timeout'=>2000]);
        return redirect(route('admin.category.list'));

    }

    public function Edit($id){
        
        $category = $this->category->find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function Update($id , Request $request){

        $this->category->find($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'slug'=>$request->slug,
        ]);
        return redirect(route('admin.category.list'));
        
    }

}

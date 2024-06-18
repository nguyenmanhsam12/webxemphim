<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    //
   

    public function index(){
        $info = Info::all();
        return view('admin.info.index',compact('info'));
    }

    public function create(){


        return view('admin.info.add');

    }

    public function store(Request $request){
        $data = $request->all();
        $info = new Info();
        
        $info->title = $data['title'];
        $info->description = $data['description'];
       
        //Thêm hình ảnh

        $get_image = $request->file('logo');


        if ($get_image) {

            $get_image_name = $get_image->getClientOriginalName(); //hinhanh1.jpg

            $name_image = current(explode('.', $get_image_name)); //[0]hinhanh [1]jpg

            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //hinhanh1234.jpg

            $get_image->move('uploads/logo/', $new_image);

            $info->logo = $new_image;
        }

        $info->save();
        return redirect(route('admin.info.list'));
    }

    public function Edit($id){
        $info = Info::find($id);
        return view('admin.info.edit',compact('info'));
    }

    public function Update($id,Request $request){
        $data = $request->all();
        $info = new Info();
        $info = Info::find($id);

        
        $info->title = $data['title'];
        $info->description = $data['description'];
       
        //Thêm hình ảnh

        $get_image = $request->file('logo');


        if ($get_image) {

            $get_image_name = $get_image->getClientOriginalName(); //hinhanh1.jpg

            $name_image = current(explode('.', $get_image_name)); //[0]hinhanh [1]jpg

            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //hinhanh1234.jpg

            $get_image->move('uploads/logo/', $new_image);

            $info->logo = $new_image;
        }

        $info->save();
        return redirect(route('admin.info.list'));
    }
    
}

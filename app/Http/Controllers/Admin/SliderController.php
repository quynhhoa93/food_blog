<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{

    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'sub_title'=>'required',
            'image'=>'required|mimes:jpeg,jpg,bmp,png'
        ],[
            'title.required'=>'Không được để trống phần này',
            'sub_title.required'=>'Không được để trống phần này'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/slider')){
                mkdir('uploads/slider',0777,true);
            }
            $image->move('uploads/slider',$imagename);
        }else{
            $imagename = 'dafault.png';
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imagename;
        $slider->save();
        return redirect()->route('slider.index')->with('successMsg','Đã thêm 1 silder mới ');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'sub_title'=>'required',
            'image'=>'mimes:jpeg,jpg,bmp,png'
        ],[
            'title.required'=>'Không được để trống phần này',
            'sub_title.required'=>'Không được để trống phần này'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        $slider = Slider::find($id);
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/slider')){
                mkdir('uploads/slider',0777,true);
            }

            $image->move('uploads/slider',$imagename);
        }else{
            $imagename = $slider->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imagename;
        $slider->save();
        return redirect()->route('slider.index')->with('successMsg','Đã update slider ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if(file_exists('uploads/slider/'.$slider->image)){
            unlink('uploads/slider/'.$slider->image);
        }
        $slider->delete();
        return redirect()->route('slider.index')->with('successMsg','Đã xoá 1 silder');
    }
}

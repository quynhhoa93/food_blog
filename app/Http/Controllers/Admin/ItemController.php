<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('admin.item.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.item.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request,[
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
        ],[
            'category.required'=>'Không được để trống phần này',
            'name.required'=>'Không được để trống phần này',
            'description.required'=>'Không được để trống phần này',
            'price.required'=>'Không được để trống phần này',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/item')){
                mkdir('uploads/item',0777,true);
            }
            $image->move('uploads/item',$imagename);
        }else{
            $imagename = 'dafault.png';
        }

        $item = new Item();
        $item->name = $request->name;
        $item->image = $imagename;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->category_id = $request->category;
        $item->save();
        return redirect()->route('item.index')->with('successMsg','Đã thêm 1 item mới ');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('admin.item.edit',compact('item','categories'));
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
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ],[
            'category.required'=>'Không được để trống phần này',
            'name.required'=>'Không được để trống phần này',
            'description.required'=>'Không được để trống phần này',
            'price.required'=>'Không được để trống phần này',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        $item = Item::find($id);
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/item')){
                mkdir('uploads/item',0777,true);
            }
            unlink('uploads/item/'.$item->image);
            $image->move('uploads/item',$imagename);
        }else{
            $imagename = $item->image;
        }

        $item->name = $request->name;
        $item->image = $imagename;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->category_id = $request->category;
        $item->save();
        return redirect()->route('item.index')->with('successMsg','Đã update 1 item');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if (file_exists('/uploads/item/'.$item->image))
        {
            unlink('/uploads/item/'.$item->image);
        }
        $item->delete();
        return redirect()->back()->with('successMsg','Item successfully Deleted');
    }
}

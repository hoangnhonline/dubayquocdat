<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\WArticlesCate;
use Helper, File, Session, Auth;

class CateController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $items = Cate::where('status', 1)->orderBy('display_order')->get();
        return view('cate.index', compact( 'items'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        
        return view('cate.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required'       
        ],
        [
            'name.required' => 'Bạn chưa nhập tên',            
            'price.required' => 'Bạn chưa nhập giá',            
        ]);
        
        $dataArr['price'] = str_replace(",", "", $dataArr['price']);
        
        Cate::create($dataArr);

        Session::flash('message', 'Tạo mới thành công');

        return redirect()->route('cate.index');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $detail = Cate::find($id);
        return view('cate.edit', compact( 'detail'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required'       
        ],
        [
            'name.required' => 'Bạn chưa nhập tên',            
            'price.required' => 'Bạn chưa nhập giá',            
        ]);
        
        $dataArr['price'] = str_replace(",", "", $dataArr['price']);
        $model = Cate::find($dataArr['id']);
        $model->update($dataArr);
        Session::flash('message', 'Cập nhật thành công');

        return redirect()->route('cate.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // delete
        $model = Cate::find($id);        
        $model->update(['status' => 0]);
        
        Session::flash('message', 'Xóa dịch vụ thành công');
        return redirect()->route('cate.index');
    }
}

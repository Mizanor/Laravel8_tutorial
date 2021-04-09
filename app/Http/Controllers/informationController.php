<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\information;

class informationController extends Controller
{
    public function add()
    {
        return view('informationadd');
    }

   

    public function store(Request $request)
    {
        $this -> validate($request,[
            'name' =>'required',
            'image' => 'mimes:jpg,bmp,png'
           
        ]);
        
        $data = new information;
        $data -> name = $request->name;
        $data -> address = $request->address;

       if ($request->file('image')){
           $image = $request->file('image');
           $imagename = date('YmdHi') . $image->getClientOriginalName();
           $image->move(public_path('upload'), $imagename);
           $data['image'] = $imagename;
       }
       $data->save();

       $notification = array(
           'message' => 'Data Inserted Successfully',
           'alert-type' => 'success'
       );
       return redirect()->route('view.information') ->with($notification);
     
    }

    public function view()
    {
        $allData = information::all();
        return view('information-view', compact('allData'));
    }

    
    public function delete($id)
    {
        $data = information::find($id);

        @unlink(public_path('upload/' . $data->image));

        $data->delete();

        $notification = array(
            'message' => 'Data Inserted Successfully',
            'alert-type' => 'warning'
        );
        return back()->with($notification);
    }

    public function edit( $id)
    {
        $editData = information::where('id', $id)->first();
        return view('informationadd', compact('editData'));
        
    }

    public function update(Request $request, $id)
    {
        

        $data = information::where('id', $id)->first();
        $data-> name = $request->name;
        $data-> address = $request->address;

        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink(public_path('upload/' . $data->image));
            $imagename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload'), $imagename);
            $data['image'] = $imagename;
        }
        $data->save();
        $notification = array(
            'message' => 'Data Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.information')->with($notification);

        
    }



}

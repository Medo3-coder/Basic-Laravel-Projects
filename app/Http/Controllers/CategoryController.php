<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

//this for users who not loggin it redirect back to login page
public function __construct()
{
    $this->middleware('auth');
}



    public function AllCat()
    {
        //relation using query builder

        // $category = DB::table('categories')
        // ->join('users','categories.user_id','users.id')
        // ->select('categories.*','users.name')->latest()->get();



      $category = Category::latest()->paginate(5);   // this by orm

      //query for softDeletes
      $trashCat = Category::onlyTrashed()->latest()->paginate(3);  // onlyTrashed() : build in function make me pass data


     //$category = DB::table('categories')->latest()->get();   // by query bulider
        return view('admin.category.index',compact('category','trashCat'));
    }


    public function AddCat(Request $request)
    {
        $validatedData = $request->validate([
            'category_name'=>'required|unique:categories|max:200',

        ],
      );

      // insert data by elquoant orm

        Category::insert([
          'category_name' => $request->category_name,
          'user_id'       =>Auth::user()->id,
          'created_at'    =>Carbon::now()

        ]);

        // $category = new Category;
        // $category->category_name = $request->category_name ;
        // $category->user_id= Auth::user()->id;
        // $category->save();


        // insert by query builder

        // $data = array();
        // $data['category_name']=$request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success','Category inserted successfully');


    }

    public function Edit(Request $request , $id)
    {
        $category = Category::find($id);


        return view('admin.category.edit' , compact('category'));
    }

    public function update(Request $request , $id)
    {
       $category = Category::find($id)->update([
           "category_name" =>$request->category_name,
           "user_id"       => Auth::user()->id

       ]);

       return redirect()->route('all.category')->with('success','Category Updated successfully');
    }

    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success','Category Soft Delete Successfully');
    }

    public function Restore($id)
    {
        //withTrashed() : to get all data from trash by softDeletes

        $delete = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category Restore Successfully');
    }

    public function Pdelete($id)
    {

        //get recored from trash and delete it premenetly
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Category permement Deleted Successfully');
    }
}

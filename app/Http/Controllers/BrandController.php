<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MultiPic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.index',compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
          $validated = $request->validate([
              'brand_name'=>'required|unique:brands|min:4',
              'brand_image'=>'required|mimes:png,jpg,jpeg'
          ],
          [   // this optional to send custom message
            'brand_name.required'=>'Please input your brand Name',
            'brand_image.required'=>'Please input your Image'
        ]);

        //upload image using orm

        //  $brand_image = $request->file('brand_image');
        //   // to generate id
        //   $name_gen = hexdec(uniqid());
        //   $img_ext = strtolower($brand_image->getClientOriginalExtension());
        //   // this like 251684564.png  // or any ext after dot
        //   $img_name = $name_gen.'.'.$img_ext;
        //   //upload Loction
        //   $up_loction = 'image/brand/'; // make folder to upload
        //   // i have already uploaded with specific unique name
        //   $last_img =$up_loction.$img_name;

        //   $brand_image->move( $up_loction , $img_name );


           //end upload image


           //upload image using intervention package

           $brand_image = $request->file('brand_image');

           $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
           Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen );

           $last_img ='image/brand/'.$name_gen;


            //end upload image


           Brand::insert([
               'brand_name' => $request->brand_name,
               'brand_image'=> $last_img,
               'created_at'=>Carbon::now(),
           ]);

           return redirect()->back()->with('success','brand Inserted successfully');

    }
    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));

    }

    // public function Update(Request $request, $id){

    //     $validatedData = $request->validate([
    //         'brand_name' => 'required|min:4',

    //     ],
    //     [
    //         'brand_name.required' => 'Please Input Brand Name',
    //         'brand_image.min' => 'Brand Longer then 4 Characters',
    //     ]);

    //     $old_image = $request->old_image;

    //     $brand_image =  $request->file('brand_image');

    //     if($brand_image){

    //     $name_gen = hexdec(uniqid());
    //     $img_ext = strtolower($brand_image->getClientOriginalExtension());
    //     $img_name = $name_gen.'.'.$img_ext;
    //     $up_location = 'image/brand/';
    //     $last_img = $up_location.$img_name;
    //     $brand_image->move($up_location,$img_name);

    //     unlink($old_image);
    //     Brand::find($id)->update([
    //         'brand_name' => $request->brand_name,
    //         'brand_image' => $last_img,
    //         'created_at' => Carbon::now()
    //     ]);

    //     $notification = array(
    //         'message' => 'Brand Updated Successfully',
    //         'alert-type' => 'info'
    //     );
    //     return Redirect()->back()->with($notification);

    //     }else{
    //         Brand::find($id)->update([
    //             'brand_name' => $request->brand_name,
    //             'created_at' => Carbon::now()
    //         ]);
    //         $notification = array(
    //             'message' => 'Brand Updated Successfully',
    //             'alert-type' => 'warning'
    //         );

    //         return Redirect()->back()->with($notification);

    //     }
    // }



    public function Update(Request $request , $id)
    {
        $validated = $request->validate([
            'brand_name'=>'required',

        ],
        [   // this optional to send custom message
          'brand_name.required'=>'Please input your brand Name',

      ]);

      //To replace the old image with the new one

      $old_image = $request->old_image;




       //-------------------------------------------------

      //update image

        $brand_image = $request->file('brand_image');

        if($brand_image )
        {
            // to generate id
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // this like 251684564.png  // or any ext after dot
        $img_name = $name_gen.'.'.$img_ext;
        //upload Loction
        $up_loction = 'image/brand/'; // make folder to upload
        // i have already uploaded with specific unique name
        $last_img =$up_loction.$img_name;

        $brand_image->move( $up_loction , $img_name );


         //end upload image

           //to remove the image  old_image

            unlink($old_image);   // building function in laravel


         Brand::find($id)->update([
             'brand_name' => $request->brand_name,
             'brand_image'=> $last_img,
             'created_at'=>Carbon::now(),
         ]);

         $notification = array(
                     'message' => 'Brand Updated Successfully',
                    'alert-type' => 'info'
                );

         return redirect()->back()->with($notification);

        }
        else
        {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at'=>Carbon::now(),
            ]);

            $notification = array(
                            'message' => 'Brand Updated Successfully',
                            'alert-type' => 'warning'
                       );

            return redirect()->back()->with($notification );

        }

    }


    public function Delete($id)
    {
        //delete image from databse
        $image = Brand::find($id);
        $old_image =  $image->brand_image;
        unlink($old_image);


        Brand::find($id)->delete();

        $notification = array(
            'message' => 'Brand Delete Successfully',
            'alert-type' => 'error'
        );


        return redirect()->back()->with($notification);
    }



    //this is  for Multi Image All Methods

    public function MultiPic()
    {
        $images = MultiPic::all();
        return view('admin.multipic.index',compact('images'));
    }

    public function StoreImage(Request $request)
    {




           //upload image using intervention package

           $image = $request->file('image');


           //to add multiple image you have to run foreach loop

           foreach($image as $multi_img)
           {
            $name_gen = hexdec(uniqid()).'.'.$multi_img ->getClientOriginalExtension();
            Image::make($multi_img )->resize(300,300)->save('image/multi/'.$name_gen );

            $last_img ='image/multi/'.$name_gen;


             //end upload image


             MultiPic::insert([

                'image'=> $last_img,
                'created_at'=>Carbon::now(),
            ]);

           }//end of the foreach



           return redirect()->back()->with('success','brand Inserted successfully');
    }



    // logout function
    public function Logout()
    {
        Auth::logout();
        return Redirect()->route('login')->with('success', 'User Logout');
    }





}

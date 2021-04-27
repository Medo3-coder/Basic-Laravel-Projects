<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function HomeSlider()
    {
        $sliders = Slider::latest()->paginate(5);

        return view('admin.slider.index',compact('sliders'));
    }

    public function AddSlider()
    {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request)
    {
           //upload image using intervention package

           $slider_image = $request->file('image');

           $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
           Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen );

           $last_img ='image/slider/'.$name_gen;


            //end upload image


           Slider::insert([
               'title' => $request->title,
               'description' => $request->description,
               'image'=> $last_img,
               'created_at'=>Carbon::now(),
           ]);

           return redirect()->route('home.slider')->with('success','Slider Inserted successfully');
    }


    public function EditSlider($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));

    }

    public function UpdateSlider(Request $request , $id)
    {


      //To replace the old image with the new one

      $old_image = $request->old_image;




       //-------------------------------------------------

      //update image

        $Slide_image = $request->file('image');

        if($Slide_image )
        {
            // to generate id
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($Slide_image->getClientOriginalExtension());
        // this like 251684564.png  // or any ext after dot
        $img_name = $name_gen.'.'.$img_ext;
        //upload Loction
        $up_loction = 'image/slider/'; // make folder to upload
        // i have already uploaded with specific unique name
        $last_img =$up_loction.$img_name;

        $Slide_image->move( $up_loction , $img_name );


         //end upload image

           //to remove the image  old_image

            unlink($old_image);   // building function in laravel


         Slider::find($id)->update([
             'title' => $request->title,
             'description'=> $request->description,
             'image'=>$last_img,
         ]);

         return redirect()->back()->with('success','slider Updated successfully');

        }
        else
        {
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,

            ]);

            return redirect()->back()->with('success','slider Updated successfully');

        }

    }


    public function deleteSlider($id)
    {
          //delete image from databse
         $image = Slider::find($id);
         $old_image = $image->image;
         unlink($old_image);

         Slider::find($id)->delete();

         return redirect()->back()->with('success','slider Delete successfully');
    }

}

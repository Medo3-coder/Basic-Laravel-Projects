<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ContactForm;

class ContactContoller extends Controller
{
   public function AdminContact()
   {
       $contact = Contact::all();
       return view('admin.contact.index' , compact('contact'));
   }

   public function AdminAddContact(Request $request)
   {
       return view('admin.contact.create');

   }

   public function AdminStoreContact(Request $request)
   {
         $valid =   $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:11|numeric',
            'address' => 'required',



       ]);

      Contact::insert([
          'address' => $request->address,
          'email'   => $request->email,
          'phone'   => $request->phone,
          'created_at' => Carbon::now()

      ]);

      return redirect()->route('admin.contact')->with('success','Contact Created Successfully');

   }


   public function AdminEditContact($id)
   {
       $edit_contact =  Contact::find($id);
       return view('admin.contact.edit' , compact('edit_contact'));
   }

   public function AdminUpdateContact(Request $request , $id)
    {

       $valid =   $request->validate([
       'email' => 'required|email|unique:users,email',
       'phone' => 'required|min:11|numeric',
       'address' => 'required',



         ]);

         Contact::find($id)->update([
         'email' => $request->email,
         'phone' => $request->phone,
         'address' => $request->address

         ]);

         return redirect()->route('admin.contact')->with('success','Contact Updated Successfully');


   }


   public function AdminDeleteContact($id)
   {
        Contact::find($id)->delete();
        return redirect()->back()->with('success','Contact Deleted Successfully');
   }

   public function Contact()
   {
       $contacts = DB::table('contacts')->first();
       return view('pages.contact',compact('contacts'));
   }

   public function ContactForm(Request $request)
   {


        //     $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'subject' => 'required|min:4',
        //     'message' => 'required|max:value',

        // ]);



    ContactForm::insert([

        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
        'created_at' => Carbon::now()
       ]);

       return redirect()->route('contact')->with('success' , 'Your Message Send Successfully');
   }

   public function AdminMessge()
   {
       $message = ContactForm::all();
       return view('admin.contact.message',compact('message'));
   }

   public function AdminDeleteMessge($id)
   {
    ContactForm::find($id)->delete();
    return redirect()->back()->with('success' , 'Message Deleted Successfully');
   }

}

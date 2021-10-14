<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function __construct(){
        return $this->middleware('auth');
    }
    function contacPage(){
        return view('Frontend.contact');
    }

    function contactPost(Request $request){
        $request->validate([
            'name'=>['required'],
            'email'=>['required'],
            'subject'=>['required'],
            'message'=>['required'],
        ],[
            'name.required'=>'Please Enter Name',
            'email.required'=>'Please Enter Email',
            'subject.required'=>'Please Enter Subject',
            'message.required'=>'Please Enter Message',            
        ]);
        $contact = new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->subject=$request->subject;
        $contact->message=$request->message;
        $contact->save();
        $notification=array(
            'message'=>'Message Send Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    function contact(){
        return view('Backend.Contact.contact',[
            'contacts'=>Contact::latest()->simplePaginate(),
            'contactCount'=>Contact::count(),
        ]);
    }

    function contactDelete($id){
        Contact::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Message Moved To Trash',
            'alert-type'=>'danger',
        );
        return back()->with($notification);
    }

    function contactTrash(){
        return view('Backend.Contact.contact-trash',[
            'tContacts'=>Contact::onlyTrashed()->simplePaginate(),
            'tContactCount'=>Contact::onlyTrashed()->count(),
        ]);
    }

    function contactRestore($id){
        Contact::onlyTrashed()->findOrFail($id)->restore();
        $notification=array(
            'message'=>'Message Restored Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }

    function contactPerDelete($id){
        Contact::onlyTrashed()->findOrFail($id)->forceDelete();
        $notification=array(
            'message'=>'Message Deleted Permanently',
            'alert-type'=>'danger',
        );
        return back()->with($notification);
    }

}

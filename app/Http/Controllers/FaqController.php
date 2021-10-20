<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Faq.faq',[
            'faqs'=>Faq::latest()->simplePaginate(),
            'faqCount'=>Faq::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([            
            'question'=>['required'],
            'answer'=>['required'],            
        ],[
            'question.required'=>'Enter Question',
            'answer.required'=>'Enter Answer',            
        ]);
        $faq = new Faq;
        $faq->question=$request->question;
        $faq->answer=$request->answer;
        $faq->save();
        $notification=array(
            'message'=>'Question Added Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq){
        return view('Backend.Faq.faq-edit',[
            'faq'=>$faq,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq){
        $faq->question=$request->question;
        $faq->answer=$request->answer;
        $faq->save();
        $notification=array(
            'message'=>'Question Updated Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq){
        $faq->delete();
        return back();
    }
}

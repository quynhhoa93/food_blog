<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class ContactController extends Controller
{
    public function sendMessage(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ],[
            'name.required'=>'Bạn không được bỏ trống tên',
            'email.required'=>'Bạn không được bỏ trống email',
            'email.email'=>'Đây không phải email',
            'subject.required'=>'van de cua ban la gi',
            'message.required'=>'van de cu the la gi'
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        Toastr::success('Your message successfully send.','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}

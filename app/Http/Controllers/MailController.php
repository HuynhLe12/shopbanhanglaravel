<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;
class MailController extends Controller
{
    public function send_mail(){
        $to_name = 'Le Huynh';
        $to_mail = 'leconghuynh12082001@gmail.com';

        $data = array("name"=>"Mail từ tài khoản Khách hàng", "body"=>"Mail gửi về vấn về hàng hóa"); 
        Mail::send('pages.sendmail',$data,function($message) use ($to_name,$to_mail){
            $message->to($to_mail)->subject('TEST');
            $message->from($to_mail,$to_name);
        });
        /*return Redirect('/')->with('message','......');*/
    }
}

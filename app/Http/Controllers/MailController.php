<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function basic_email($name,$email,$msg,$subject){
      $data = array('name' => $name,'email' => $email,'msg' => $msg,'subject' => $subject);
       
      Mail::send(['text'=>'mail'], $data, function($message){
         $message->to($data['email'], $data['name'])->subject($data['subject']);
         $message->from('himanshuinspl@gmail.com','himanshu patel');
      });
//      echo "Basic Email Sent. Check your inbox.";
       return true;
   }

   public function html_email($name,$email,$msg,$subject){
      $data = array('name' => $name,'email' => $email,'msg' => $msg,'subject' => $subject);
        
      Mail::send('mail', $data, function($message) use ($data){
         $message->to($data['email'], $data['name'])->subject($data['subject'])->setBody('<b>hi,'.$data['name'].'</b><br>'.$data['msg']);
         $message->from('norepy@gmail.com','elifestyle');
      });
//      echo "HTML Email Sent. Check your inbox.";
       return true;
   }
   
   public function attachment_email($name,$email,$msg,$subject){
      $data = array('name' => $name,'email' => $email,'msg' => $msg,'subject' => $subject);
//       print_r($data);die;
      Mail::send('mail', $data, function($message) {
//         $message->to($data['email'], $data['email'])->subject($data['subject']);
//         $message->attach(url('/frontend/img/text1.txt'));
////         $message->attach(url('/frontend/img/text2.txt'));
//         $message->from('shubhamsahu.0503@gmail.com','himanshu patel');
      });
       return true;
   }

}




/*


    app('Larashop\Http\Controllers\MailController')->html_email($responseArray['firstname'],$responseArray['email'],'<b>Order Successful!!</b><br>Thankyou for your purchase. You ordered for '.$userCourseOBJ->course()->title.' we will send further details regarding your order on your email id.','Order Details');

*/
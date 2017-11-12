<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Usergroup;
use App\User;
use App\SubscriptionMonth;
use App\Plan;
use App\UserPlan;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetching all data
        $userOBJ = User::leftJoin('usergroups','users.user_type_id','=','usergroups.id')->leftJoin('user_plans','users.id','=','user_plans.user_id')->leftJoin('plans','user_plans.plan_id','=','plans.id')->select('users.id','users.fname','users.lname','users.sex','users.dob','users.contact_no','users.device_id','users.is_active','users.is_plan','users.valid_till','users.is_blocked','users.email','usergroups.group_title','plans.plan_title','usergroups.id as usergroup_id','plans.id as plan_id')->get();
        if(!$userOBJ->isEmpty()){

            
            //return to client
            $response = [
                'status'=>200,
                'message' => 'all users fetched Scucessfully.',
                'data'=>$userOBJ
            ];    

        }else{
            //return to client
            $response = [
                        'status' => 501,
                        'message' => 'Oops!! something went wrong please try again later.'
                    ];
        }

        return response()->json($response);
        exit;
    }


    public function userByUsergroup(Request $request){
        $Validator = Validator::make($request->
            toArray(),[
                'usergroup_id' => 'required'
            ]);

        if($Validator->fails()){    
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'error'=> $Validator->errors()
                        ];
        }else{
            $usersgroupOBJ = Usergroup::where('id','=',$request->input('usergroup_id'))->get();
            // print_r($usersgroupOBJ);
            if(!$usersgroupOBJ->isEmpty()){
                    //fetching all data
                $userOBJ = User::leftJoin('usergroups','users.user_type_id','=','usergroups.id')->where('users.user_type_id','=',$request->input('usergroup_id'))->orWhere('users.is_plan','=',1)->leftJoin('user_plans','users.id','=','user_plans.user_id')->leftJoin('plans','user_plans.plan_id','=','plans.id')->select('users.id','users.fname','users.lname','users.sex','users.dob','users.contact_no','users.device_id','users.is_active','users.is_plan','users.valid_till','users.is_blocked','users.email','usergroups.group_title','plans.plan_title')->get();
                if(!$userOBJ->isEmpty()){

                    
                    //return to client
                    $response = [
                        'status'=>200,
                        'message' => 'all users fetched Scucessfully.',
                        'data'=>$userOBJ
                    ];    

                }else{
                    //return to client
                    $response = [
                                'status' => 501,
                                'message' => 'Oops!! something went wrong please try again later.'
                            ];
                }

            }else{

                //return to client
                $response = [
                    'status' => 501,
                    'message' => 'Usergroup not found.'
                ];

            }

        }

            return response()->json($response);
            exit;


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
        //setting Validator rules for all fields
        $Validator = Validator::make($request->
            toArray(),[
            'usergroup' => 'required|digits:1',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'fname' => 'required',
            'sex' => 'required',
            'contact_no' => 'required'
            ]);

        if($Validator->fails()){
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'errors'=> $Validator->errors()
                        ];
        }else{

            //getting usersgroup
            $usersgroupOBJ = Usergroup::where('id','=',$request->input('usergroup'))->get();
            // print_r($usersgroupOBJ);
            if(!$usersgroupOBJ->isEmpty()){
                DB::beginTransaction();

                $usersgroupOBJ = $usersgroupOBJ->first();
                // print_r($usersgroupOBJ);
                $newUserOBJ = new User;
                $newUserOBJ->usergroup()->associate($usersgroupOBJ);
                $newUserOBJ->email = $request->input('email');
                $newUserOBJ->password = $request->input('password');
                $newUserOBJ->fname = $request->input('fname');
                $newUserOBJ->sex = $request->input('sex');
                if($request->input('lname')){
                    $newUserOBJ->lname = $request->input('lname');
                }
                if($request->input('dob')){
                    $newUserOBJ->dob = date("Y-m-d",strtotime($request->input('dob')));
                }
                if($request->input('contact_no')){
                    $newUserOBJ->contact_no = $request->input('contact_no');
                }

                if($request->input('device_id')){
                    $newUserOBJ->device_id = $request->input('device_id');
                }
                $newUserOBJ->is_active = 1;
                try{
                    
                    //saving data
                    // print_r($newUserOBJ);
                    $newUserOBJ->save();
                        DB::commit();

                    $userOBJ = User::where('email','=',$request->input('email'))->get();


                    if(!$userOBJ->isEmpty()){
                        $usermailOBJ = $userOBJ->first();
                    
                        // print_r($usermailOBJ);die;
                        app('App\Http\Controllers\MailController')->html_email($usermailOBJ->fname.' '.$usermailOBJ->lname,$usermailOBJ->email,'<b>registration Successfull</b><br>Thankyou for registration. Your email is '.$usermailOBJ->email.' and password is '.$usermailOBJ->password.'<br>Your contact no is '.$usermailOBJ->contact_no.'<br> Hope you will happy with us.','wellcome to elifestyle.');

                    }
                    if($usersgroupOBJ->id!=1 && $request->input('is_plan') && $request->input('plan_id') && $request->input('subscription_id')){
                    // $newUserOBJ->is_plan = '1';
                        if(!$userOBJ->isEmpty()){
                                $userOBJ = $userOBJ->first();
                                $planObj = Plan::where('id','=',$request->input('plan_id'))->get();
                                if(!$planObj->isEmpty()){
                                    $subscriptionOBJ = SubscriptionMonth::where('id','=',$request->input('subscription_id'))->get();
                                    if(!$subscriptionOBJ->isEmpty()){
                                        $subscriptionOBJ = $subscriptionOBJ->first();
                                        $planObj = $planObj->first();
                                        $userPlanOBJ = new UserPlan();

                                        // print_r($planObj);

                                        $userPlanOBJ->users()->associate($userOBJ);
                                        $userPlanOBJ->plans()->associate($planObj);
                                        $userPlanOBJ->subscriptions()->associate($subscriptionOBJ);

                                        $today = time();
                                        $monthsLater = strtotime("+".$subscriptionOBJ->months." months",$today);
                                        $userPlanOBJ->valid_till(date('Y-m-d H:i:s', $monthsLater));
                                            
                                            $userPlanOBJ->save();
                                            print_r($userPlanOBJ);
                                            User::where('id','=',$userOBJ->id)->update([
                                                'is_plan'=> '1',
                                                'valid_till'=> date('Y-m-d H:i:s', $monthsLater)
                                            ]);
                                            
                                        

                                    }else {
                                        
                                     //return to client
                                    $response = [
                                            'status'=>501,
                                            'message' => 'Not exists'
                                        ];
                                    }
                                }else {
                                     $response = [
                                            'status'=>501,
                                            'message' => 'Not exists'
                                        ];
                                }
                        }else{
                            $response = [
                                            'status'=>501,
                                            'message' => 'Not exists'
                                        ];
                            
                        }
                    }


                        //return to client
                        $response = [
                            'status' => 200,
                            'message' => 'registration Scucessfull.'
                        ];
                }catch(\Exception $e){
                    DB::rollback();
                    //return to client
                    $response = [
                        'status'=>501,
                        'message' => 'Oops!! something went wrong please try again later.',
                        'data' => $e
                    ];
                }   

            }else{
                //return to client
                    $response = [
                        'status'=>501,
                        'message' => 'Oops!! something went wrong please try again later.'
                    ];
            }
        }



        return response()->json($response);
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idate(format)
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //fetching all data
        $userOBJ = User::leftJoin('usergroups','users.user_type_id','=','usergroups.id')->leftJoin('user_plans','users.id','=','user_plans.user_id')->leftJoin('plans','user_plans.plan_id','=','plans.id')->select('users.id','users.fname','users.lname','users.sex','users.dob','users.contact_no','users.device_id','users.is_active','users.is_plan','users.valid_till','users.is_blocked','users.email','usergroups.group_title','plans.plan_title','usergroups.id as usergroup_id','plans.id as plan_id')->where('users.id','=',$id)->get();
        if(!$userOBJ->isEmpty()){

            $userOBJ = $userOBJ->last();
            //return to client
            $response = [
                'status'=>200,
                'message' => 'all users fetched Scucessfully.',
                'data'=>$userOBJ
            ];    

        }else{
            //return to client
            $response = [
                        'status' => 501,
                        'message' => 'Oops!! something went wrong please try again later.'
                    ];
        }

        return response()->json($response);
        exit;
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
    {//setting Validator rules for all fields
        $Validator = Validator::make($request->
            toArray(),[
            'fname' => 'required',
            'contact_no' => 'required',
            'dob'=>'required',
            'lname'=>'required'
            ]);

        if($Validator->fails()){
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'errors'=> $Validator->errors()
                        ];
        }else{

            //getting usersgroup
            // print_r($usersgroupOBJ);
                DB::beginTransaction();
                try{
                    
                    //saving data
                    // print_r($newUserOBJ);
                    
                            User::where('id','=',$id)->update([

                                'fname'=>$request->input('fname'),
                                'lname'=>$request->input('lname'),
                                'contact_no'=>$request->input('contact_no'),
                                'dob'=>$request->input('dob')

                            ]);
                            

                        DB::commit();

                    $userOBJ = User::where('id','=',$id)->get();
                    
                        //return to client
                        $response = [
                            'status' => 200,
                            'message' => 'registration Scucessfull.',
                            'data' => $userOBJ
                        ];
                }catch(\Exception $e){
                    DB::rollback();
                    //return to client
                    $response = [
                        'status'=>501,
                        'message' => 'Oops!! something went wrong please try again later.',
                        'data' => $e
                    ];
                }   

            
        }



        return response()->json($response);
        exit;
    }


    public function changePass(Request $request, $id)
    {//setting Validator rules for all fields
        $Validator = Validator::make($request->
            toArray(),[
            'currentpass' => 'required',
            'newpass' => 'required'
          ]);

        if($Validator->fails()){
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'errors'=> $Validator->errors()
                        ];
        }else{

            //getting usersgroup
            // print_r($usersgroupOBJ);
                DB::beginTransaction();
                // print_r($request->input('currentpass'));die;
                $userExsists = User::where('id','=',$id)->where('password','=',$request->input('currentpass'))->get();
                // print_r($userExsists);die;

                if(!$userExsists->isEmpty()){

                                    try{
                                        
                                        //saving data
                                        // print_r($newUserOBJ);
                                        
                                                User::where('id','=',$id)->update([
                                                    'password'=>$request->input('newpass')
                                                ]);
                                                

                                            DB::commit();

                                        $userOBJ = User::where('id','=',$id)->get();
                                        
                                            //return to client
                                            $response = [
                                                'status' => 200,
                                                'message' => 'registration Scucessfull.',
                                                'data' => $userOBJ
                                            ];
                                    }catch(\Exception $e){
                                        DB::rollback();
                                        //return to client
                                        $response = [
                                            'status'=>501,
                                            'message' => 'Oops!! something went wrong please try again later.',
                                            'data' => $e
                                        ];
                                    }   
                    }else{
                        $response = [
                                            'status'=>501,
                                            'message' => 'current password is not correct'
                                    ];
                    }            
        }



        return response()->json($response);
        exit;
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
}

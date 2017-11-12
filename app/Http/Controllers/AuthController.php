<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Session;
use App\App;
use App\Plan;
use App\AppCategory;
use App\AppDetail;
use App\User;
use App\Usergroup;
use App\UsersPlan;
use App\SubscriptionMonth;

class AuthController extends Controller
{
    //
    public function loginCheck(Request $request)
    {
        //
        $validation = Validator::make($request->toArray(),[
            'email' => 'required',
            'password'=>'required'
            ]);
        $userData= null;

        if($validation->fails()){
            //validation errors
            $response = ['status'=>500,
                        'message' => 'validation failed',
                        'errors'=> $validation->errors()
                        ];

        }else{

            $userExits= User::where('email','=',$request->input('email'))->where('password','=',$request->input('password'))->get();
            // print_r($userExits);
            if(!$userExits->isEmpty()){
                $userExits = $userExits->first();
                $userData = User::leftJoin('usergroups','users.user_type_id','=','usergroups.id')->leftJoin('user_plans','users.id','=','user_plans.user_id')->leftJoin('plans','user_plans.plan_id','=','plans.id')->select('users.id','users.fname','users.lname','users.sex','users.dob','users.contact_no','users.device_id','users.is_active','users.is_plan','users.valid_till','users.is_blocked','users.email','usergroups.group_title','plans.plan_title','usergroups.id as usergroup_id','plans.id as plan_id')->where('users.id','=',$userExits->id)->get()->toArray();


                    // print_r("vbhnjm");
                    // session()->put('userData', $userData);

                    // print_r(session()->get('userData', $userData));die;

                     // print_r($userData[0]['group_title']);die;

                 $response = [ 
                        'status'=>200,
                        'message'=>'permission granted.',
                        'data'=> $userData
                    ];


                 
            }else{
                 $response = [ 
                        'status'=>501,
                        'message'=>'email or password is wrong.'
                    ];

            }


        }


     return View('setSession')->with('data',$userData);
    } 

    //
    public function loginCheckApi(Request $request)
    {
        //
        $validation = Validator::make($request->toArray(),[
            'email' => 'required',
            'password'=>'required'
            ]);
        $userData= null;

        if($validation->fails()){
            //validation errors
            $response = ['status'=>500,
                        'message' => 'validation failed',
                        'errors'=> $validation->errors()
                        ];

        }else{

        	$userExits= User::where('email','=',$request->input('email'))->where('password','=',$request->input('password'))->get();
            // print_r($userExits);
        	if(!$userExits->isEmpty()){
        		$userExits = $userExits->first();
        		$userData = User::leftJoin('usergroups','users.user_type_id','=','usergroups.id')->leftJoin('user_plans','users.id','=','user_plans.user_id')->leftJoin('plans','user_plans.plan_id','=','plans.id')->select('users.id','users.fname','users.lname','users.sex','users.dob','users.contact_no','users.device_id','users.is_active','users.is_plan','users.valid_till','users.is_blocked','users.email','usergroups.group_title','plans.plan_title','usergroups.id as usergroup_id','plans.id as plan_id')->where('users.id','=',$userExits->id)->get();
                $userData = $userData->last();

            
                 $response = [ 
                        'status'=>201,
                        'message'=>'login Scucessfully',
                        'data'=> $userData
                    ];


        		 
        	}else{
        		 $response = [ 
                        'status'=>501,
                        'message'=>'email or password is wrong.'
                    ];

        	}


        }
        return response()->json($response);
        exit;

     
    }


    public function apiForAndroid(Request $request){

        $validation = Validator::make($request->toArray(),[
            'email' => 'required',
            'password'=>'required'
            ]);
        $userData= null;

        if($validation->fails()){
            //validation errors
            $response = ['status'=>500,
                        'message' => 'validation failed',
                        'errors'=> $validation->errors()
                        ];

        }else{

            $userExits= User::where('email','=',$request->input('email'))->where('password','=',$request->input('password'))->get();
            // print_r($userExits);
            if(!$userExits->isEmpty()){
                $userExits = $userExits->first();
        
                $userOBJ = User::leftJoin('usergroups','users.user_type_id','=','usergroups.id')->leftJoin('user_plans','users.id','=','user_plans.user_id')->leftJoin('plans','user_plans.plan_id','=','plans.id')->select('users.id','users.fname','users.lname','users.sex','users.dob','users.contact_no','users.device_id','users.is_active','users.password','users.is_plan','users.valid_till','users.is_blocked','users.email','usergroups.group_title','plans.plan_title','usergroups.id as usergroup_id','plans.id as plan_id')->where('users.id','=',$userExits->id)->get();
                $appDetailOBJ = App::leftJoin('plans','apps.plan_id','=','plans.id')->leftJoin('app_categories','apps.category_id','=','app_categories.id')->leftJoin('app_details','apps.id','=','app_details.app_id')->select(\DB::raw('apps.id,apps.title,apps.description,apps.logo_path, app_categories.title as  app_category_title, apps.is_active,plans.plan_title as plan_title, plans.id as app_plan_id, apps.created_at, app_details.version,app_details.apk_path, app_details.developer, app_details.app_package'))->distinct()->get();


                    if(!$userOBJ->isEmpty() && !$appDetailOBJ->isEmpty()){

                        
                        //return to client
                        $response = [
                            'status'=>200,
                            'message' => 'all users fetched Scucessfully.',
                            'userData'=>$userOBJ
                        ];    

                    }else{
                        //return to client
                        $response = [
                                    'status' => 501,
                                    'message' => 'Oops!! something went wrong please try again later.'
                                ];
                    }
            }else{
                $response = [
                                    'status' => 501,
                                    'message' => 'wrong passwordor email.'
                                ];
            }
        }

        return response()->json($response);
        exit;
    }


    public function logout(){

        session()->flush();
        $daat = session()->get('userData');
            $response = [
                        'status' => 501,
                        'message' => 'Oops!! something went wrong please try again later.',
                        'data'=> $daat
                    ];
        return response()->json($response);
    }

}

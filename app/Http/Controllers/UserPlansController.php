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


class UserPlansController extends Controller
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
        //setting Validator rules for all fields
        $Validator = Validator::make($request->
            toArray(),[
            'user_id' => 'required',
            'plan_id' => 'required',
            'subscription_id'=>'required'

            ]);

        if($Validator->fails()){
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'errors'=> $Validator->errors()
                        ];
        }else{

            //getting usersgroup
                DB::beginTransaction();
                // print_r("da");

                $userOBJ = User::where('id','=',$request->input('user_id'))->get();
                    if($request->input('user_id') && $request->input('plan_id') && $request->input('subscription_id')){
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

                                        $userPlanOBJ->users()->associate($userOBJ);
                                        $userPlanOBJ->plans()->associate($planObj);
                                        $userPlanOBJ->subscriptions()->associate($subscriptionOBJ);

                                        $today = time();
                                        $monthsLater = strtotime("+".$subscriptionOBJ->months." months",$today);
                                        $userPlanOBJ->valid_till = date('Y-m-d H:i:s', $monthsLater);
                                        // print_r($userPlanOBJ);
                                        try{
                                            $userPlanOBJ->save();
                                            // print_r($userPlanOBJ);
                                            User::where('id','=',$userOBJ->id)->update([
                                                'is_plan'=> '1',
                                                'valid_till'=> date('Y-m-d H:i:s', $monthsLater)
                                            ]);
                                            DB::commit();
                                            $userPlanOBJ = UserPlan::where('valid_till','=',date('Y-m-d H:i:s', $monthsLater))->get()->last();
                                            //return to client
                                            $response = [
                                                'status' => 200,
                                                'message' => 'registration Scucessfull.',
                                                'data' => $userPlanOBJ
                                            ];
                                        }catch(\Exception $e){
                                                    DB::rollback();
                                                    //return to client
                                            // print_r($userPlanOBJ);
                                                    $response = [
                                                        'status'=>501,
                                                        'message' => 'Oops!! something went wrong please try again ghbnjlater.',
                                                        'errors' => $e
                                                    ];
                                                }  
                                            
                                        

                                            }else {
                                                
                                             //return to client
                                            $response = [
                                                    'status'=>501,
                                                    'message' => 'Not exists sub'
                                                ];
                                            }
                                    }else {
                                         $response = [
                                                'status'=>501,
                                                'message' => 'Not exists plq'
                                            ];
                                    }
                        }else{
                            $response = [
                                            'status'=>501,
                                            'message' => 'Not exists ms'
                                        ];
                            
                        }
                    }else{
                             //return to client
                        $response = [
                            'status' => 200,
                            'message' => 'registration Scucessfull das.'
                        ];

                   
                    }


                   

        }


        return response()->json($response);
        exit;

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
}

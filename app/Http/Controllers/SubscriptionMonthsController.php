<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\SubscriptionMonth;

class SubscriptionMonthsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subOBJ = SubscriptionMonth::all(['id','subscription_title','months']);
                if(!$subOBJ->isEmpty()){
                    //return to client
                    $response = [ 
                        'status'=>200,
                        'message'=>'all plan fetched scucessfully.',
                        'data'=>$subOBJ
                    ];

                }else{

                    //return to client
                    $response = [
                        'status' => 501,
                        'message' => 'Oops!! something went wrong please try again later.'
                    ];
                }
                // print_r($subOBJ);

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
            'subscription_title' => 'required',
            'months'=>'required'
            ]);

        if($Validator->fails()){
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'error'=> $Validator->errors()
                        ];
        }else{

            //getting plan
                DB::beginTransaction();
                $subOBJ = new SubscriptionMonth();
                $subOBJ->subscription_title = $request->input('subscription_title');
                $subOBJ->months = $request->input('months');               
                try{
                    
                    //saving data
                    // print_r($newUserOBJ);
                    $subOBJ->save();
                        DB::commit();
                    $subOBJ = SubscriptionMonth::where('subscription_title','=',$request->input('subscription_title'))->get()->last();

                        //return to client
                        $response = [
                            'status' => 200,
                            'message' => 'Scucessfull.',
                            'data'=>$subOBJ
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //getting SubscriptionMonth detials
        $subOBJ = SubscriptionMonth::where('id','=',$id)->get();

        if(!$subOBJ->isEmpty()){
            $responseData = array(
                    'subscription_id' => $subOBJ->id,
                    'subscription_title'=>$subOBJ->subscription_title,
                    'months'=>$subOBJ->months
                );

            //return to client
            $response = [
                'status' => 200,
                'message' => 'SubscriptionMonth details fetched scucessfully.',
                'data' => $responseData
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'SubscriptionMonth does not exists'
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
        //getting SubscriptionMonth detials
        $subOBJ = SubscriptionMonth::where('id','=',$id)->get();

        if(!$subOBJ->isEmpty()){
            $responseData = array(
                   'subscription_id' => $subOBJ->id,
                    'subscription_title'=>$subOBJ->subscription_title,
                    'months'=>$subOBJ->months
                 );

            //return to client
            $response = [
                'status' => 200,
                'message' => 'SubscriptionMonth details fetched scucessfully for edit.',
                'data' => $responseData
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'SubscriptionMonth does not exists for edit'
            ];
        }

        return response()->json($response);
        exit;
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
        //setting validation rules for all fields
        $validation = Validator::make($request->toArray(),[
            'subscription_title' => 'required',
            'months'=>'required'
            ]);

        if($validation->fails()){
            //validation errors
            $response = ['status'=>500,
                        'message' => 'validation failed',
                        'errors'=> $validation->errors()
                        ];

        }else{
            DB::beginTransaction();
            $SubscriptionMonthExistOBJ = SubscriptionMonth::where('id','=',$id)->get();
            if(!$SubscriptionMonthExistOBJ->isEmpty()){
            try{

                //saving data
                SubscriptionMonth::where('id','=',$id)->update([
                    'subscription_title'=>$request->input('subscription_title'),
                    'months'=>$request->input('months')

                ]);

                DB::commit();

                $SubscriptionMonthOBJ = SubscriptionMonth::where('id','=',$id)->get()->last();

                //return to client
                $response = [
                    'status'=>200,
                    'message' => 'update scucessfull.',
                    'data'=>$SubscriptionMonthOBJ
                ];
            }catch(\Exception $e){
                //return to client
                $response = [
                        'status'=>501,
                        'message' => 'Oops!! something went wrong please try again later.',
                        'errors' => $e
                    ];
            }
        }else{
            $response = [
                        'status'=>501,
                        'message' => 'SubscriptionMonth does not exists.'
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
        //getting SubscriptionMonth detials
        $subOBJ = SubscriptionMonth::where('id','=',$id)->get();

        if(!$subOBJ->isEmpty()){
            SubscriptionMonth::where('id','=',$id)->delete();
            //return to client
            $response = [
                'status' => 200,
                'message' => 'SubscriptionMonth is scucessfully for deleted.',

            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'SubscriptionMonth does not exists for edit'
            ];
        }

        return response()->json($response);
        exit;
    }
}

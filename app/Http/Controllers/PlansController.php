<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Plan;


class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $planOBJ = Plan::all(['id','plan_title','amount']);
                if(!$planOBJ->isEmpty()){
                    //return to client
                    $response = [ 
                        'status'=>200,
                        'message'=>'all plan fetched scucessfully.',
                        'data'=>$planOBJ
                    ];

                }else{

                    //return to client
                    $response = [
                        'status' => 501,
                        'message' => 'Oops!! something went wrong please try again later.'
                    ];
                }
                // print_r($planOBJ);

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
            'plan_title' => 'required',
            'amount'=>'required'
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

                $planOBJ = new Plan();
               
                $planOBJ->plan_title = $request->input('plan_title');
                $planOBJ->amount = $request->input('amount'); 
                
                
                try{
                    
                    //saving data
                    // print_r($newUserOBJ);
                    $planOBJ->save();
                        DB::commit();

                    $planOBJ = Plan::where('plan_title','=',$request->input('plan_title'))->get()->last();

                        //return to client
                        $response = [
                            'status' => 200,
                            'message' => 'registration Scucessfull.',
                            'data'=>$planOBJ
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
        //getting Plan detials
        $planOBJ = Plan::where('id','=',$id)->get();

        if(!$planOBJ->isEmpty()){
            $planOBJ= $planOBJ->first();
            $responseData = array(
                    'plan_id' => $planOBJ->id,
                    'plan_title'=>$planOBJ->plan_title,
                    'amount' => $planOBJ->amount
                );

            //return to client
            $response = [
                'status' => 200,
                'message' => 'Plan details fetched scucessfully.',
                'data' => $responseData
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'Plan does not exists'
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
        //getting Plan detials
        $planOBJ = Plan::where('id','=',$id)->get();

        if(!$planOBJ->isEmpty()){
            $responseData = array(
                    'plan_id' => $planOBJ->id,
                    'plan_title'=>$planOBJ->plan_title
                );

            //return to client
            $response = [
                'status' => 200,
                'message' => 'Plan details fetched scucessfully for edit.',
                'data' => $responseData
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'Plan does not exists for edit'
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
            'plan_title' => 'required',
            'amount'=>'required'
            ]);

        if($validation->fails()){
            //validation errors
            $response = ['status'=>500,
                        'message' => 'validation failed',
                        'errors'=> $validation->errors()
                        ];

        }else{
            DB::beginTransaction();
            $PlanExistOBJ = Plan::where('id','=',$id)->get();
            if(!$PlanExistOBJ->isEmpty()){
            try{

                //saving data
                Plan::where('id','=',$id)->update([
                    'plan_title'=>$request->input('plan_title'),
                    'amount'=>$request->input('amount')
                    ]);
                DB::commit();

                $planOBJ = Plan::where('id','=',$id)->get();

                //return to client
                $response = [
                    'status'=>200,
                    'message' => 'update scucessfull.',
                    'data'=> $planOBJ
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
                        'message' => 'Plan does not exists.'
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
        //getting Plan detials
        $planOBJ = Plan::where('id','=',$id)->get();

        if(!$planOBJ->isEmpty()){
            Plan::where('id','=',$id)->delete();
            //return to client
            $response = [
                'status' => 200,
                'message' => 'Plan is scucessfully for deleted.',

            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'Plan does not exists for edit'
            ];
        }

        return response()->json($response);
        exit;
    }    
}

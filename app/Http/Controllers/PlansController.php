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
            'plan_title' => 'required'

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
                // print_r($planOBJ);

                $planOBJ->plan_title = $request->input('plan_title');
                
                
                
                try{
                    
                    //saving data
                    // print_r($newUserOBJ);
                    $planOBJ->save();
                        DB::commit();

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

        }

        if($request->input('view')){
            return redirect('/add/user')->with('response',$response);
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

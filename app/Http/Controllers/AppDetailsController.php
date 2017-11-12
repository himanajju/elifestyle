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
use App\AppDetail;


class AppDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetching all data
        $appDetailOBJ = AppDetail::leftJoin('apps','app_details.app_id','=','apps.id')->select('app_details.id','app_details.version','app_details.apk_path','app_details.developer','apps.title','apps.description','logo_path','app_details.app_package')->get();
        if(!$appDetailOBJ->isEmpty()){

            
            //return to client
            $response = [
                'status'=>200,
                'message' => 'all users fetched Scucessfully.',
                'data'=>$appDetailOBJ
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
            'app_id' => 'required',
            'version' => 'required',
            'apk_path' => 'required',
            'developer' => 'required',
            'app_package_name' => 'required'
            ]);

        if($Validator->fails()){
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'errors'=> $Validator->errors()
                        ];
        }else{
                // print_r($request->input('app_id'));
                $AppExsitOBJ = App::where('id','=',$request->input('app_id'))->get();
                // print_r($AppExsitOBJ);
                if(!$AppExsitOBJ->isEmpty()){

                        DB::beginTransaction();    
                        $appDetailOBJ = new AppDetail();
                        $appDetailOBJ->version = $request->input('version');
                        $appDetailOBJ->apk_path = $request->input('apk_path');
                        $appDetailOBJ->developer = $request->input('developer');
                        $appDetailOBJ->app_package = $request->input('app_package_name');

                        // $appDetailOBJ->apps()->associate($AppExsitOBJ);

                        $appDetailOBJ->app_id = $request->input('app_id');
                        try{
                            //saving data
                                $appDetailOBJ->save();
                                DB::commit();
                                $appObj = AppDetail::get()->last();
                            

                                //return to client
                                $response = [
                                    'status' => 200,
                                    'message' => 'registration Scucessfull.',
                                    'data'=>$appObj  
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
                                'message' => 'App doesnot exists.',
                                'data' => 'app doesnot exists'
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
        //fetching all data
        $appDetailOBJ = AppDetail::leftJoin('apps','app_details.app_id','=','apps.id')->select('app_details.id','app_details.app_id','app_details.version','app_details.apk_path','app_details.developer','apps.title','apps.description','logo_path','app_details.app_package')->where('app_details.app_id','=',$id)->get();
        if(!$appDetailOBJ->isEmpty()){

            
            //return to client
            $response = [
                'status'=>200,
                'message' => 'all users fetched Scucessfully.',
                'data'=>$appDetailOBJ
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


    public function showLast($id)
    {
        //fetching all data
        $appDetailOBJ = AppDetail::leftJoin('apps','app_details.app_id','=','apps.id')->select('app_details.id','app_details.app_id','app_details.version','app_details.apk_path','app_details.developer','apps.title','apps.description','logo_path','app_details.app_package','apps.plan_id')->where('app_details.app_id','=',$id)->get();
        if(!$appDetailOBJ->isEmpty()){

            
            $appDetailOBJ = $appDetailOBJ->last();
            //return to client
            $response = [
                'status'=>200,
                'message' => 'all users fetched Scucessfully.',
                'data'=>$appDetailOBJ
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
    {
        //setting Validator rules for all fields
        $Validator = Validator::make($request->
            toArray(),[
            'app_id' => 'required',
            'version' => 'required',
            'apk_path' => 'required',
            'developer' => 'required',
            'app_package'=>'required'
            ]);

        if($Validator->fails()){
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'errors'=> $Validator->errors()
                        ];
        }else{
                // print_r($request->input('app_id'));
                $appDetailExistsOBJ = AppDetail::where('id','=',$id)->get();
                if(!$appDetailExistsOBJ->isEmpty()){
                            $AppExsitOBJ = App::where('id','=',$request->input('app_id'))->get();
                            // print_r($AppExsitOBJ);
                            if(!$AppExsitOBJ->isEmpty()){

                                    DB::beginTransaction();    
                                    try{
                                        

                                        AppDetail::where('id','=',$id)->update([
                                                    'version'=>$request->input('version'),
                                                    'apk_path'=>$request->input('apk_path'),
                                                    'developer'=>$request->input('developer'),
                                                    'app_package'=>$request->input('app_package') 
                                                ]);
                                                
                                        //saving data
                                           

                                            DB::commit();
                                            $appObj = AppDetail::where('id','=',$id)->get();
                                        

                                            //return to client
                                            $response = [
                                                'status' => 200,
                                                'message' => 'registration Scucessfull.',
                                                'data'=>$appObj  
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
                                            'message' => 'App doesnot exists.',
                                            'data' => 'app doesnot exists'
                                        ];
                            }
                 }else {
                        //return to client
                                        $response = [
                                            'status'=>501,
                                            'message' => 'App Detail doesnot exists.',
                                            'data' => 'app Detail doesnot exists'
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
        //getting App detials
        $AppOBJ = AppDetail::where('id','=',$id)->get();

        if(!$AppOBJ->isEmpty()){
            AppDetail::where('id','=',$id)->delete();
            //return to client
            $response = [
                'status' => 200,
                'message' => 'App Detail is scucessfully for deleted.'
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'App Detail does not exists for edit'
            ];
        }
        return response()->json($response);
        exit;

    }
}

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

class AppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AppOBJ = App::leftJoin('plans','apps.plan_id','=','plans.id')->leftJoin('app_categories','apps.category_id','=','app_categories.id')->leftJoin('app_details','apps.id','=','app_details.app_id')->select(\DB::raw('apps.id,apps.title,apps.description,apps.logo_path, app_categories.title as  app_category_title, apps.is_active,plans.plan_title as plan_title,plans.id as plan_id, (select count(*) from app_details ad where ad.app_id = apps.id) as app_detail_id, apps.created_at'))->distinct()->get();
                if(!$AppOBJ->isEmpty()){
                    //return to client
                    $response = [ 
                        'status'=>200,
                        'message'=>'all App fetched scucessfully.',
                        'data'=>$AppOBJ
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

    public function indexApp($id)
    {
        
        // $appDetailOBJ = AppDetail::all();


        // print_r($appDetailOBJ);

        $appDetailOBJ = App::leftJoin('plans','apps.plan_id','=','plans.id')->leftJoin('app_categories','apps.category_id','=','app_categories.id')->leftJoin('app_details','apps.id','=','app_details.app_id')->select(\DB::raw('apps.id,apps.title,apps.description,apps.logo_path, app_categories.title as  app_category_title, apps.is_active,plans.plan_title as plan_title, apps.created_at'))->distinct()->get();

                if(!$appDetailOBJ->isEmpty()){

                    //return to client
                    $response = [ 
                        'status'=>200,
                        'message'=>'all App fetched scucessfully.',
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
            'title' => 'required',
            'plan_id' => 'required',
            'category_id' => 'required'
            ]);

        if($Validator->fails()){
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'errors'=> $Validator->errors()
                        ];
        }else{

           

                        DB::beginTransaction();    
                        $appObj = new App();

                        $appObj->title = $request->input('title');
                        $appObj->plan_id = $request->input('plan_id');
                        $appObj->category_id = $request->input('category_id');
                        if($request->input('description')){
                        $appObj->description = $request->input('description');
                        }

                        if($request->hasFile('imgLogo')){

                            $appName = $request->input('title').".".$request->imgLogo->extension();
                            // $pasth =$request->imgLogo->storeAs('public/appLogo', $appName);
                            $request->file('imgLogo')->move(public_path("/uploads"),$appName);
                            $appObj->logo_path = $appName;
                        }


                        
                        try{
                            //saving data
                            $appObj->save();

                                
                                DB::commit();
                                $appObj = App::get()->last();
                            

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

                        if($request->input('view')){
                            return redirect('admin/add/app-register');
                            exit;
                        }
                
            
        }


        return response()->json($response);
        exit;
    }


    public function updateAppLogoImage()
    {
         //setting validation rules for all fields
        $validation = Validator::make($request->toArray(),[
            'logo_path' => 'required'
            ]);

        if($validation->fails()){
            //validation errors
            $response = ['status'=>500,
                        'message' => 'validation failed',
                        'errors'=> $validation->errors()
                        ];

        }else{
            DB::beginTransaction();
            $AppExistOBJ = App::where('id','=',$id)->get();
            if(!$AppExistOBJ->isEmpty()){
            try{

                //saving data
                App::where('id','=',$id)->update(['logo_path'=>$request->input('logo_path')]);
                DB::commit();

                //return to client
                $response = [
                    'status'=>200,
                    'message' => 'update scucessfull.'
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
                        'message' => 'App does not exists.'
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
        //getting App detials
        $AppObj = App::where('id','=',$id)->get();

        if(!$AppObj->isEmpty()){
            $AppObj = $AppObj->first();
            session()->put('appIde', $AppObj->id);

        $val = session()->get('appIde');
        print_r($val);
            //return to client
            $response = [
                'status' => 200,
                'message' => 'App details fetched scucessfully.',
                'data' => $AppObj,
                'session'=>$val
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'App does not exists'
            ];
        }

        // return response()->json($response);
        // exit;
    }


    public function showApp($id)
    {
        //getting App detials
        $AppObj = App::where('id','=',$id)->get();

        if(!$AppObj->isEmpty()){
            $AppObj = $AppObj->first();
            session()->put('appIde', $AppObj->id);

        $val = session()->get('appIde');
        // print_r($val);
            //return to client
            $response = [
                'status' => 200,
                'message' => 'App details fetched scucessfully.',
                'data' => $AppObj,
                'session'=>$val
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'App does not exists'
            ];
        }

        return View::make('admin.add_form.app_detail')->with('data',json_encode($response));
        exit;
    }

    public function flushAppSession()
    {   
        $val = session('appIde');
        print_r("va ".$val);
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
            //getting App detials
        $AppOBJ = App::where('id','=',$id)->get();

        if(!$AppOBJ->isEmpty()){
            App::where('id','=',$id)->delete();
            //return to client
            $response = [
                'status' => 200,
                'message' => 'App is scucessfully for deleted.'
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'App does not exists for edit'
            ];
        }
        return response()->json($response);
        exit;

    }
}

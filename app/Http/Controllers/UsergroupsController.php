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



class UsergroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usergroupOBJ = Usergroup::all(['id','group_title']);
                if(!$usergroupOBJ->isEmpty()){
                    //return to client
                    $response = [ 
                        'status'=>200,
                        'message'=>'all usergroup fetched scucessfully.',
                        'data'=>$usergroupOBJ
                    ];

                }else{

                    //return to client
                    $response = [
                        'status' => 501,
                        'message' => 'Oops!! something went wrong please try again later.'
                    ];
                }
                // print_r($usergroupOBJ);

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
        $usergroupOBJ = Usergroup::all(['id','group_title']);
                if(!$usergroupOBJ->isEmpty()){
                    //return to client
                    $response = [ 
                        'status'=>200,
                        'message'=>'all usergroup fetched scucessfully.',
                        'data'=>$usergroupOBJ
                    ];

                }else{

                    //return to client
                    $response = [
                        'status' => 501,
                        'message' => 'Oops!! something went wrong please try again later.'
                    ];
                }
                // print_r($usergroupOBJ);

                return View::make('admin.add_form.usergroup')->with('data',json_encode($response));
                exit;
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
            'group_title' => 'required'

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

                $usersgroupOBJ = new Usergroup();
                // print_r($usersgroupOBJ);

                $usersgroupOBJ->group_title = $request->input('group_title');
                
                
                
                try{
                    
                    //saving data
                    // print_r($newUserOBJ);
                    $usersgroupOBJ->save();
                        DB::commit();
                        $usergroupDataObj = Usergroup::where('group_title','=',$request->input('group_title'))->get()->last();

                        //return to client
                        $response = [
                            'status' => 200,
                            'message' => 'registration Scucessfull.',
                            'data' => $usergroupDataObj
                        ];
                }catch(\Exception $e){
                    DB::rollback();
                    //return to client
                    $response = [
                        'status'=>501,
                        'message' => 'Oops!! something went wrong please try again later.',
                        'errors' => $e
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
        //getting usergroup detials
        $usergroupOBJ = Usergroup::where('id','=',$id)->get();

        if(!$usergroupOBJ->isEmpty()){
            $responseData = array(
                    'usergroup_id' => $usergroupOBJ->id,
                    'group_title'=>$usergroupOBJ->group_title
                );

            //return to client
            $response = [
                'status' => 200,
                'message' => 'usergroup details fetched scucessfully.',
                'data' => $responseData
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'usergroup does not exists'
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
        //getting usergroup detials
        $usergroupOBJ = Usergroup::where('id','=',$id)->get();

        if(!$usergroupOBJ->isEmpty()){
            $responseData = array(
                    'usergroup_id' => $usergroupOBJ->id,
                    'group_title'=>$usergroupOBJ->group_title
                );

            //return to client
            $response = [
                'status' => 200,
                'message' => 'usergroup details fetched scucessfully for edit.',
                'data' => $responseData
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'usergroup does not exists for edit'
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
            'group_title' => 'required'
            ]);

        if($validation->fails()){
            //validation errors
            $response = ['status'=>500,
                        'message' => 'validation failed',
                        'errors'=> $validation->errors()
                        ];

        }else{
            DB::beginTransaction();
            $usergroupExistOBJ = Usergroup::where('id','=',$id)->get();
            if(!$usergroupExistOBJ->isEmpty()){
            try{

                //saving data
                Usergroup::where('id','=',$id)->update(['group_title'=>$request->input('group_title')]);
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
                        'message' => 'usergroup does not exists.'
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
        //getting usergroup detials
        $usergroupOBJ = Usergroup::where('id','=',$id)->get();

        if(!$usergroupOBJ->isEmpty()){
            Usergroup::where('id','=',$id)->delete();
            //return to client
            $response = [
                'status' => 200,
                'message' => 'usergroup is scucessfully for deleted.',

            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'usergroup does not exists for edit'
            ];
        }

        return response()->json($response);
        exit;
    }
}

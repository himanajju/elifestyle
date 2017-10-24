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

class UsersController extends Controller
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
            'username' => 'required',
            'usergroup' => 'required|digits:1',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'fname' => 'required',
            'sex' => 'required'
            ]);

        if($Validator->fails()){
            //Validator errors
            $response = ['status'=>500,
                        'message' => 'Validator failed',
                        'error'=> $Validator->errors()
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
                $newUserOBJ->username = $request->input('username');
                $newUserOBJ->email = $request->input('email');
                $newUserOBJ->password = $request->input('password');
                $newUserOBJ->fname = $request->input('fname');
                $newUserOBJ->sex = $request->input('sex');
                if(!$request->input('lname')){
                    $newUserOBJ->lname = $request->input('lname');
                }
                if(!$request->input('dob')){
                    $newUserOBJ->dob = $request->input('dob');
                }
                if(!$request->input('contact_no')){
                    $newUserOBJ->contact_no = $request->input('contact_no');
                }
                if($usersgroupOBJ->id!=1){
                    $newUserOBJ->is_plan = 0;
                }

                if(!$request->input('lname')){
                    $newUserOBJ->lname = $request->input('lname');
                }

                if(!$request->input('device_id')){
                    $newUserOBJ->profile_image = $request->input('device_id');
                }
                $newUserOBJ->is_active = 1;

                
                
                try{
                    
                    //saving data
                    // print_r($newUserOBJ);
                    $newUserOBJ->save();
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

            }else{
                //return to client
                    $response = [
                        'status'=>501,
                        'message' => 'Oops!! something went wrong please try again later.'
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

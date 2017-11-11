<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\AppCategory;


class AppCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AppCatOBJ = AppCategory::all(['id','title']);
                if(!$AppCatOBJ->isEmpty()){
                    //return to client
                    $response = [ 
                        'status'=>200,
                        'message'=>'all AppCat fetched scucessfully.',
                        'data'=>$AppCatOBJ
                    ];

                }else{

                    //return to client
                    $response = [
                        'status' => 501,
                        'message' => 'Oops!! something went wrong please try again later.'
                    ];
                }
                // print_r($AppCatOBJ);

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
            'title' => 'required'
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

                $appCateOBJ = new AppCategory();
                // print_r($appCateOBJ);

                $appCateOBJ->title = $request->input('title');
                
                
                
                try{
                    
                    //saving data
                    // print_r($newUserOBJ);
                    $appCateOBJ->save();
                        DB::commit();

                        $appCateOBJ = AppCategory::where('title','=',$request->input('title'))->get()->last();

                        //return to client
                        $response = [
                            'status' => 200,
                            'message' => 'registration Scucessfull.',
                            'data' => $appCateOBJ
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
        //getting AppCategory detials
        $AppCatOBJ = AppCategory::where('id','=',$id)->get();

        if(!$AppCatOBJ->isEmpty()){
            $responseData = array(
                    'AppCategory_id' => $AppCatOBJ->id,
                    'title'=>$AppCatOBJ->title
                );

            //return to client
            $response = [
                'status' => 200,
                'message' => 'AppCategory details fetched scucessfully.',
                'data' => $responseData
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'AppCategory does not exists'
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
        //getting AppCategory detials
        $AppCatOBJ = AppCategory::where('id','=',$id)->get();

        if(!$AppCatOBJ->isEmpty()){
            $responseData = array(
                    'AppCategory_id' => $AppCatOBJ->id,
                    'title'=>$AppCatOBJ->title
                );

            //return to client
            $response = [
                'status' => 200,
                'message' => 'AppCategory details fetched scucessfully for edit.',
                'data' => $responseData
            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'AppCategory does not exists for edit'
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
            'title' => 'required'
            ]);

        if($validation->fails()){
            //validation errors
            $response = ['status'=>500,
                        'message' => 'validation failed',
                        'errors'=> $validation->errors()
                        ];

        }else{
            DB::beginTransaction();
            $AppCategoryExistOBJ = AppCategory::where('id','=',$id)->get();
            if(!$AppCategoryExistOBJ->isEmpty()){
            try{

                //saving data
                AppCategory::where('id','=',$id)->update(['title'=>$request->input('title')]);
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
                        'message' => 'AppCategory does not exists.'
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
        //getting AppCategory detials
        $AppCatOBJ = AppCategory::where('id','=',$id)->get();

        if(!$AppCatOBJ->isEmpty()){
            AppCategory::where('id','=',$id)->delete();
            //return to client
            $response = [
                'status' => 200,
                'message' => 'AppCategory is scucessfully for deleted.',

            ];
        }else{

            //return to client
            $response = [
                'status'=>501,
                'message'=>'AppCategory does not exists for edit'
            ];
        }

        return response()->json($response);
        exit;
    }
}

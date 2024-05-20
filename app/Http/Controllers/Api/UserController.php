<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
         $user_register_data= $request->all();
        //  validate data start
        $validator= Validator::make($request->all(),[
            'username'=>'required|unique:users',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'contact'=>'required|max:15',
            'password'=>'required'

        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);

        }
        else{
            $data=[
                'username'=>$request->username,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'contact'=>$request->contact,
                'password'=>Hash::make($request->password),

            ];
            DB::beginTransaction();
            try{
                $user= User::create($data);
                DB::commit();

            }
            catch(\Exception $e){
                DB::rollBack();
                formatArray($e->getMessage());
                $user=null;

            }
            if($user!=null){
                return response()->json([
                    'status'=>1,
                    'message'=>'User registered successfully'
                ],200);

            }
            else{
                return response()->json([
                    'status'=>0,
                    'message'=>'Internal server error'
                ],500);

            }

        }
    

        //  echo response()->json([
        //     'name'=>$user_register_data['name']
        //  ],'200');
        
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

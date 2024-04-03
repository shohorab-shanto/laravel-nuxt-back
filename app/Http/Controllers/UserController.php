<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 
use Mail; 
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Traits\HttpResponses;

class UserController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('designation', 'division', 'district')->latest();

        $users = $users->paginate($request->get('rows', 10));

        return UserResource::collection($users);
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
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nid' => 'required|string',
            'designation_id' => 'required|integer',
            'division_id' => 'required|integer',
            'district_id' => 'required|integer',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('avatar'))
                $avatar = $request->file('avatar')->store('users/avatar');

            $user = User::create([
                'designation_id' => $request->designation_id,
                'division_id'    => $request->division_id,
                'district_id'    => $request->district_id,
                'name'           => $request->name,
                'email'          => $request->email,
                'nid'            => $request->nid,
                'type'           => 'official',
                'password'       => Hash::make($request->password),
                'avatar'         => $avatar ?? null
            ]);

            if ($request->role)
                $user->roles()->sync($request->role);

            DB::commit();
            return message("User Created Successfully", 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return message($th->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('roles.permissions');

        return UserResource::make($user);
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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'           => 'required|string|min:3',
            'email'          => 'required|email|unique:users,email,'.$user->id,
            'nid'            => 'required|string',
            'designation_id' => 'required|integer',
            'division_id'    => 'required|integer',
            'district_id'    => 'required|integer',
            'password'       => 'nullable|string|min:6|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $update_data = array(
                'name'           => $request->name,
                'email'          => $request->email,
                'nid'            => $request->nid,
                'designation_id' => $request->designation_id,
                'division_id'    => $request->division_id,
                'district_id'    => $request->district_id,
            );

            if($request->password){
                $update_data['password'] = Hash::make($request->password);
            }

            $user->update($update_data);

            DB::commit();
            return message("User Updated Successfully", 200);

        } catch (\Throwable $th) {
            DB::rollback();
            return message($th->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try { 
            $user = User::findOrFail($id);
            if ($user)
                $user->delete();
            
            return message("User Deleted Successfully", 200);
        }catch (\Throwable $th) {
            return message($th->getMessage(), 400);
        }
    }

    public function submitForgetPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        try{

            $token = str()->random(64);

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
            ]);

            Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return message('We have e-mailed your password reset link!', 200);

        }catch (\Throwable $th) {
            return message($th->getMessage(), 400);
        }
    }

    public function getPasswordResetEmail(Request $request){
        $res = '';

        if(isset($request->token)){
            $data = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();

            if($data){
                $res = $data->email;
            }
        }

        echo $res;
    }

    public function submitResetPassword(Request $request) {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $updatePassword = DB::table('password_reset_tokens')
                            ->where([
                            'email' => $request->email, 
                            'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return $this->error([
                'status' => 'error',
                'message' => 'Invalid token!'
            ], 400);
        }

        User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return message('Your password has been changed!', 200);
    }
}

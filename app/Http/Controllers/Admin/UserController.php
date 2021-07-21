<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;



class UserController extends Controller
{
    //user view
    function index(){
        $user= User::all();
        return view('admin.user.index',compact('user'));
    
}
   // filteration of user
 function status(Request $request){
        $user= User::where('status',$request->Input('status'))->get();
        return view('admin.user.index',compact('user'));
    
}
    
     //user add
    function add(){
    	return view('admin.user.add');
    }
    // insert user
     function insert(Request $request)
    {
          request()->validate([
        'name' => 'required|min:6|max:15',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
        ]);

    	$user = new User();
    	$user->name=$request->input('name');
    	$user->email=$request->input('email'); 
    	$user->password=Hash::make($request->input('password'));
    
    
      // email sent
        $name=$request->input('name');
    	$email=$request->input('email'); 
    	$password=$request->input('password');
        $data = ([
            'name' => $name,
            'email' => $email,
        ]);
        Mail::to($email)->send(new WelcomeMail($data));
        $user->save();
         //return back()->with('message-sent','Your message has been sent');
        return redirect('/users')->with('status','user Added Succesfully');
    }
    // edit user
    function edit($id){
        $prodID = Crypt::decrypt($id);
        $user=User::find($prodID);
        return view('admin.user.edit',compact('user'));
    }
    //update user
    function update(Request $request,$id){

        request()->validate([
        'name' => 'required|min:5|max:15',
        'email' => 'required|email',
        'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
        ]);

        $user= User::find($id);
        $user->name=$request->input('name');
        $user->email=$request->input('email'); 
        $user->password=Hash::make($request->input('password'));
        $user->update();
        return redirect('/users')->with('status','user updated Succesfully');

    }
    // status of user
    function changeStatus(Request $request) {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status Changed Successfully']);
    }
    // delete user
    function delete($id){
         $user= User::find($id);
          $user->delete();
          return redirect('/users')->with('status','user deleted Succesfully');

    }

    
    

}

   




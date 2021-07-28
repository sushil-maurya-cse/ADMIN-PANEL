<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Response;

class UserController extends Controller
{
    //user view
    public function index()
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }
    public function imageGet($id)
    {
        // $User=User::all();
        $image = Image::where('user_id', $id)->pluck('name')->first();

        return view('admin.user.new', compact('image'));
    }
    // filteration of user
    public function status(Request $request)
    {
        $user = User::where('status', $request->Input('status'))->get();
        return view('admin.user.index', compact('user'));

    }

    //user add
    public function add()
    {
        return view('admin.user.add');
    }
    // insert user
    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|min:6|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'file_path' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $imageName = time() . '.' . $request->file_path->extension();
        $request->file_path->move(public_path('image'), $imageName);
        $user->file_path=$imageName;

        // email sent
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $data = ([
            'name' => $name,
            'email' => $email,
        ]);
        Mail::to($email)->send(new WelcomeMail($data));
        $user->save();
        //return back()->with('message-sent','Your message has been sent');
        return redirect('/users')->with('status', 'user Added Succesfully');
    }
    // edit user
    public function edit($id)
    {
        $prodID = Crypt::decrypt($id);
        $user = User::find($prodID);
        return view('admin.user.edit', compact('user'));
    }
    //update user
    public function update(Request $request, $id)
    {

        request()->validate([
            'name' => 'required|min:5|max:15',
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'image.*' => 'required|image|mimes:jpg ,png,jpeg,gif,svg|max:2048',

        ]);

        $user = User::find($id);
        $image = new Image();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $id = $request->id;
        $user->password = Hash::make($request->input('password'));
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                $name = time() . '.' . $file->extension();
                $file->move(public_path('image'), $name);
                $data[] = $name;
            }
        }
        $image->name = implode(",",$data);
        // implode(",",$req->file('upload'))

        $image->user_id = $id;
        $image->save();

        $user->update();
        return redirect('/users')->with('status', 'user updated Succesfully');

    }

    // status of user
    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status Changed Successfully']);
    }
    // delete user
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('status', 'user deleted Succesfully');

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contest;
use App\Models\Contestant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContestantController extends Controller
{
    //to contestant add form
    public function add($contest_id){
        $contest = Contest::find($contest_id);
        return view('admin.contestant.contestant_add',compact('contest'));
    }

    //to store the value of the contestant add form
    public function add_store(Request $request){
        $validateData = $request->validate([
            'c_id' => 'required', //contest id
            'c_name' => 'required',
            'c_email' => 'required|email',
            'c_psw' => 'required',
            'c_number' => 'required',
            'c_message' => 'required',
            'c_representing' => 'required',
        ]);

        if($validateData){
            //create user
            $user = User::create([
                'name' => $validateData['c_name'],
                'email' => $validateData['c_email'],
                'password' => Hash::make($validateData['c_psw']),
                'role' => 'contestant'
            ]);

            Contestant::create([
                'user_id' => $user->id,
                'contest_id' => $validateData['c_id'],
                'contestant_number' => $validateData['c_number'],
                'contestant_message' => $validateData['c_message'],
                'contestant_representing' => $validateData['c_representing'],
            ]);
        }

        if($request->file('c_photo')){
            $file = $request->file('c_photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/contestants'),$filename);

            $user['photo'] = "contestants/".$filename;
        }

        $user->save();
        return redirect('/admin/contestant/contestants/'.$validateData['c_id'])->with('success','Contestant Added Successfully');
    }

    //to update contestant form
    public function update($contestant_id,$contest_id){
        $contest = Contest::find($contest_id);
        $contestant = Contestant::find($contestant_id);
        $user = User::find($contestant->user_id);
        return view('admin.contestant.contestant_update',compact('contestant','user','contest'));
    }

    //to store the value of the update contestant form
    public function update_store(Request $request){

        $validateData = $request->validate([
            'contestant_id' => 'required', //contestant id = different from the one above
            'contest_id' => 'required',
            'c_name' => 'required',
            'c_email' => 'required|email',
            'c_psw' => '',
            'c_number' => 'required',
            'c_message' => 'required',
            'c_representing' => 'required',
        ]);

        if($validateData){
            
            $contestant = Contestant::find($validateData['contestant_id']);
            $user = User::find($contestant->user_id);

            //create user
            $user['name'] = $validateData['c_name'];
            $user['email'] = $validateData['c_email'];
            $user['password'] = Hash::make($validateData['c_psw']);
            $user['role'] = 'contestant';

            $contestant['user_id'] = $user->id;
            $contestant['contestant_number'] = $validateData['c_number'];
            $contestant['contestant_message'] = $validateData['c_message'];
            $contestant['contestant_representing'] = $validateData['c_representing'];
            
        }

        if($request->file('c_photo')){
            $file = $request->file('c_photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/contestants'),$filename);

            $user['photo'] = "contestants/".$filename;
        }

        $user->save();
        $contestant->save();
        return redirect('/admin/contestant/contestants/'.$validateData['contest_id'])->with('success','Contestant Updated Successfully');
    }

    //to delete contestant
    public function delete(Request $request){
        $validateData = $request->validate([
            'c_id' => 'required',
            'contest_id' => 'required'
        ]);
        $contestant = Contestant::find($validateData['c_id']);
        $contestant->delete();
        return redirect('/admin/contestant/contestants/'.$validateData['contest_id'])->with('success','Contestant Deleted Successfully');
        
    }
    
}

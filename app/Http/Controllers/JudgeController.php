<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judge;
use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JudgeController extends Controller
{
    //to judge add form
    public function add($contest_id){
        $contest = Contest::find($contest_id);
        return view('admin.judge.judge_add',compact('contest'));
    }

    
    //to store the value of the judge add form
    public function add_store(Request $request){
        $validateData = $request->validate([
            'contest_id' => 'required', //contest id
            'j_name' => 'required',
            'j_email' => 'required|email',
            'j_psw' => 'required',
            'j_description' => 'required',
        ]);

        if($validateData){
            //create user
            $user = User::create([
                'name' => $validateData['j_name'],
                'email' => $validateData['j_email'],
                'password' => Hash::make($validateData['j_psw']),
                'role' => 'judge'
            ]);

            Judge::create([
                'user_id' => $user->id,
                'contest_id' => $validateData['contest_id'],
                'judge_description' => $validateData['j_description'],
            ]);
        }

        if($request->file('j_photo')){
            $file = $request->file('j_photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/judges'),$filename);

            $user['photo'] = "judges/".$filename;
        }

        $user->save();
        return redirect('/admin/judge/judges/'.$validateData['contest_id'])->with('success','Judge Added Successfully');
    }

    
    //to update judge form
    public function update($judge_id,$contest_id){
        $contest = Contest::find($contest_id);
        $judge = Judge::find($judge_id);
        $user = User::find($judge->user_id);
        return view('admin.judge.judge_update',compact('judge','user','contest'));
    }

    
    //to store the value of the update judge form
    public function update_store(Request $request){

        $validateData = $request->validate([
            'judge_id' => 'required', //contestant id = different from the one above
            'contest_id' => 'required',
            'j_name' => 'required',
            'j_email' => 'required|email',
            'j_psw' => '',
            'j_description' => 'required',
        ]);

        if($validateData){
            
            $judge = Judge::find($validateData['judge_id']);
            $user = User::find($judge->user_id);

            //create user
            $user['name'] = $validateData['j_name'];
            $user['email'] = $validateData['j_email'];
            $user['password'] = Hash::make($validateData['j_psw']);
            $user['role'] = 'judge';

            $judge['user_id'] = $user->id;
            $judge['judge_description'] = $validateData['j_description'];
            
        }

        if($request->file('j_photo')){
            $file = $request->file('j_photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/judges'),$filename);

            $user['photo'] = "judges/".$filename;
        }

        $user->save();
        $judge->save();
        return redirect('/admin/judge/judges/'.$validateData['contest_id'])->with('success','Judge Updated Successfully');
    }
    
    //to delete contestant
    public function delete(Request $request){
        $validateData = $request->validate([
            'judge_id' => 'required',
            'contest_id' => 'required'
        ]);
        $judge = Judge::find($validateData['judge_id']);
        $judge->delete();
        return redirect('/admin/judge/judges/'.$validateData['contest_id'])->with('success','Judge Deleted Successfully');
        
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    //to the contest add form
    public function add(){
      return view('admin.contest.contest_add');
    }

    //to store the value on the contest add form
    public function add_store(Request $request){
      $validateData = $request->validate([
        'c_name' => 'required',
        'c_date' => 'required|date',
        'c_show' => 'required|boolean'
      ]);

      Contest::create([
        'contest_name' => $validateData['c_name'],
        'announcement_date' => $validateData['c_date'],
        'show_contest_result' => $validateData['c_show'],
      ]);

      return redirect('/admin/contest/contests')->with('success','Contest Added Successfully');
    }

    //to the contest update form
    public function update($contest_id){
      $contest = Contest::find($contest_id);
      return view('admin.contest.contest_update',compact('contest'));
    }

    //to store the value of the contest update form
    public function update_store(Request $request){
      $validateData = $request->validate([
        'c_id' => 'required',
        'c_name' => 'required',
        'c_date' => 'required|date',
        'c_show' => 'required|boolean'
      ]);

      $contest = Contest::find($validateData['c_id']);

      if($validateData){
        $contest->contest_name = $validateData['c_name'];
        $contest->announcement_date = $validateData['c_date'];
        $contest->show_contest_result = $validateData['c_show'];
        
      }
      
      $contest->save();

      return redirect('/admin/contest/contests')->with('success','Contest Updated Successfully');
    }

    //to delete contest
    public function delete(Request $request){
      $validateData = $request->validate([
        'c_id' => 'required',
      ]);

      if($validateData){
        $contest = Contest::find($validateData['c_id']);
        $contest->delete();
      }

      return redirect('/admin/contest/contests')->with('success','Contest Deleted Successfully');

    }
}

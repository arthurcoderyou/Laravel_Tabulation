<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    //to criteria add form
    public function add($contest_id){
        $contest = Contest::find($contest_id);
        return view('admin.criteria.criteria_add',compact('contest'));
    }

    
    //to store the value of the judge add form
    public function add_store(Request $request){
        $validateData = $request->validate([
            'contest_id' => 'required', //contest id
            'cri_name' => 'required',
            'cri_desc' => 'required',
            'cri_per' => 'required',
        ]);

        if($validateData){
            
            Criteria::create([
                'contest_id' => $validateData['contest_id'],
                'criteria_name' => $validateData['cri_name'],
                'criteria_description' => $validateData['cri_desc'],
                'criteria_percent' => $validateData['cri_per'],
                
            ]);
        }

        return redirect('/admin/criteria/criterias/'.$validateData['contest_id'])->with('success','Criteria Added Successfully');
    }

    
    //to update judge form
    public function update($criteria_id,$contest_id){
        $contest = Contest::find($contest_id);
        $criteria = Criteria::find($criteria_id);
        return view('admin.criteria.criteria_update',compact('criteria','contest'));
    }

    
    //to store the value of the update judge form
    public function update_store(Request $request){

        $validateData = $request->validate([
            'criteria_id' => 'required',
            'contest_id' => 'required', //contest id
            'cri_name' => 'required',
            'cri_desc' => 'required',
            'cri_per' => 'required',
        ]);

        if($validateData){
            $criteria = Criteria::find($validateData['criteria_id']);
            
            $criteria['criteria_name'] = $validateData['cri_name'];
            $criteria['criteria_description'] = $validateData['cri_desc'];
            $criteria['criteria_percent'] = $validateData['cri_per'];
            
            
        }
        $criteria->save();
        return redirect('/admin/criteria/criterias/'.$validateData['contest_id'])->with('success','Criteria Updated Successfully');
    }
    
    
    //to delete contestant
    public function delete(Request $request){
        $validateData = $request->validate([
            'criteria_id' => 'required',
            'contest_id' => 'required'
        ]);
        $criteria = Criteria::find($validateData['criteria_id']);
        $criteria->delete();
        return redirect('/admin/criteria/criterias/'.$validateData['contest_id'])->with('success','Criteria Deleted Successfully');
        
    }
    
}

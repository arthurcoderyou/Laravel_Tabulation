<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Criteria;
use App\Models\Judgement;
use Illuminate\Http\Request;

class JudgementController extends Controller
{
    //create judgement and store it
    public function add(Request $request){
        //dd($request->all());
        $contest = Contest::find($request['contest_id']);
        $criterias = Criteria::where('contest_id',$contest->id)->get();

        $final_score = 0;
        foreach ($criterias as $criteria) {
            $value = $request[$criteria->criteria_name];
            $percent = $criteria->criteria_percent;

            $initial_value = $value * $percent;
            $final_score += $initial_value;
        }

        Judgement::create([
            'contest_id' => $request['contest_id'],
            'judge_id' => $request['judge_id'],
            'contestant_id' => $request['contestant_id'],
            'contestant_score' => $final_score
        ]);
        
        return redirect('/admin/judgement/contest_contestants/'.$request['judge_id'].'/'.$request['contest_id'].'')->with('success','Contestant Scored Successfully');
    }

    //delete judgement [ RESET ]
    public function delete(Request $request){
        $validateData = $request->validate([
            'contest_id' => 'required',
            'judge_id' => 'required',
            'contestant_id' => 'required',
        ]);

        if($validateData){
            $judgements = Judgement::all();
            foreach($judgements as $judgement){
                if($judgement->contest_id == $validateData['contest_id'] && $judgement->judge_id == $validateData['judge_id'] && $judgement->contestant_id == $validateData['contestant_id'] ){
                    $judgement->delete();
                }
            }
        }
        return redirect('/admin/judgement/contest_contestants/'.$validateData['judge_id'].'/'.$validateData['contest_id'].'')->with('success','Contestant Resetted Score Successfully');
    }



    //create judgement and store it [JUDGE ACCOUNT]
    public function judge_acc_add(Request $request){
        //dd($request->all());
        $contest = Contest::find($request['contest_id']);
        $criterias = Criteria::where('contest_id',$contest->id)->get();

        $final_score = 0;
        foreach ($criterias as $criteria) {
            $value = $request[$criteria->criteria_name];
            $percent = $criteria->criteria_percent;

            $initial_value = $value * $percent;
            $final_score += $initial_value;
        }

        Judgement::create([
            'contest_id' => $request['contest_id'],
            'judge_id' => $request['judge_id'],
            'contestant_id' => $request['contestant_id'],
            'contestant_score' => $final_score
        ]);
        
        $user_id = auth()->user()->id;
        return redirect('/judge/judgement/contest_contestants/'.$user_id.'')->with('success','Contestant Scored Successfully');
    }

    //delete judgement [ RESET ] [JUDGE ACCCOUNT]
    public function judge_acc_delete(Request $request){
        $validateData = $request->validate([
            'contest_id' => 'required',
            'judge_id' => 'required',
            'contestant_id' => 'required',
        ]);

        if($validateData){
            $judgements = Judgement::all();
            foreach($judgements as $judgement){
                if($judgement->contest_id == $validateData['contest_id'] && $judgement->judge_id == $validateData['judge_id'] && $judgement->contestant_id == $validateData['contestant_id'] ){
                    $judgement->delete();
                }
            }
        }

        $user_id = auth()->user()->id;
        return redirect('/judge/judgement/contest_contestants/'.$user_id.'')->with('success','Contestant Resetted Score Successfully');
    }
}

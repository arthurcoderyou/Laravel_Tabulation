<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judge;
use App\Models\Contest;
use App\Models\Criteria;
use App\Models\Judgement;
use App\Models\Contestant;
use Illuminate\Http\Request;

class JudgeAccountController extends Controller
{
    /*
    //judgement contests
    public function JudgementContests(){
        $user = User::find(auth()->user()->id);
        $judge = Judge::find($user->id);
        $contests = Contest::where('user');
        return view('judge.judgement.contests',compact('contests'));
    }


    //judgement judges
    public function JudgementContestJudges($contest_id){
        $judges = Judge::where('contest_id',$contest_id)->get();
        $contest = Contest::find($contest_id);
        $users = User::all();

        return view('judge.judgement.contest_judges',compact('judges','contest','users'));
    }*/

    //judgement contestants
    public function JudgementContestContestants($user_id){
        $us = User::find($user_id);
        $judge = "";
        $judges = Judge::all();
        foreach($judges as $j){
            if($j->user_id == $us->id){
                $judge = $j;
            }
        }

        $judgements = Judgement::all();
        $contestants = Contestant::where('contest_id',$judge->contest_id)->get();
        $contest = Contest::find($judge->contest_id);
        $users = User::all();

        return view('judge.judgement.contest_contestants',compact('judge','judgements','contestants','contest','users'));
    }

    //to the judgement form
    public function Judgement($judge_id,$contest_id,$contestant_id){
        $judge = Judge::find($judge_id);
        $contest = Contest::find($contest_id);
        $contestant = Contestant::find($contestant_id);
        $user_judge = User::find($judge->user_id);
        $user_contestant = User::find($contestant->user_id);
        $criterias = Criteria::where('contest_id',$contest_id)->get();

        return view('judge.judgement.contestant_scoring',compact('judge','contest','contestant','user_judge','user_contestant','criterias'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judge;
use App\Models\Contest;
use App\Models\Criteria;
use App\Models\Judgement;
use App\Models\Contestant;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    


    //contests
    public function Contests(){
        $contests = Contest::all();
        return view('admin.contest.contests',compact('contests'));
    }


    //contestants contest
    public function ContestantContests(){
        $contests = Contest::all();
        return view('admin.contestant.contests',compact('contests'));
    }

    //contestants
    public function Contestants($contest_id){
        $contestants = Contestant::where('contest_id',$contest_id)->get();
        $contest = Contest::find($contest_id);
        $users = User::all();

        return view('admin.contestant.contestants',compact('contestants','contest','users'));
    }


    //judge contests
    public function JudgeContests(){
        $contests = Contest::all();
        return view('admin.judge.contests',compact('contests'));
    }

    //judges
    public function Judges($contest_id){
        $judges = Judge::where('contest_id',$contest_id)->get();
        $contest = Contest::find($contest_id);
        $users = User::all();

        return view('admin.judge.judges',compact('judges','contest','users'));
    }


    //criteria contests
    public function CriteriaContests(){
        $contests = Contest::all();
        return view('admin.criteria.contests',compact('contests'));
    }

    //criterias
    public function Criterias($contest_id){
        $criterias = Criteria::where('contest_id',$contest_id)->get();
        $contest = Contest::find($contest_id);

        return view('admin.criteria.criterias',compact('criterias','contest'));
    }

    //judgement contests
    public function JudgementContests(){
        $contests = Contest::all();
        return view('admin.judgement.contests',compact('contests'));
    }


    //judgement judges
    public function JudgementContestJudges($contest_id){
        $judges = Judge::where('contest_id',$contest_id)->get();
        $contest = Contest::find($contest_id);
        $users = User::all();

        return view('admin.judgement.contest_judges',compact('judges','contest','users'));
    }

    //judgement contestants
    public function JudgementContestContestants($judge_id,$contest_id){
        $judge = Judge::find($judge_id);
        $judgements = Judgement::all();
        $contestants = Contestant::where('contest_id',$contest_id)->get();
        $contest = Contest::find($contest_id);
        $users = User::all();

        return view('admin.judgement.contest_contestants',compact('judge','judgements','contestants','contest','users'));
    }

    //to the judgement form
    public function Judgement($judge_id,$contest_id,$contestant_id){
        $judge = Judge::find($judge_id);
        $contest = Contest::find($contest_id);
        $contestant = Contestant::find($contestant_id);
        $user_judge = User::find($judge->user_id);
        $user_contestant = User::find($contestant->user_id);
        $criterias = Criteria::where('contest_id',$contest_id)->get();

        return view('admin.judgement.contestant_scoring',compact('judge','contest','contestant','user_judge','user_contestant','criterias'));
    }


    public function ContestsResults(){
        $contests = Contest::all();
        return view('admin.result.results',compact('contests'));
    }

    public function ContestAwarding($contest_id){
        $contest = Contest::find($contest_id);
        $users = User::all();
        $judgements = Judgement::all();
        $judges = Judge::where('contest_id',$contest_id)->get();
        $contestants = Contestant::where('contest_id',$contest_id)->get();

        return view('admin.result.contestant_awarding',compact('contest','users','judgements','judges','contestants'));
    }

    public function UserContestAwarding($contest_id){
        $contest = Contest::find($contest_id);
        $users = User::all();
        $judgements = Judgement::all();
        $judges = Judge::where('contest_id',$contest_id)->get();
        $contestants = Contestant::where('contest_id',$contest_id)->get();

        return view('contestant_awarding',compact('contest','users','judgements','judges','contestants'));
    }

}

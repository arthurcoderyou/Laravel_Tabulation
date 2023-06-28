<?php

use App\Models\User;
use App\Models\Judge;
use App\Models\Contest;
use App\Models\Judgement;
use App\Models\Contestant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\JudgementController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\JudgeAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $contests = Contest::all();
    return view('welcome',compact('contests'));
});




//Account Update
Route::middleware(['auth'])->group(function(){
    Route::prefix('profile')->group(function(){
        Route::get('/account',[UserController::class,'profile']);
        Route::post('/account/admin_update',[ProfileController::class,'admin_update']);
    });

    Route::get('/awards/{contest_id}',[AdminController::class,'UserContestAwarding']);
});


//Admin Routes
Route::middleware(['auth','role:admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::name('admin.')->group(function(){
            //Admin Contest Routes
                Route::prefix('contest')->group(function(){
                    Route::get('/contests',[AdminController::class,'Contests']);
                    Route::get('/contest_add',[ContestController::class,'add']);
                    Route::post('/contest_add_store',[ContestController::class,'add_store']);
                    Route::get('/contest_update/{contest_id}',[ContestController::class,'update']);
                    Route::post('/contest_update_store',[ContestController::class,'update_store']);
                    Route::post('/contest_delete',[ContestController::class,'delete']);
                });
            //end of Admin Contest Routes

            //Admin Contestant Routes
                Route::prefix('contestant')->group(function(){
                    Route::get('/contests',[AdminController::class,'ContestantContests']);
                    Route::get('/contestants/{contest_id}',[AdminController::class,'Contestants']);
                    Route::get('/contestant_add/{contest_id}',[ContestantController::class,'add']);
                    Route::post('/contestant_add_store',[ContestantController::class,'add_store']);
                    Route::get('/contestant_update/{contestant_id}/{contest_id}',[ContestantController::class,'update']);
                    Route::post('/contestant_update_store',[ContestantController::class,'update_store']);
                    Route::post('/contestant_delete',[ContestantController::class,'delete']);
                });
            //end of Admin Contestant Routes

            //Admin Judges Routes
                Route::prefix('judge')->group(function(){
                    Route::get('/contests',[AdminController::class,'JudgeContests']);
                    Route::get('/judges/{contest_id}',[AdminController::class,'Judges']);
                    Route::get('/judge_add/{contest_id}',[JudgeController::class,'add']);
                    Route::post('/judge_add_store',[JudgeController::class,'add_store']);
                    Route::get('/judge_update/{judge_id}/{contest_id}',[JudgeController::class,'update']);
                    Route::post('/judge_update_store',[JudgeController::class,'update_store']);
                    Route::post('/judge_delete',[JudgeController::class,'delete']);
                });
            //end of Admin Judges Routes

            
            //Admin Criteria Routes
                Route::prefix('criteria')->group(function(){
                    Route::get('/contests',[AdminController::class,'CriteriaContests']);
                    Route::get('/criterias/{contest_id}',[AdminController::class,'Criterias']);
                    Route::get('/criteria_add/{contest_id}',[CriteriaController::class,'add']);
                    Route::post('/criteria_add_store',[CriteriaController::class,'add_store']);
                    Route::get('/criteria_update/{criteria_id}/{contest_id}',[CriteriaController::class,'update']);
                    Route::post('/criteria_update_store',[CriteriaController::class,'update_store']);
                    Route::post('/criteria_delete',[CriteriaController::class,'delete']);
                });
            //end of Admin Criteria Routes

            //Admin Judgement Routes
                Route::prefix('judgement')->group(function(){
                    Route::get('/contests',[AdminController::class,'JudgementContests']);
                    Route::get('/contest_judges/{contest_id}',[AdminController::class,'JudgementContestJudges']);
                    Route::get('/contest_contestants/{judge_id}/{contest_id}',[AdminController::class,'JudgementContestContestants']);
                    Route::get('/contestant_scoring/{judge_id}/{contest_id}/{contestant_id}',[AdminController::class,'Judgement']);
                    Route::post('/contestant_scoring_store',[JudgementController::class,'add']);
                    Route::post('/contestant_scoring_reset',[JudgementController::class,'delete']);
                });
            //end of Admin Judgement Routes

            //Admin Result Routes
                Route::prefix('result')->group(function(){
                   Route::get('/results',[AdminController::class,'ContestsResults']); 
                   Route::get('/awards/{contest_id}',[AdminController::class,'ContestAwarding']);
                });
            //end of Admin Result Routes

        });
    });
});
//end of Admin Routes


//Judge Routes
Route::middleware(['auth','role:judge'])->group(function(){
    Route::prefix('judge')->group(function(){
       Route::name('judge.')->group(function(){
            Route::prefix('judgement')->group(function(){
                /*
                Route::get('/contests',[JudgeAccountController::class,'JudgementContests']);
                Route::get('/contest_judges/{contest_id}',[JudgeAccountController::class,'JudgementContestJudges']);
                */
                Route::get('/contest_contestants/{user_id}',[JudgeAccountController::class,'JudgementContestContestants']);
                Route::get('/contestant_scoring/{judge_id}/{contest_id}/{contestant_id}',[JudgeAccountController::class,'Judgement']);
                Route::post('/contestant_scoring_store',[JudgementController::class,'judge_acc_add']);
                Route::post('/contestant_scoring_reset',[JudgementController::class,'judge_acc_delete']);
            });
       });
    });


    
});
//end of Judge Routes




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

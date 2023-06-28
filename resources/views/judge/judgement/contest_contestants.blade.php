@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
    @php 
        $link_title = "Contest Judging"; //first link
        $link_subtitle = "Contest Contestants"; //subtitle link
        $main_title = "Contest Contestants"; //Header title
    @endphp
    <x-page_breadcrumb :link_title="$link_title" :link_subtitle="$link_subtitle" :main_title="$main_title"/>
<!--end of Page Breadcrumb-->



<div class="container-fluid">
  <div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- title -->
                <div class="d-md-flex">
                    <div class="col-sm-6">
                        @foreach($users as $user)
                        <?php
                            if($judge->user_id == $user->id){
                            $judge_name = $user->name;
                            }
                            
                        ?>
                        @endforeach
                        <h4 class="card-title">Contests Judge: {{ $judge_name }}</h4>
                        <h5 class="card-subtitle">Select Contestant to give Contest Scores</h5>
                    </div>

                    <div class="col-sm-6">
                        <a href="/judge/judgement/contest_judges/{{ $contest->id }}" class="btn btn-dark">Back to Judges</a>
                    </div>
                    
                </div>
                <!-- title -->
                <div class="table-responsive">
                    <table class="table mb-0 table-hover align-middle text-nowrap">
                        @if(session()->has('success'))
                            <thead>
                                <tr>
                                    <td class="text-center" colspan="7">
                                        <div class="alert alert-success alert-dismissible">{{ session('success') }}</div>
                                    </td>
                                </tr>
                                
                            </thead>
                        @endif
                        
                        <thead>
                            <tr>
                                <td class="text-center" colspan="7">
                                    
                                </td>
                            </tr>
                            <tr>
                                <th class="border-top-0">Photo</th>
                                <th class="border-top-0">Name</th>
                                <th class="text-center">Number</th>
                                <th class="text-center">Representing</th>
                                <th class="text-center">Final Score</th>
                                <th class="border-top-0 text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                            

                            @empty($contestants)
                                <tr>
                                    <td class="text-center" colspan="5">
                                        <h3>No Contestants Found</h3>
                                    </td>
                                </tr>
                                
                            @else
                                @foreach ($contestants as $contestant)
                                  @foreach($users as $user)
                                    <?php
                                      if($contestant->user_id == $user->id){
                                        $user_name = $user->name;
                                        $user_photo = $user->photo;
                                      }
                                      
                                    ?>
                                  @endforeach
                                    <tr>
                                        <td>
                                          <img src="{{ (!empty($user_photo)) ? url('upload/'.$user_photo) : url('upload/no_image.jpg') }}" alt="user-img" class="w-50" style="max-width:200px;">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php 
                                                    $t = substr($user_name,0,2);
                                                    ?>
                                                <div class="m-r-10"><a
                                                        class="btn btn-circle d-flex btn-info text-white ">{{ $t }}</a>
                                                </div>
                                                <div class="">
                                                    <h4 class="m-b-0 font-16">{{ $user_name }}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{ $contestant->contestant_number }}
                                        </td>
                                        
                                        <td class="text-center text-wrap">
                                          {{ $contestant->contestant_representing }}
                                        </td>

                                        {{-- check if there is an exsiting judgment --}}
                                        <?php 
                                            $output = "No Score";
                                            $jdg = false;
                                        ?>

                                        @foreach($judgements as $judgement)
                                        <?php 
                                        
                                            if($judgement->contest_id == $contest->id && $judgement->judge_id == $judge->id && $judgement->contestant_id == $contestant->id ){
                                                $output = "".$judgement->contestant_score;
                                                $jdg = true;
                                            }
                                        ?>
                                        @endforeach

                                        <td class="text-center">{{ $output }}</td>


                                        <td class="text-center">
                                            <a href="/judge/judgement/contestant_scoring/{{ $judge->id }}/{{ $contest->id }}/{{ $contestant->id }}" class="btn btn-info text-light {{ ($jdg) ? 'disabled' : '' }}" {{ ($jdg) ? 'disabled' : '' }}>Give Contest Score</a>
                                        </td>

                                        <td class="text-center">
                                            <form action="/judge/judgement/contestant_scoring_reset" method="post">
                                                @csrf
                                                <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                                                <input type="hidden" name="judge_id" value="{{ $judge->id }}">
                                                <input type="hidden" name="contestant_id" value="{{ $contestant->id }}">
                                                <button type="submit" class="btn btn-danger text-light {{ !($jdg) ? 'disabled' : '' }}" {{ !($jdg) ? 'disabled' : '' }}>Reset Contest Score</button>
                                            </form>
                                            
                                        </td>
                                        
                                    </tr>
                                
                                @endforeach
                            @endempty
                            
                            
                            
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
  </div>
</div>
  
@endsection
@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
@php 
$link_title = "Contests Results"; //first link
$link_subtitle = "Contestants Scores"; //subtitle link
$main_title = "Contestants Scores"; //Header title
@endphp
  <x-page_breadcrumb :link_title="$link_title" :link_subtitle="$link_subtitle" :main_title="$main_title"/>
<!--end of Page Breadcrumb-->
@php($judge_count = 0)

<div class="container-fluid">
  <div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- title -->
                <div class="d-md-flex">
                    <div class="col-sm-6">
                        <h4 class="card-title">{{ $contest->contest_name }}</h4>
                        <h5 class="card-subtitle">Contestants Score Board</h5>
                    </div>
                    
                    
                </div>
                <!-- title -->
                <div class="table-responsive">
                    <table class="table mb-0 align-middle text-nowrap">
                        @if($errors->any())
                          @foreach($errors as $error)
                          <thead>
                              <tr>
                                  <td class="text-center" colspan="5">
                                      <div class="alert alert-danger alert-dismissible">{{ $error->message }}</div>
                                  </td>
                              </tr>
                              
                          </thead>
                          @endforeach
                        @endif

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
                          <th>Photo</th>
                          <th>Name</th>
                          <th>Number</th>

                          
                          @foreach($judges as $judge)
                            @foreach($users as $user)
                              <?php
                                if($judge->user_id == $user->id){
                                  $judge_name = $user->name;
                                  $judge_count++;
                                }
                                
                              ?>
                            @endforeach
                            <th>{{ $judge_name }}</th>
                          @endforeach
                          <th>Final Score</th>
                        </thead>


                        @foreach($contestants as $contestant)
                        <tr>
                          
                            @foreach($users as $user)
                              <?php
                                if($contestant->user_id == $user->id){
                                  $user_name = $user->name;
                                  $user_photo = $user->photo;
                                }
                                
                              ?>
                            @endforeach
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
                          
                            <?php $finale = 0; $judgement_count = 0;?>
                            @foreach($judgements as $judgement)
                              <?php 

                                if($judgement->contest_id == $contest->id && $judgement->contestant_id == $contestant->id){
                                  ?>
                                    <th class="text-center">{{ $judgement->contestant_score }}</th>
                                  <?php
                                  $judgement_count++;
                                  $finale += $judgement->contestant_score;
                                }
                              ?>
                              
                            @endforeach
                            
                              
                            {{-- dummy th --}}
                            @for($i = 0; $i < ($judge_count - $judgement_count);$i++)
                                <th></th>
                            @endfor
                            

                            @if($finale == 0 || $judge_count == 0)
                                <td></td>
                            @else 
                              <td class="text-center">{{ $finale / $judge_count }}</td>
                            @endif
                          </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
  
@endsection
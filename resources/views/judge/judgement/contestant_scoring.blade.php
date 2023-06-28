@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
@php 
$link_title = "Contest Judging"; //first link
$link_subtitle = "Contestants Scoring"; //subtitle link
$main_title = "Contestants Scoring"; //Header title
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
                        <h4 class="card-title">{{ $contest->contest_name }} : Judge - {{ $user_judge->name }}</h4>
                        <h5 class="card-subtitle">Scoring Contestant : {{ $user_contestant->name }}</h5>
                    </div>
                    <div class="col-sm-6">
                        <a href="/judge/judgement/contest_contestants/{{ $judge->id }}/{{ $contest->id }}" class="btn btn-dark ml-auto">Back to Contestants</a>
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

                        
                        <tbody>
                          <form action="/judge/judgement/contestant_scoring_store" method="post" >
                            @csrf
                            <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                            <input type="hidden" name="judge_id" value="{{ $judge->id }}">
                            <input type="hidden" name="contestant_id" value="{{ $contestant->id }}">
                            
                            @foreach($criterias as $criteria)
                              <tr>
                                <th>{{ $criteria->criteria_name }}</th>  
                                <th>{{ $criteria->criteria_percent * 100 }} %</th>
                                <td class="w-50"><input name="{{ $criteria->criteria_name }}" type="number" class="form-control" min="1" max="100" step="1" placeholder="enter contestant criteria score..." required></td>
                              </tr>
                            @endforeach
                           
                            
                            <td><button class="btn btn-dark" type="submit">Submit</button></td>
                          </form>
                              
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
  
@endsection
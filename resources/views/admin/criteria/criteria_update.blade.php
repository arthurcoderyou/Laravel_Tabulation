@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
  @php 
    $link_title = "Criteria"; //first link
    $link_subtitle = "Update Criteria"; //subtitle link
    $main_title = "Update Criteria"; //Header title
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
                        <h4 class="card-title">{{ $contest->contest_name }}</h4>
                        <h5 class="card-subtitle">Update Criteria</h5>
                    </div>
                    <div class="col-sm-6">
                        <a href="/admin/criteria/criterias/{{ $contest->id }}" class="btn btn-dark ml-auto">Back</a>
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
                          <form action="/admin/criteria/criteria_update_store" method="post" >
                            @csrf
                            <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                            <input type="hidden" name="criteria_id" value="{{ $criteria->id }}">
                            <tr class="">
                              <th class="text-start bg-dark text-light" colspan="2" >Update Critera</th>
                            </tr>
                            <tr>
                              <th>Criteria Name</th>  
                              <td><input name="cri_name" value="{{ $criteria->criteria_name }}" type="text" class="form-control" placeholder="enter criteria name..." required></td>
                            </tr>
                            <tr>
                              <th>Criteria Description</th>  
                              <td>
                                <textarea name="cri_desc" id="" class="form-control" rows="3" placeholder="enter criteria description...">{{ $criteria->criteria_description }}</textarea>
                              </td>
                            </tr>
                            
                            <tr>
                              <th>Critera Percent</th>  
                              <td><input name="cri_per" value="{{ $criteria->criteria_percent }}" type="number" class="form-control" min="0.01" max="0.99" step="0.01" placeholder="enter criteria percent..." required></td>
                            </tr>

                           
                            
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
@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
    @php 
        $link_title = "Judges"; //first link
        $link_subtitle = ""; //subtitle link
        $main_title = "Judges"; //Header title
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
                        <h4 class="card-title">{{ $contest->contest_name }} Judges</h4>
                        <h5 class="card-subtitle">Select Judge to Update/Delete/View</h5>
                    </div>
                    <div class="col-sm-6">
                        <a href="/admin/judge/judge_add/{{ $contest->id }}" class="btn btn-dark ml-auto">Add New Judge</a>
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
                                <th class="text-center">Description</th>
                                <th class="border-top-0 text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                            

                            @empty($judges)
                                <tr>
                                    <td class="text-center" colspan="5">
                                        <h3>No Judges Found</h3>
                                    </td>
                                </tr>
                                
                            @else
                                @foreach ($judges as $judge)
                                  @foreach($users as $user)
                                    <?php
                                      if($judge->user_id == $user->id){
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
                                        <td class="text-center text-wrap">
                                            {{ $judge->judge_description }}
                                        </td>
                                        
                                        <td class="text-center">
                                            <a href="/admin/judge/judge_update/{{ $judge->id }}/{{ $contest->id }}" class="btn btn-info text-light">Update</a>
                                        </td>
                                        <td class="text-center">
                                            <form action="/admin/judge/judge_delete" method="post">
                                                @csrf
                                                <input name="judge_id" type="hidden" value="{{ $judge->id }}">
                                                <input name="contest_id" type="hidden" value="{{ $contest->id }}">
                                                <button class="btn btn-danger text-light" type="submit">Delete</button>
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
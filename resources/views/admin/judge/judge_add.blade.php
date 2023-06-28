@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
  @php 
    $link_title = "Judges"; //first link
    $link_subtitle = "Add Judge"; //subtitle link
    $main_title = "Add Judge"; //Header title
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
                        <h5 class="card-subtitle">Add Judge</h5>
                    </div>
                    <div class="col-sm-6">
                        <a href="/admin/judge/judges/{{ $contest->id }}" class="btn btn-dark ml-auto">Back</a>
                    </div>
                    
                </div>
                <!-- title -->
                <div class="table-responsive">
                    <table class="table mb-0 align-middle text-nowrap">
                        @error('c_name')
                          <thead>
                              <tr>
                                  <td class="text-center" colspan="5">
                                      <div class="alert alert-danger alert-dismissible">{{ $message }}</div>
                                  </td>
                              </tr>
                              
                          </thead>
                        @enderror

                        @error('c_date')
                          <thead>
                              <tr>
                                  <td class="text-center" colspan="5">
                                      <div class="alert alert-danger alert-dismissible">{{ $message }}</div>
                                  </td>
                              </tr>
                              
                          </thead>
                        @enderror

                        @error('c_show')
                          <thead>
                              <tr>
                                  <td class="text-center" colspan="5">
                                      <div class="alert alert-danger alert-dismissible">{{ $message }}</div>
                                  </td>
                              </tr>
                              
                          </thead>
                        @enderror

                        <tbody>
                          <form action="/admin/judge/judge_add_store" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                            <tr class="">
                              <th class="text-start bg-dark text-light" colspan="2" >Login Credentials</th>
                            </tr>
                            <tr>
                              <th>Judge Name</th>  
                              <td><input name="j_name" type="text" class="form-control" placeholder="enter judge name..." required></td>
                            </tr>
                            <tr>
                              <th>Judge Email</th>  
                              <td><input name="j_email" type="email" class="form-control" placeholder="enter judge email..." required></td>
                            </tr>
                            <tr>
                              <th>Judge Password</th>  
                              <td><input name="j_psw" type="password" class="form-control" placeholder="enter judge password..." required></td>
                            </tr>
                            <tr>
                              <th>Judge Photo</th>  
                              <td><input name="j_photo" type="file" class="form-control" placeholder="enter judge photo..." required></td>
                            </tr>

                            <tr>
                              <th colspan="2" class="text-start bg-dark text-light">Judge Credentials</th>  
                            </tr>
                            
                            <tr>
                              <th>Judge Description</th>
                              <td>
                                <textarea name="j_description" id="" class="form-control" rows="3" placeholder="enter judge description..." required></textarea>
                              </td>
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
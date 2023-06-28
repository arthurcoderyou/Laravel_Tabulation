@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
  @php 
    $link_title = "Contestants"; //first link
    $link_subtitle = "Update Contestant"; //subtitle link
    $main_title = "Update Contestant"; //Header title
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
                        <h5 class="card-subtitle">Update Contestant</h5>
                    </div>
                    <div class="col-sm-6">
                        <a href="/admin/contestant/contestants/{{ $contest->id }}" class="btn btn-dark ml-auto">Back</a>
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
                          <form action="/admin/contestant/contestant_update_store" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="contestant_id" value="{{ $contestant->id }}">
                            <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                            <tr class="">
                              <th class="text-start bg-dark text-light" colspan="2" >Login Credentials</th>
                            </tr>
                            <tr>
                              <th>Contestant Name</th>  
                              <td><input name="c_name" value="{{ $user->name }}" type="text" class="form-control" placeholder="enter contestant name..." required></td>
                            </tr>
                            <tr>
                              <th>Contestant Email</th>  
                              <td><input name="c_email" value="{{ $user->email }}" type="email" class="form-control" placeholder="enter contestant email..." required></td>
                            </tr>
                            <tr>
                              <th>Contestant Password</th>  
                              <td><input name="c_psw" value="" type="password" class="form-control" placeholder="enter new contestant password..."></td>
                            </tr>
                            <tr>
                              <th>Contestant Photo</th>  
                              <td><input name="c_photo" value="{{ $user->photo }}" type="file" class="form-control" placeholder="enter contestant photo..."></td>
                            </tr>

                            <tr>
                              <th colspan="2" class="text-start bg-dark text-light">Contestant Credentials</th>  
                            </tr>
                            <tr>
                              <th>Contestant Number</th>  
                              <td><input type="number" value="{{ $contestant->contestant_number }}" min="1" max="9" step="1" name="c_number" class="form-control" placeholder="enter contestant number..." required></td>
                            </tr>
                            <tr>
                              <th>Contestant Message</th>
                              <td>
                                <textarea name="c_message" id="" class="form-control" rows="3" placeholder="enter contestant message..." required>{{ $contestant->contestant_message }}</textarea>
                              </td>
                            </tr>
                            <tr>
                              <th>Contestant Representing</th>
                              <td>
                                <input name="c_representing" value="{{ $contestant->contestant_representing }}" type="text" class="form-control" placeholder="enter contestant representing..." required>
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
@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
    @php 
        $link_title = "Account"; //first link
        $link_subtitle = ""; //subtitle link
        $main_title = "Account Update"; //Header title
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
                          <h4 class="card-title">Hello {{ auth()->user()->name }}</h4>
                          <h5 class="card-subtitle">Account </h5>
                      </div>
                      <div class="col-sm-6">
                          <a href="/" class="btn btn-dark ml-auto">Back</a>
                      </div>
                      
                  </div>
                  <!-- title -->
                  <div class="table-responsive">
                      <table class="table mb-0 align-middle text-nowrap">
                            @if (session('status') === 'password-updated')
                                <thead>
                                    <tr>
                                        <td class="text-center" colspan="5">
                                            <div class="alert alert-success alert-dismissible">{{ session('status') }}</div>
                                        </td>
                                    </tr>
                                    
                                </thead>
                            @endif
                            @if($errors->updatePassword->any())
                                <thead>
                                    @foreach($errors->updatePassword->all() as $error)
                                        <tr>
                                            <td class="text-center" colspan="5">
                                                <div class="alert alert-danger alert-dismissible">
                                                    {{ $error }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </thead>
                            @endif
  
  
                         
                          <tbody>
                            <form action="{{ route('password.update') }}" method="post" >
                              @csrf
                              @method('put')
                              <tr class="">
                                <th class="text-start bg-dark text-light" colspan="2" >Reset Password</th>
                              </tr>
                              
                              <tr>
                                <th>Current Password</th>  
                                <td><input name="current_password"  type="password" class="form-control" placeholder="enter current password..." required></td>
                              </tr>
                              <tr>
                                <th>New Password</th>  
                                <td><input name="password"  type="password" class="form-control" placeholder="enter new account password..."></td>
                              </tr>
                              <tr>
                                <th>Re-enter Password</th>  
                                <td><input name="password_confirmation"  type="password" class="form-control" placeholder="re-enter new account password..."></td>
                              </tr>
                              
                              
                              
                              <td colspan="2"><button class="btn btn-dark" type="submit">Save</button></td>
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
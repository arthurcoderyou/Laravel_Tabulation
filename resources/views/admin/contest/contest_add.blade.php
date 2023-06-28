@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
  @php 
    $link_title = "Contests"; //first link
    $link_subtitle = "Add Contest"; //subtitle link
    $main_title = "Add Contest"; //Header title
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
                        <h4 class="card-title">Contests</h4>
                        <h5 class="card-subtitle">Add Contest</h5>
                    </div>
                    <div class="col-sm-6">
                        <a href="/admin/contest/contests" class="btn btn-dark ml-auto">Back</a>
                    </div>
                    
                </div>
                <!-- title -->
                <div class="table-responsive">
                    <table class="table mb-0 table-hover align-middle text-nowrap">
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
                          <form action="/admin/contest/contest_add_store" method="post">
                            @csrf
                            <tr>
                              <th>Contest Name</th>  
                              <td><input name="c_name" type="text" class="form-control" placeholder="enter contest name..." required></td>
                            </tr> 
                            <tr>
                              <th>Announcement Date</th>  
                              <td><input name="c_date" type="date" class="form-control" placeholder="enter contest name..." required></td>
                            </tr>
                            <tr>
                              <th>Show Contest Results</th>  
                              <td>
                                <select name="c_show" id="" class="form-control" required>
                                  <option value="">select</option>
                                  <option value="1">Show</option>
                                  <option value="0">Hide</option>
                                </select>
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
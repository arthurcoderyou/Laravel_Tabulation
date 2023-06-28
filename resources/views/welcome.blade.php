@extends('layouts.main_layout')
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                    </nav>
                    @auth
                        @if (auth()->user()->role == 'admin')
                            <h1 class="mb-0 fw-bold">Admin Dashboard</h1> 
                        @elseif(auth()->user()->role == 'judge')
                            <h1 class="mb-0 fw-bold">Judge Dashboard</h1> 
                        @elseif(auth()->user()->role == 'judge')
                            <h1 class="mb-0 fw-bold">Contestant Dashboard</h1> 
                        @elseif(auth()->user()->role == 'judge')
                            <h1 class="mb-0 fw-bold">User Dashboard</h1> 
                        @endif    
                    @endauth
                    @guest 
                        <h1 class="mb-0 fw-bold">Dashboard</h1>     
                    @endguest
                
            </div>
            <div class="col-6">
                {{-- login button --}}
                
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        
        <!-- Table -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <h4 class="card-title">Contests</h4>
                                <h5 class="card-subtitle">Select to view the contest results</h5>
                            </div>
                            
                        </div>
                        <!-- title -->
                        <div class="table-responsive">
                          <table class="table mb-0 table-hover align-middle text-nowrap">
                              @if(session()->has('success'))
                                  <thead>
                                      <tr>
                                          <td class="text-center" colspan="5">
                                              <div class="alert alert-success alert-dismissible">{{ session('success') }}</div>
                                          </td>
                                      </tr>
                                      
                                  </thead>
                              @endif
                              
                              <thead>
                                  <tr>
                                      <td class="text-center" colspan="5">
                                          
                                      </td>
                                  </tr>
                                  <tr>
                                      <th class="border-top-0">Contest Name</th>

                                      <th class="text-center">Announcement Date</th>
                                      @auth
                                        @if(auth()->user()->role == 'admin')
                                            <th class="text-center">Show Results</th>
                                        @endif
                                      @endauth
                                      <th class="border-top-0 text-center" colspan="">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                      
                                  
      
                                  @empty($contests)
                                      <tr>
                                          <td class="text-center" colspan="5">
                                              <h3>No Contest Found</h3>
                                          </td>
                                      </tr>
                                      
                                  @else
                                      @foreach ($contests as $contest)
                                          <tr>
                                              <td>
                                                  <div class="d-flex align-items-center">
                                                      <?php 
                                                          $t = substr($contest->contest_name,0,2);
                                                      ?>
                                                      <div class="m-r-10"><a
                                                              class="btn btn-circle d-flex btn-info text-white">{{ $t }}</a>
                                                      </div>
                                                      <div class="">
                                                          <h4 class="m-b-0 font-16">{{ $contest->contest_name }}</h4>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="text-center">
                                                  {{ $contest->announcement_date }}
                                              </td>

                                                @auth
                                                    @if(auth()->user()->role == 'admin')
                                                        <td class="text-center">
                                                            @if($contest->show_contest_result == 1)
                                                                Show
                                                            @else 
                                                                Hide
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endauth

                                              
                                              <td class="text-center">
                                                  <a href="/awards/{{ $contest->id }}" class="btn btn-info text-light">View Contest Awards</a>
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
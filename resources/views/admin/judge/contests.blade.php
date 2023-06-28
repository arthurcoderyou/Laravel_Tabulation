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
                        <h4 class="card-title">Judges Contests</h4>
                        <h5 class="card-subtitle">Select Contest to Update/Delete/View Judges</h5>
                    </div>
                    
                </div>
                <!-- title -->
                <div class="table-responsive">
                    <table class="table mb-0 table-hover align-middle text-nowrap">
                        @if(session()->has('success'))
                            <thead>
                                <tr>
                                    <td class="text-center" colspan="4">
                                        <div class="alert alert-success alert-dismissible">{{ session('success') }}</div>
                                    </td>
                                </tr>
                                
                            </thead>
                        @endif
                        
                        <thead>
                            <tr>
                                <td class="text-center" colspan="4">
                                    
                                </td>
                            </tr>
                            <tr>
                                <th class="border-top-0">Contest Name</th>
                                <th class="text-center">Announcement Date</th>
                                <th class="text-center">Show Results</th>
                                <th class="border-top-0 text-center" colspan="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                            

                            @empty($contests)
                                <tr>
                                    <td class="text-center" colspan="4">
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
                                        <td class="text-center">
                                            @if($contest->show_contest_result == 1)
                                                Show
                                            @else 
                                                Hide
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="/admin/judge/judges/{{ $contest->id }}" class="btn btn-info text-light">View Judges</a>
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
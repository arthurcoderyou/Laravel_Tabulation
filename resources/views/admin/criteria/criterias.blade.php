@extends('layouts.main_layout')
@section('content')

<!--Page Breadcrumb-->
    @php 
        $link_title = "Criterias"; //first link
        $link_subtitle = ""; //subtitle link
        $main_title = "Criterias"; //Header title
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
                        <h4 class="card-title">{{ $contest->contest_name }} Criterias</h4>
                        <h5 class="card-subtitle">Select Criteria to Update/Delete/View</h5>
                    </div>
                    <div class="col-sm-6">
                        <a href="/admin/criteria/criteria_add/{{ $contest->id }}" class="btn btn-dark ml-auto">Add New Criteria</a>
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
                                <th class="border-top-0">Criteria Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Grade Percent</th>
                                <th class="border-top-0 text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                            

                            @empty($criterias)
                                <tr>
                                    <td class="text-center" colspan="5">
                                        <h3>No Criterias Found</h3>
                                    </td>
                                </tr>
                                
                            @else
                                @foreach ($criterias as $criteria)
                                   
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php 
                                                    $t = substr($criteria->criteria_name,0,2);
                                                    ?>
                                                <div class="m-r-10"><a
                                                        class="btn btn-circle d-flex btn-info text-white ">{{ $t }}</a>
                                                </div>
                                                <div class="">
                                                    <h4 class="m-b-0 font-16">{{ $criteria->criteria_name }}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center text-wrap">
                                            {{ $criteria->criteria_description }}
                                        </td>
                                        <td class="text-center text-wrap">
                                            {{ ($criteria->criteria_percent * 100) }} %
                                        </td>
                                        
                                        <td class="text-center">
                                            <a href="/admin/criteria/criteria_update/{{ $criteria->id }}/{{ $contest->id }}" class="btn btn-info text-light">Update</a>
                                        </td>
                                        <td class="text-center">
                                            <form action="/admin/criteria/criteria_delete" method="post">
                                                @csrf
                                                <input name="criteria_id" type="hidden" value="{{ $criteria->id }}">
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
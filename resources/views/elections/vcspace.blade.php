@extends('layouts.app_dashboard')
@section('title')
<title>Candidats Election | VoteConnect</title>
@endsection
@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('partials._sidebar')
        <div class="layout-page">
            @include('partials._navuser')
           <!-- Content wrapper -->
          <div class="">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-8 mb-4 order-0">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Vote now</h4>
                        <div class="row">
                            
                            @foreach ($electionsDatas as $election)
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                <div class="card-title">
                                                <h5 class="text-nowrap mb-2">{{$election["title"]}}</h5>
                                                <span class="badge bg-label-warning rounded-pill">{{ $election["days"] }} jour(s)</span>
                                                </div>
                                                <div class="mt-sm-auto">
                                                <small class="text-success text-nowrap fw-semibold"
                                                    ><i class="bx bx-chevron-up"></i> 68.2%</small
                                                >
                                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                    <h3 class="mb-0">{{$election["total_votes_received"]}} votes</h3>
                                                    
                                                    <a href="{{route('election.public.show', $election["code"])}}" class="btn btn-sm rounded-pill btn-primary">
                                                        <span class="tf-icons bx bx-pie-chart-alt"></span>&nbsp; vote
                                                    </a>
                                                    
                                                </div>
                                                
                                                </div>
                                            </div>
                                            <div id="">

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                           
                        </div>
                       
                    </div>
                    <div class="col-lg-4 col-md-4 order-1">

                    </div>
                </div>
  
            </div>


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
    </div>
</div>
@endsection
@push('after_script')
  
@endpush
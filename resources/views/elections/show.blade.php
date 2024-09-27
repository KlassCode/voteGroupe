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
                    <div class="col-lg-7 mb-4 order-0">
                        <div class="d-flex flex-row align-items-center justify-content-start">
                            <h4 class="py-3 mb-4"><span class="text-muted fw-bold">{{$election->title}}</span></h4>
                            <span class="badge bg-label-success mb-4 rounded-pill">En ligne</span>
                        </div>

                        <div class="card">
                            <div class="d-flex align-items-end row">
                              <div class="col-sm-7">
                                <div class="card-body">
                                  <h5 class="card-title text-primary">Cree par {{$election->user->name}} 🎉</h5>
                                  <p class="mb-4">
                                    Description You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                    your profile.
                                  </p>
                                  <p class="mb-4">
                                    {{$election->open_date}} | {{$election->close_date}}
                                  </p>
        
                                  <span class="badge bg-label-info mb-4 rounded-pill">{{$election->total_votes_received}} votes</span>
                                </div>
                              </div>
                              <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                  <img
                                    src="{{asset('assets/img/dashboard/man-with-laptop-light.png')}}"
                                    height="140"
                                    alt="View Badge User"
                                    data-app-dark-img="dashboard/man-with-laptop-light.png"
                                    data-app-light-img="dashboard/man-with-laptop-light.png"
                                  />
                                </div>
                              </div>
                            </div>
                        </div>

                        <h4 class="fw-light py-3 mb-2"><span class="text-muted fw-light">Candidats</span></h4>

                        <div class="row">
                            @foreach ($election->candidates as $candidate)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            @if ($candidate->avatar!="")
                                                <img src="{{Storage::url($candidate->avatar)}}" alt="Credit Card" class="rounded" />    
                                            @else
                                                <img src="{{asset('assets/img/dashboard/1.png')}}" alt="Credit Card" class="rounded" />    
                                            @endif
                                            
                                        </div>
                                        <div class="dropdown">
                                            <button
                                            class="btn p-0"
                                            type="button"
                                            id="cardOpt4"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            >
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="javascript:void(0);">Voir plus</a>
                                            </div>
                                        </div>
                                        </div>
                                        <span class="d-block mb-1 fw-bold">{{$candidate->fullname}}</span>
                                        <h4 class="card-title text-nowrap fw-light mb-2">{{$candidate->number_of_votes}} votes</h4>
                                        <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
                                        <form action="{{route('candidate.vote.add',$candidate->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm rounded-pill btn-info">
                                                <span class="tf-icons bx bx-pie-chart-alt"></span>&nbsp;Vote</button>
                                            </form>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            
                        </div>
                       
                    </div>
                    <div class="col-lg-5 col-md-5 order-1">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                              <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Classement Candidats</h5>
                                <small class="text-muted">{{$visitorsNumber}} visiteurs</small>
                              </div>
                              <div class="dropdown">
                                <button
                                  class="btn p-0"
                                  type="button"
                                  id="orederStatistics"
                                  data-bs-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                  <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                  <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-column align-items-center gap-1">
                                  <h2 class="mb-2">{{$election->total_votes_received}}</h2>
                                  <span>Total Votes</span>
                                </div>
                                <div id="orderStatisticsChart"></div>
                              </div>
                              <ul class="p-0 m-0">
                                @foreach ($election->candidates as $candidate)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                      <span class="avatar-initial rounded bg-label-primary">
                                        @if ($candidate->avatar!="")
                                            <img src="{{Storage::url($candidate->avatar)}}" alt="Credit Card" class="rounded" />    
                                        @else
                                            <img src="{{asset('assets/img/dashboard/1.png')}}" alt="Credit Card" class="rounded" />    
                                        @endif
                                      </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                      <div class="me-2">
                                        <h6 class="mb-0">{{$candidate->fullname}}</h6>
                                        <small class="text-muted">{{$candidate->email}}</small>
                                      </div>
                                      <div class="user-progress">
                                        <small class="fw-semibold">{{$candidate->number_of_votes}} votes</small>
                                      </div>
                                    </div>
                                  </li> 
                                @endforeach
                                
                              </ul>
                            </div>
                          </div>
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
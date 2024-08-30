@extends('layouts.app_dashboard')
@section('title')
<title>Creation Election | VoteConnect</title>
@endsection
@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('partials._sidebar')
        <div class="layout-page">
            @include('partials._navuser')
           <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Organiser Election</span></h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Section Information</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      {{-- Form that create the election --}}
                      <form id="election-form" method="POST" action="{{route('election.store')}}">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-title">Titre</label>
                          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="basic-default-title" value="{{ old('title')}}" placeholder="Titre Election" />
                          
                          @error('title')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror

                        </div>
                       
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-opendate">Date Ouverture</label>
                          <input type="date" class="form-control @error('open_date') is-invalid @enderror" name ="open_date" id="basic-default-opendate" value="{{ old('open_date')}}" placeholder="Date de debut de l'election" />
                        
                          @error('open_date')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-closedate">Date Fermeture</label>
                            <input type="date" class="form-control @error('close_date') is-invalid @enderror" name="close_date" id="basic-default-closedate" value="{{ old('close_date')}}" placeholder="Date fermetture des votes" />
                            @error('open_date')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        {{-- <div class="mb-3">
                          <label class="form-label" for="basic-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              id="basic-default-email"
                              class="form-control"
                              placeholder="john.doe"
                              aria-label="john.doe"
                              aria-describedby="basic-default-email2"
                            />
                            <span class="input-group-text" id="basic-default-email2">@example.com</span>
                          </div>
                          <div class="form-text">You can use letters, numbers & periods</div>
                        </div> --}}
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-nbcandidates">Nombre de Candidats</label>
                          <input
                            type="number"
                            id="basic-default-nbcandidates"
                            class="form-control phone-mask @error('number_of_candidates') is-invalid @enderror"
                            name="number_of_candidates"
                            value="{{ old('number_of_candidates')}}"
                            placeholder="Le nombre de participants"
                          />
                          @error('number_of_candidates')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-xl">
                  
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
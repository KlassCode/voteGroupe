@extends('layouts.app_dashboard')
@section('title')
<title>Candidature  | VoteConnect</title>
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
                    <div class="col-lg-6 mb-4 order-0">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Mes Candidatures</h4>
                            <!-- Bootstrap Table with Header - Light -->
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                <thead class="table-light">
                                    <tr>
                                    <th>ELection</th>
                                    <th>Participe ?</th>    
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ( $candidatures as $candidate)
                                    <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$candidate["election"]->title}}</strong></td>
                                    @if ($candidate["participation"])
                                        <td><span class="badge bg-label-success me-1">Oui</span></td>
                                    @else
                                        <td><span class="badge bg-label-danger me-1">Non</span></td>
                                    @endif
                                    <td>
                                        <span class="d-flex">
                                            {{-- <a class="dropdown-item" href="{{route('election.edit',$candidate->id)}}"
                                            ><i class="bx bx-edit-alt me-1"></i></a
                                            > --}}
                                            @if ($candidate["participation"])
                                                <button type="button" class="btn rounded-pill btn-info btn-sm candidate-view" data-id={{$candidate['id']}} data-fullname="{{$candidate['fullname']}}" data-email="{{$candidate['email']}}" data-participation={{$candidate['participation']}} data-election="{{$candidate["election"]->title}}">Voir</button>
                                            @else
                                                <button type="button" class="btn rounded-pill btn-warning btn-sm candidate-view" data-id={{$candidate['id']}} data-fullname="{{$candidate['fullname']}}" data-email="{{$candidate['email']}}" data-participation={{$candidate['participation']}} data-election="{{$candidate["election"]->title}}">Confirmer</button>
                                            @endif
                                            
                                            <form action="{{route('election.delete',$candidate['id'])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="dropdown-item"
                                            ><i class="bx bx-trash me-1"></i></button>
                                            </form>
                                            
                                            </span>
                                    </td>
                                    
                                    </tr>
                                    @empty
                                    <p>Pas de Candidature</p>
                                    @endforelse
                                
                                </tbody>
                                </table>
                            </div>
                        
                        <!--/ Basic Bootstrap Table -->
                    </div>
                    <!--Carte Candidat -->
                    <div class="col-lg-6 col-md-4 order-1 d-none" id="candidate-card">
                        <div class="card text-center">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-header text-start">Ma Carte Candidat <span class="badge rounded-pill bg-label-success me-1">Ouvert</span></h5></div>
                                <div class="col-lg-6 d-flex mt-4 pt-1">
                                    <div class="avatar flex-shrink-0 me-1">
                                        <img src="{{asset('assets/img/icons/paypal.png')}}" alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
                                        <div class="me-2">
                                          <small class="text-muted d-block mb-1 text-start">Rang : {{0}}</small>
                                          <h6 class="mb-0">Qte Votes</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                          <h5 class="mb-0">0</h5>
                                          <span class="text-muted m-1">Votes</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img
                                      src="{{asset('assets/img/dashboard/1.png')}}"
                                      alt="user-avatar"
                                      class="d-block rounded"
                                      height="100"
                                      width="100"
                                      id="uploadedAvatar"
                                    />
                                    <div class="button-wrapper">
                                      <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Ajouter une photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input
                                          type="file"
                                          id="upload"
                                          class="account-file-input"
                                          hidden
                                          accept="image/png, image/jpeg"
                                        />
                                      </label>
            
                                      <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                  </div>
                                    {{-- <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a> --}}
                            </div>
                            <hr class="my-0" />
                            <div class="card shadow-none text-start bg-transparent border border-info m-3">
                                <div class="card-body">
                                  <h5 class="card-title">Informations</h5>
                                  <form id="add-candidate-form" method="POST" action="{{route('candidate.approuve')}}">
                                        @csrf
                                        <input type="hidden" id="election-id" name="election_id" value="">
                                        <input type="hidden" id="candidature-id" name="id" value="">
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-default-email">Election</label>
                                            <input type="mail" class="form-control" name="election" id="election-title" disabled/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-default-email">Email</label>
                                            <input type="mail" class="form-control" name="email" id="email" disabled/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-default-fullname">Nom Complet</label>
                                            <input type="text" class="form-control" name="fullname" id="fullname"/>
                                        </div>  
                                        <button type="submit" class="btn btn-primary" id="btn-participation-confirm">Je participe</button>
                                  </form>
                                </div>
                            </div>

                            

                            

                            
                            <div class="card-footer text-muted">2 days ago</div>
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
<script type="text/javascript">
    $(document).on("click", ".candidate-view", function () {
        let myCandidateId = $(this).data('id');
        let myCandidateName = $(this).data('fullname');
        let myCandidateEmail = $(this).data('email');
        let myCandidateElection = $(this).data('election');
        let myCandidateParticipation = $(this).data('participation')
        
        if(myCandidateParticipation==0){
            //give the view where candidate can modify his information and confirm his participation
            $("#fullname").val(myCandidateName);
            $("#candidature-id").val(myCandidateId);
            $("#email").val(myCandidateEmail);
            $("#election-title").val(myCandidateElection);
            $("#candidate-card").removeClass("d-none");
            $("#btn-participation-confirm").removeClass('d-none');
            console.log("Hello")
        }else{
            //give the view where candidate can view his progressin in election
            $("#fullname").val(myCandidateName);
            $("#email").val(myCandidateEmail);
            $("#candidate-id").val(myCandidateId);
            $("#election-title").val(myCandidateElection);
            $("#btn-participation-confirm").addClass('d-none');
            $("#candidate-card").removeClass("d-none");
            console.log("Hello")
        }
    });
    
</script>
@endpush
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
                          <input type="text" class="form-control" name="title" id="basic-default-title" value="{{$election->title}}" placeholder="Titre Election" />
                          

                        </div>
                       
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-opendate">Date Ouverture</label>
                          <input type="date" class="form-control" name ="open_date" id="basic-default-opendate" value="{{$election->open_date}}" placeholder="Date de debut de l'election" />
                        
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-closedate">Date Fermeture</label>
                            <input type="date" class="form-control" name="close_date" id="basic-default-closedate" value="{{$election->close_date}}" placeholder="Date fermetture des votes" />

                          </div>
                        
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-nbcandidates">Nombre de Candidats</label>
                          <input
                            type="number"
                            id="basic-default-nbcandidates"
                            class="form-control phone-mask"
                            name="number_of_candidates"
                            value="{{$election->number_of_candidates}}"
                            placeholder="Le nombre de participants"
                          />
                          
                        </div>
                        <button type="submit" class="btn btn-primary disable">Enregistrer</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Information Candidats</h5>
                      <small class="text-muted float-end">Renseignements des candidats</small>
                    </div>
                    
                    <div class="card-body">
                      <h5 class="card-header">Inscrivez vos Candidats 
                        <span>
                          {{-- <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal" id="#addcandidat" class=" --}}
                          <button type="button" class="btn btn-success d-inline-flex float-end" data-bs-toggle="modal" data-bs-target="#addCandidat">Ajouter un candidats</button>
                        </span>
                      </h5>
                      {{-- Modal add Candidates --}}
                      <div class="modal fade" id="addCandidat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un candidat</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form id="add-candidate-form">
                                @csrf
                                <input type="hidden" id="election_id" name="election_id" value="{{$election->id}}">
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nom Complet</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nom et Prenom Candidat" />
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-email">Email</label>
                                    <input type="mail" class="form-control" name="email" id="email" placeholder="Email du Candidat" />
                                  </div>

                                <button type="button" class="btn btn-primary" id="btn-save-candidat">Inscrire</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                       <!-- Custom content with heading -->
                       <div class="col-lg-12 mb-4 mb-xl-0">
                        <small class="text-light fw-semibold">Candidats</small>
                        <div class="mt-3">
                          <!-- Bootstrap Table with Header - Light -->
                          <div class="table-responsive text-nowrap">
                            <table class="table">
                              <thead class="table-light">
                                <tr>
                                  <th>Nom Candidat</th>
                                  <th>Status</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0">
                                @forelse ( $election->candidates as $candidate)
                                <tr>
                                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$candidate->fullname}}</strong></td>
                                  
                                  <td><span class="badge bg-label-primary me-1">Active</span></td>
                                  <td>
                                    <span class="d-flex">
                                        <a class="dropdown-item open-ModifyCandidateDialog" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modifyCandidat" data-id={{$candidate->id}} data-fullname="{{$candidate->fullname}}" data-email="{{$candidate->email}}"
                                        ><i class="bx bx-edit-alt me-1"></i></a
                                        >
                                          <a class="dropdown-item" href="javascript:void(0);"
                                          ><i class="bx bx-trash me-1"></i></a
                                        >
                                        </span>
                                  </td>
                                  
                                </tr>
                                @empty
                                  <p>Pas de candidats. Ajouter</p>
                                @endforelse
                                {{-- Modal modify Candidates --}}
                      <div class="modal fade" id="modifyCandidat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Modification du candidat</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form id="candidate-modification-form">
                                @csrf
                                <input type="hidden" id="candidate_id" name="candidate_id" value="">
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nom Complet</label>
                                    <input type="text" class="form-control" name="fullnamem" id="fullnamem" value="" placeholder="Nom et Prenom Candidat" />
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-email">Email</label>
                                    <input type="mail" class="form-control" name="emailm" id="emailm" value="" placeholder="Email du Candidat" />
                                  </div>

                                <button type="button" class="btn btn-primary" id="btn-modify-candidat">Modifier</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                              </tbody>
                            </table>
                          </div>
                         
                      
                        </div>
                      </div>
                      
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

      $(document).on("click", ".open-ModifyCandidateDialog", function () {
      let myCadidateName = $(this).data('fullname');
      let myCandidateEmail = $(this).data('email');
      let myCandidateId = $(this).data('id');
      
      $("#candidate_id").val(myCandidateId);
      $("#emailm").val(myCandidateEmail);
      $("#fullnamem").val(myCadidateName);
      
      });      
      const updateCandidateInformation = () => {
        console.info('Function::updateCandidateInformation()');
        // const candidateId = $("#candidate_id").val();
        // const candidateEmail = $("#emailm").val();
        // const candidateFullname = $("#fullnamem").val();
        const updateForm = document.getElementById('candidate-modification-form');
        const formData = new FormData(updateForm);
        formData.append("election_id",jQuery('#election_id').val());
        formData.append("_token","{{ csrf_token() }}");
        formData.append("_method","PUT");
        $.ajax({
          type: "POST",
          url: "{{route('candidate.update')}}",
          processData: false,
          contentType: false,
          data : formData,
          dataType : 'json',
          beforeSend: function(){},
          success: function(data){
            if (data.message == 'success') {
              location.reload();
            } else {
              
            }
          },
          complete: function(){}
        });

      }
      const addCandidate = () => {
            console.info ('Function::addCandidate()');
            const myForm = document.getElementById('add-candidate-form');
            const formData = new FormData(myForm);
            // console.log(formData);
            // console.log(Array.from(formData.keys()).length);
            formData.append("_token","{{ csrf_token() }}");
            formData.append("election_id",jQuery('#election_id').val());
            formData.append("fullname",jQuery('#fullname').val());
            formData.append("email",jQuery('#email').val());
            
            $.ajax({
                type: "POST",
                url:ajaxUrl,
                processData: false,
                contentType: false,
                data: formData,
                dataType: 'json',
                beforeSend: function(){
                    // jQuery("#infos-box").hide();
                    // jQuery("#loading").show();
                },
                success: function (data) {
                    
                    if(data.message == 'success'){
                      // show success message and redirect
                      setTimeout(function(){
                        location.reload();
                      }, 3000); // 3000 milliseconds = 3 seconds
                    }else{
                      console.log("No");
                        // tata.error('error', 'Error in creating your business');
                        // console.error('Sorry The Company is not registred',data.infos);
                    } 
                },
                complete:function(data){
                    // jQuery("#loading").hide();
                },
            });
        }
        $('#btn-modify-candidat').click((e)=>updateCandidateInformation());
        $("#btn-save-candidat").click((e)=>addCandidate());

  </script>
@endpush
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
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Information Candidats</h5>
                      <small class="text-muted float-end">Renseignements des candidats</small>
                    </div>

                    <div class="card-body">
                      <h5 class="card-header">Inscrivez vos Candidats</h5>
                      <div class="row">
                        <!-- Custom content with heading -->
                        <div class="col-lg-12 mb-4 mb-xl-0">
                          <small class="text-light fw-semibold">Candidats</small>
                          <div class="mt-3">
                            <div class="row">
                              <div class="col-md-4 col-12 mb-3 mb-md-0">
                                <div class="list-group">
                                  <a
                                    class="list-group-item list-group-item-action active"
                                    id="list-home-list"
                                    data-bs-toggle="list"
                                    href="#list-home"
                                    >Candidat #1</a
                                  >
                                  <a
                                    class="list-group-item list-group-item-action"
                                    id="list-profile-list"
                                    data-bs-toggle="list"
                                    href="#list-profile"
                                    >Candidat #2</a
                                  >
                                  <a
                                    class="list-group-item list-group-item-action"
                                    id="list-messages-list"
                                    data-bs-toggle="list"
                                    href="#list-messages"
                                    >Candidat #3</a
                                  >
                                  <a
                                    class="list-group-item list-group-item-action"
                                    id="list-settings-list"
                                    data-bs-toggle="list"
                                    href="#list-settings"
                                    >Candidat #4</a
                                  >
                                </div>
                              </div>
                              <div class="col-md-8 col-12">
                                <div class="tab-content p-0">
                                  <div class="tab-pane fade show active" id="list-home">
                                    <form>
                                      <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nom Complet</label>
                                        <input type="text" class="form-control" id="basic-default-fullname" placeholder="Nom et Prenom du candidat" />
                                      </div>
                                      
                                      <div class="mb-3">
                                          <label class="form-label" for="basic-default-company">Email</label>
                                          <input type="mail" class="form-control" id="basic-default-company" placeholder="Email valide Candidat" />
                                        </div>
                                      
                                      <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                  </div>
                                  <div class="tab-pane fade" id="list-profile">
                                    
                                  </div>
                                  <div class="tab-pane fade" id="list-messages">
                                    
                                  </div>
                                  <div class="tab-pane fade" id="list-settings">
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <div class="col-lg-6">
                          <small class="text-light fw-semibold">Horizontal</small>
                          <div class="demo-inline-spacing mt-3">
                            <div class="list-group list-group-horizontal-md text-md-center">
                              <a
                                class="list-group-item list-group-item-action active"
                                id="home-list-item"
                                data-bs-toggle="list"
                                href="#horizontal-home"
                                >Home</a
                              >
                              <a
                                class="list-group-item list-group-item-action"
                                id="profile-list-item"
                                data-bs-toggle="list"
                                href="#horizontal-profile"
                                >Profile</a
                              >
                              <a
                                class="list-group-item list-group-item-action"
                                id="messages-list-item"
                                data-bs-toggle="list"
                                href="#horizontal-messages"
                                >Messages</a
                              >
                              <a
                                class="list-group-item list-group-item-action"
                                id="settings-list-item"
                                data-bs-toggle="list"
                                href="#horizontal-settings"
                                >Settings</a
                              >
                            </div>
                            <div class="tab-content px-0 mt-0">
                              <div class="tab-pane fade show active" id="horizontal-home">
                                Donut sugar plum sweet roll biscuit. Cake oat cake gummi bears. Tart wafer wafer halvah
                                gummi bears cheesecake. Topping croissant cake sweet roll. Dessert fruitcake gingerbread
                                halvah marshmallow pudding bear claw cheesecake. Bonbon dragée cookie gummies. Pudding
                                marzipan liquorice. Sugar plum dragée cupcake cupcake cake dessert chocolate bar. Pastry
                                lollipop lemon drops lollipop halvah croissant. Pastry sweet gingerbread lemon drops topping
                                ice cream.
                              </div>
                              <div class="tab-pane fade" id="horizontal-profile">
                                Muffin lemon drops chocolate chupa chups jelly beans dessert jelly-o. Soufflé gummies
                                gummies. Ice cream powder marshmallow cotton candy oat cake wafer. Marshmallow gingerbread
                                tootsie roll. Chocolate cake bonbon jelly beans lollipop jelly beans halvah marzipan danish
                                pie. Oat cake chocolate cake pudding bear claw liquorice gingerbread icing sugar plum
                                brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer gummi bears
                                fruitcake.
                              </div>
                              <div class="tab-pane fade" id="horizontal-messages">
                                Ice cream dessert candy sugar plum croissant cupcake tart pie apple pie. Pastry chocolate
                                chupa chups tiramisu. Tiramisu cookie oat cake. Pudding brownie bonbon. Pie carrot cake
                                chocolate macaroon. Halvah jelly jelly beans cake macaroon jelly-o. Danish pastry dessert
                                gingerbread powder halvah. Muffin bonbon fruitcake dragée sweet sesame snaps oat cake
                                marshmallow cheesecake. Cupcake donut sweet bonbon cheesecake soufflé chocolate bar.
                              </div>
                              <div class="tab-pane fade" id="horizontal-settings">
                                Marzipan cake oat cake. Marshmallow pie chocolate. Liquorice oat cake donut halvah jelly-o.
                                Jelly-o muffin macaroon cake gingerbread candy cupcake. Cake lollipop lollipop jelly brownie
                                cake topping chocolate. Pie oat cake jelly. Lemon drops halvah jelly cookie bonbon cake
                                cupcake ice cream. Donut tart bonbon sweet roll soufflé gummies biscuit. Wafer toffee
                                topping jelly beans icing pie apple pie toffee pudding. Tiramisu powder macaroon tiramisu
                                cake halvah.
                              </div>
                            </div>
                          </div>
                        </div> --}}
                        <!--/ Custom content with heading -->
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
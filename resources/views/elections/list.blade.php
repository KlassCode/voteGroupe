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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Mes Elections</h4>
                            <!-- Bootstrap Table with Header - Light -->
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                <thead class="table-light">
                                    <tr>
                                    <th>Titre</th>
                                    <th>Ouverture</th>
                                    <th>Fermetture</th>    
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ( $elections as $election)
                                    <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$election->title}}</strong></td>
                                    <td>{{$election->open_date}}</td>
                                    <td>{{$election->close_date}}</td>
                                    <td>
                                        <span class="d-flex">
                                            <a class="dropdown-item" href="{{route('election.edit',$election->code)}}"
                                            ><i class="bx bx-edit-alt me-1"></i></a
                                            >
                                            <form action="{{route('election.delete',$election->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="dropdown-item"
                                            ><i class="bx bx-trash me-1"></i></button>
                                            </form>
                                            
                                            </span>
                                    </td>
                                    
                                    </tr>
                                    @empty
                                    <p>Pas d'election. Ajouter</p>
                                    @endforelse
                                
                                </tbody>
                                </table>
                            </div>
                        
                        <!--/ Basic Bootstrap Table -->
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
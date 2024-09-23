@extends('layouts.app_dashboard')
@section('title')
    <title>
        VoteConnect | Nouveau Compte
    </title>
@endsection
@section('content')

<div class="container d-flex justify-content-center">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  VoteConnect
                </span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">L'aventure Commence 🚀</h4>
            <p class="mb-4">Vos elections plus cools et plus facile!</p>

            <form id="formRegister" class="mb-3" action="{{route('register')}}" method="POST">
            @csrf
                <div class="mb-3">
                <label for="username" class="form-label">Nom utilisateur</label>
                <input
                  type="text"
                  class="form-control @error('name') is-invalid @enderror"
                  value="{{ old('name') }}"
                  id="name"
                  name="name"
                  placeholder="Entrer un pseudo"
                  autofocus
                />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Entrer votre email" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Mot de passe</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                  />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="password">Confirmation</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password-confirm"
                    class="form-control"
                    name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                  />
              </div>
              

              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                  <label class="form-check-label" for="terms-conditions">
                    J'accepte
                    <a href="javascript:void(0);">termes et conditions</a>
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary d-grid w-100">Je m'inscris</button>
            </form>

            <p class="text-center">
              <span>Deja un compte</span>
              <a href="{{route('login')}}">
                <span>Se connecter</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>
@endsection

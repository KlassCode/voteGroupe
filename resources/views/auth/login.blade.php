@extends('layouts.app_dashboard')
@section("title")
<title>VoteConnect | Connxion</title>
@endsection
@section('content')

<div class="container d-flex justify-content-center">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    
                </span>
                <span class="app-brand-text demo text-body fw-bolder">VoteConnect</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Bienvenue sur VoteConnect! 👋</h4>
            <p class="mb-4">Connecter a votre compte et debuter l'experience</p>

            <form id="formLogin" class="mb-3" action="{{route('login')}}" method="POST">
                @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control @error('email') is-invalid @enderror" 
                  name="email" 
                  value="{{ old('email') }}"
                  id="email"
                  name="email-username"
                  placeholder="Entrer votre email"
                  autofocus
                />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Mot de passe</label>
                  @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                       <small> {{ __('Forgot Your Password?') }} </small>
                    </a>
                @endif
                 
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
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
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Se souvenir de moi </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Je me connecte</button>
              </div>
            </form>

            <p class="text-center">
              <span>Nouveau sur la platforme ?</span>
              <a href="{{route('register')}}">
                <span>Creer un compte</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

</body>

</html>

@endsection

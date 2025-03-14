@extends('layouts.auth')
@section('page_style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{url('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection
@section('content')
<div class="auth-background"></div>
<!-- / Content -->
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Login -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-4 mt-2">
                <span class="app-brand-text demo text-body fw-bold ms-1">Rektorat Intern</span>
              {{-- </a> --}}
            </div>
            <!-- /Logo -->
            <h4 class="mb-1 pt-2">Welcome to Rektorat Intern!</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>

            <form id="" class="default-form mb-3" action="{{ route('login') }}" method="POST">
            @csrf
              <div class="mb-3 form-input">
                <label for="email" class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Enter your email"
                  value="{{ old('email') }}"
                  autocomplete="email"
                  autofocus
                />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 form-password-toggle form-input">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    autocomplete="current-password"
                  />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <button class="btn btn-danger d-grid w-100" type="submit">Login</button>
              </div>
            </form>

            <p class="text-center">
              <span>New on our platform?</span>
              <a href="{{ route('register') }}">
                <span>Create an account</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
  <!-- / Content -->
@endsection
@section('page_script')
<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/extended-ui-sweetalert2.js')}}"></script>
@endsection
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
        <!-- Register Card -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-4 mt-2">
              <a href="" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body fw-bold ms-1">Rektorat Intern</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-1 pt-2">Sign-Up</h4>
            <p class="mb-4">Make your app management easy and fun!</p>

            <form  class="mb-3 default-form"  action="{{ url('/signup') }}" method="POST">
             @csrf
              <div class="mb-3 form-input">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your username" autofocus />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 form-input">
                <label for="username" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" placeholder="670***" autofocus />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 form-input">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 form-password-toggle form-input">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
                <div class="invalid-feedback"></div>
              </div>
              <button type="submit" class="btn btn-danger d-grid w-100">Sign up</button>
            </form>
            <p class="text-center">
              <span>Already have an account?</span>
              <a href="{{ route('login') }}">
                <span>Sign in</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>
  <!-- / Content -->
@endsection
  @section('page_script')
<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/extended-ui-sweetalert2.js')}}"></script>
@endsection
@extends('masterPage.layout')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-xl-4 col-lg-4">
            <div class="card w-100 border-0">
                <div class="card-body">
                <h2 class="card-title text-center mb-4">To continue, log in to nTask</h2>
                    @if(session("status"))
                    <small class="bg-danger text-white w-100 py-3 rounded text-center d-block mb-3">{{ session("status") }}</small>
                    @endif    
                    <form action="{{ route('login') }}" autocomplete="off" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid  @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}" required>
                            @error("email")
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid  @enderror" id="password" required>
                            @error("password")
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                        </div>
                        <div class="row justify-content-right">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary float-right">Login</button>
                                <a href="#" class="btn btn-primary float-right disabled d-none" disabled><img src="{{ asset('img/spinner.svg') }}" alt="Loding.."> Login</a>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            Don't have an account?&nbsp;<a href="{{route("Register")}}" class="text-decoration-none">Sign up for nTask</a>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>
@endsection
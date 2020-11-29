@extends('masterPage.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-xl-5 col-lg-5">
            <div class="card w-100 border-0 pt-4">
                <div class="card-body">
                <h3 class="card-title text-center mb-4">Create your account</h3>
                <form method="POST" action="{{route("Register")}}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="" for="username">What should we call you?</label>
                        <input type="text" placeholder="Enter a profile name" class="form-control form-control-lg @error('username') is-invalid  @enderror" id="username" name="username" value="{{ old('username') }}">
                        @error('username')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                        <div class="form-group">
                            <label class="" for="email">What's your email?</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control form-control-lg @error('email') is-invalid  @enderror" aria-describedby="emailHelp" value="{{ old('email') }}">
                            @error("email")
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="" for="password">Create a password</label>
                            <small class="form-text float-right"><button type="button" onclick="showPass()" class="btn btn-link p-0 btn-sm text-muted"><i class="ri-eye-fill"></i>&nbsp;<span id="togglePass">Show</span></button></small>
                            <input type="password" placeholder="Enter a password" class="form-control form-control-lg" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label class="" for="password2">Confirm your password</label>
                            <input type="password" placeholder="Enter your password again" class="form-control form-control-lg @error('password') is-invalid  @enderror" name="password_confirmation" id="password2">
                            @error("password")
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input class="d-none" name="timezone" type="text" id="userTimeZone">
                        <div class="row justify-content-right">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary float-right">Sign up</button>
                                <a href="#" class="btn btn-primary float-right disabled d-none" disabled><img src="{{ asset('img/spinner.svg') }}" alt="Loding.."> Login</a>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                        Have an account?&nbsp;<a href="{{ route("login") }}">Login.</a>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>
    <script>
var offset = (new Date()).getTimezoneOffset();
var timezones = {
    '-12': 'Pacific/Kwajalein',
    '-11': 'Pacific/Samoa',
    '-10': 'Pacific/Honolulu',
    '-9': 'America/Juneau',
    '-8': 'America/Los_Angeles',
    '-7': 'America/Denver',
    '-6': 'America/Mexico_City',
    '-5': 'America/New_York',
    '-4': 'America/Caracas',
    '-3.5': 'America/St_Johns',
    '-3': 'America/Argentina/Buenos_Aires',
    '-2': 'Atlantic/Azores',
    '-1': 'Atlantic/Azores',
    '0': 'Europe/London',
    '1': 'Europe/Paris',
    '2': 'Europe/Helsinki',
    '3': 'Europe/Moscow',
    '3.5': 'Asia/Tehran',
    '4': 'Asia/Baku',
    '4.5': 'Asia/Kabul',
    '5': 'Asia/Karachi',
    '5.5': 'Asia/Calcutta',
    '6': 'Asia/Colombo',
    '7': 'Asia/Bangkok',
    '8': 'Asia/Singapore',
    '9': 'Asia/Tokyo',
    '9.5': 'Australia/Darwin',
    '10': 'Pacific/Guam',
    '11': 'Asia/Magadan',
    '12': 'Asia/Kamchatka' 
};
document.querySelector("#userTimeZone").value=timezones[-offset / 60];

function showPass(){
    $(".ri-eye-fill, .ri-eye-close-fill").toggleClass("ri-eye-fill ri-eye-close-fill");
    $("#togglePass").text($("#togglePass").text() == 'Show' ? 'Hide' : 'Show');

    var e=$("#password, #password2");
        e.attr('type', e.attr('type') == 'text' ? 'password' : 'text'); 
}
    </script>
@endsection
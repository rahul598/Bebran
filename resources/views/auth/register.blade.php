@extends('layouts.app')

@section('content')
<!-- Trigger buttons for opening the modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authModal">
    Sign In / Sign Up
</button>

<!-- Modal -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authModalLabel">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 logo-col text-center">
                            <img src="{{ asset('images/web-logo.webp') }}" alt="web-logo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sign-up-section">
                                <!-- Sign In Section -->
                                <div id="signInForm">
                                    <h2>Sign In</h2>
                                    <p>Let's Get You In</p>
                                    <div class="sign-up-with-btn">
                                        <button type="button" class="btn google-btn"><img src="{{ asset('images/pngwing.com.png') }}"> Sign In With Gmail</button>
                                        <button type="button" class="btn facebook-btn"><img src="{{ asset('images/facebook-icon.png') }}"> Sign In With Facebook</button>
                                        <button type="button" class="btn apple-btn"><img src="{{ asset('images/apple-logo.png') }}"> Sign In With Apple</button>
                                    </div>
                                    <div class="centered-content">
                                        <hr class="left-line">
                                        <p class="main-line">OR</p>
                                        <hr class="right-line">
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" class="customValidate">
                                        @csrf
                                        <div class="set-sign-in">
                                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                        </div>
                                        <div class="set-sign-in">
                                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                        </div>
                                        <div class="signup-btn">
                                            <button type="submit" class="btn btn-primary">Sign In</button>
                                        </div>
                                        <p class="pt-3 have-account">Don't Have An Account? 
                                           <a href="#" onclick="toggleToSignup()">Sign-Up</a></p>
                                    </form>
                                </div>

                                <!-- Sign Up Section -->
                                <div id="signUpForm" style="display: none;">
                                    <h2>Sign Up</h2>
                                    <p>Let's Create You An Account</p>
                                    <div class="sign-up-with-btn">
                                        <button type="button" class="btn google-btn"><img src="{{ asset('images/pngwing.com.png') }}"> Sign In With Gmail</button>
                                        <button type="button" class="btn facebook-btn"><img src="{{ asset('images/facebook-icon.png') }}"> Sign In With Facebook</button>
                                        <button type="button" class="btn apple-btn"><img src="{{ asset('images/apple-logo.png') }}"> Sign In With Apple</button>
                                    </div>
                                    <div class="centered-content">
                                        <hr class="left-line">
                                        <p class="main-line">OR</p>
                                        <hr class="right-line">
                                    </div>
                                    <form method="POST" action="{{ route('register') }}" class="customValidate">
                                        @csrf
                                        <div class="first-section-signup mt-4">
                                            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Full Name">
                                        </div>
                                        <div class="first-section-signup">
                                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                        </div>
                                        <div class="first-section-signup">
                                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                        </div>
                                        <div class="checkbox-sec">
                                            <label class="clb">Agree to the @if($privacy)<a href="{{ url($privacy->slug) }}" target="_blank">{!! $privacy->page_name !!}</a>@endif {{$privacy && $term ? '&' : ''}} @if($term)<a href="{{ url($term->slug) }}" target="_blank">{!! $term->page_name !!}</a>@endif
                                                <input type="checkbox" name="aggrement" value="1" required>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="signup-btn">
                                            <button type="submit" class="btn btn-primary">Sign Up</button>
                                        </div>
                                        <p class="pt-3 have-account">Already Have An Account? 
                                           <a href="#" onclick="toggleToSignin()">Sign-In</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('more-scripts')
<!-- JavaScript to toggle between Sign In and Sign Up -->
<script>
    function toggleToSignup() {
        document.getElementById('signInForm').style.display = 'none';
        document.getElementById('signUpForm').style.display = 'block';
        document.querySelector('.modal-title').innerText = 'Sign Up';
    }

    function toggleToSignin() {
        document.getElementById('signInForm').style.display = 'block';
        document.getElementById('signUpForm').style.display = 'none';
        document.querySelector('.modal-title').innerText = 'Sign In';
    }
</script>
@stop

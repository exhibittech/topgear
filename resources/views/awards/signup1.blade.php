<!-- resources/views/awards/signup.blade.php -->
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'TopGear Awards')

@section('content')

<div class="tg-banner-wrap">
<img src="https://www.topgearmag.in/uploads/awards25/awards25.jpg" width="100%">
</div>
<div class="container">
        <div class="row">
            <div class="offset-lg-3 offset-md-1 col-lg-6 col-md-10 form">                
                <div class="sign-up">
                    <h3>Registration Form</h3>
			<form class="kjsignupform" method="get" autocomplete="off" action="/voting">
                        <input type="text" placeholder="Name" name="username" id="uname" required>
                        <input type="email" placeholder="Email Id" name="email" id="uemail" required>
                        <input type="password" placeholder="Password" name="password" id="upassword" required>
						<span class="invalid"></span><br/>
                        <input type="checkbox" id="policy" value="policy" required>
                        <label for="policy">I agree to the <b>Terms and  Poilcy</b></label><br/>
                        <div class="kjformoption">
                            <button type="submit" class="tg-btn">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

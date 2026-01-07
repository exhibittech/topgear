@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'TopGear Awards')

@section('content')

<div class="tg-banner-wrap">
<img src="https://www.topgearmag.in/uploads/awards25/awards25.webp" width="100%">
</div>
<div class="container">
    <div class="row">
        <div class="offset-lg-3 offset-md-1 col-lg-6 col-md-10 form">                
            <div class="sign-up">
                <h3>Register / Login</h3>
                <form class="kjsignupform" method="POST" autocomplete="off" action="{{ route('signup.store') }}" id="signup-form">
                    @csrf
                    <!-- Name input: allows only alphabets -->
                    <input type="text" placeholder="Name" name="name" id="uname" required pattern="[A-Za-z\s]+" title="Name should contain only letters and spaces.">
                    
                    <!-- Email input -->
                    <input type="email" placeholder="Email Id" name="email" id="uemail" required title=""Please enter a valid email address.">
                    <span class="invalid"></span><br/>

                    <input type="checkbox" id="policy" value="policy" required>
                    <label for="policy">I agree to the <b>Terms and Policy</b></label><br/>
                    
                    <div class="kjformoption">
                        <button type="submit" class="tg-btn">Submit</button>
                    </div>
                </form>
                
                <!-- Success and error messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('signup-form').addEventListener('submit', function(event) {
        const nameInput = document.getElementById('uname').value.trim();
        const emailInput = document.getElementById('uemail').value.trim();

        const namePattern = /^[A-Za-z\s]+$/;  // Regex: only alphabets and spaces
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  // Basic email format

        let isValid = true;
        let errorMessage = "";

        if (!namePattern.test(nameInput)) {
            isValid = false;
            errorMessage = "Please enter a valid name (only letters and spaces allowed).";
        } else if (!emailPattern.test(emailInput)) {
            isValid = false;
            errorMessage = "Please enter a valid email address.";
        }

        if (!isValid) {
            event.preventDefault();  // Prevent form submission
            alert(errorMessage);  // Show validation message
        }
    });
</script>

@endsection

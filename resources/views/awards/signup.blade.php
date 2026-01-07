@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'TopGear Awards')

@section('content')

<div class="tg-banner-wrap">
<img src="https://www.topgearmag.in/uploads/awards26/awards26.jpg" width="100%">
</div>
<div class="container">
    <div class="row">
        <div class="offset-lg-3 offset-md-1 col-lg-6 col-md-10 form">                
            <div class="sign-up">
                <h3>Register / Login</h3>
                <form class="kjsignupform" method="POST" autocomplete="off" action="{{ route('signup.store') }}" id="signup-form">
                    @csrf
                    <!-- Hidden device fingerprint field -->
                    <input type="hidden" name="device_fingerprint" id="device_fingerprint" value="">
                    
                    <!-- Name input: allows only alphabets -->
                    <input type="text" placeholder="Name" name="name" id="uname" required pattern="[A-Za-z\s]+" title="Name should contain only letters and spaces.">
                    
                    <!-- Email input -->
                    <input type="email" placeholder="Email Id" name="email" id="uemail" required title=""Please enter a valid email address.">
                    <span class="invalid"></span><br/>

                    <input type="checkbox" id="policy" value="policy" required>
                    <label for="policy">I agree to the <b>Terms and Policy</b></label><br/>
                    
                    <div class="kjformoption">
                        <button type="submit" class="tg-btn" id="submit-btn">Submit</button>
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

<!-- FingerprintJS CDN for device fingerprinting -->
<script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>

<script>
    // Initialize FingerprintJS and get the device fingerprint
    const fpPromise = FingerprintJS.load();
    
    async function getFingerprint() {
        try {
            const fp = await fpPromise;
            const result = await fp.get();
            // Set the fingerprint in the hidden field
            document.getElementById('device_fingerprint').value = result.visitorId;
            return result.visitorId;
        } catch (error) {
            console.error('Error getting fingerprint:', error);
            // Fall back to a combination of available browser info
            const fallbackFp = generateFallbackFingerprint();
            document.getElementById('device_fingerprint').value = fallbackFp;
            return fallbackFp;
        }
    }
    
    // Fallback fingerprint generator using browser properties
    function generateFallbackFingerprint() {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        ctx.textBaseline = 'top';
        ctx.font = '14px Arial';
        ctx.fillText('fingerprint', 2, 2);
        
        const components = [
            navigator.userAgent,
            navigator.language,
            screen.colorDepth,
            new Date().getTimezoneOffset(),
            navigator.hardwareConcurrency || 'unknown',
            screen.width + 'x' + screen.height,
            canvas.toDataURL()
        ];
        
        // Simple hash function
        const str = components.join('|');
        let hash = 0;
        for (let i = 0; i < str.length; i++) {
            const char = str.charCodeAt(i);
            hash = ((hash << 5) - hash) + char;
            hash = hash & hash;
        }
        return 'fb_' + Math.abs(hash).toString(36);
    }
    
    // Get fingerprint when page loads
    document.addEventListener('DOMContentLoaded', function() {
        getFingerprint();
    });

    document.getElementById('signup-form').addEventListener('submit', async function(event) {
        event.preventDefault(); // Always prevent initial submission
        
        const nameInput = document.getElementById('uname').value.trim();
        const emailInput = document.getElementById('uemail').value.trim();
        const fingerprintInput = document.getElementById('device_fingerprint').value;

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
            alert(errorMessage);
            return;
        }
        
        // Ensure fingerprint is available before submitting
        if (!fingerprintInput) {
            await getFingerprint();
        }
        
        // Now submit the form
        this.submit();
    });
</script>

@endsection


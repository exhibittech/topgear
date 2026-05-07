<!-- resources/views/redlineclub.blade.php -->
@extends('layouts.apphome')

<link rel="stylesheet" href="{{ asset('assets/css/awards.css') }}">

@section('title', 'Redline Club')

@section('content')

    <div class="tg-banner-wrap">
        <img src="https://topgearmag.in/uploads/Banners/redlineclub.jpg" width="100%">
    </div>

    <div class="container">
        <div class="offset-lg-1 offset-md-1 col-lg-10 col-md-10 form">

            <div class="tgsection-title">
                <h2>Redline Club</h2>
            </div>

            <div class="sign-up form-container">

                <p>
                    Welcome to TopGear India’s new and exclusive enthusiasts’ community -
                    Top Gear India Red Line Club.
                </p>

                <p>
                    Our inaugural event, set for May 16, 2026, is strictly invite-only and
                    reserved for a select group of India’s most passionate drivers and their
                    high-performance machines.
                </p>

                <p>
                    To be part of it, enter your details below and join the waiting list.
                </p>

                <form method="POST" autocomplete="off" id="redline-form">

                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-4">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <!-- Mobile -->
                        <div class="col-md-4">
                            <label class="form-label">Mobile</label>
                            <input type="tel" name="mobile" class="form-control" required pattern="[0-9]{10}" maxlength="10"
                                title="Please enter a valid 10-digit mobile number">
                        </div>

                        <!-- Email -->
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <!-- Car Brand -->
                        <div class="col-md-4">
                            <label class="form-label">Car Brand</label>
                            <input type="text" name="car_brand" class="form-control" required>
                        </div>

                        <!-- Car Model -->
                        <div class="col-md-4">
                            <label class="form-label">Car Model</label>
                            <input type="text" name="car_model" class="form-control" required>
                        </div>

                        <!-- Car Number -->
                        <div class="col-md-4">
                            <label class="form-label">Car Number</label>
                            <input type="text" name="car_number" class="form-control" required minlength="9" maxlength="10"
                                title="Car number must be 9 or 10 characters">
                        </div>

                        <!-- Instagram -->
                        <div class="col-md-4">
                            <label class="form-label">
                                Instagram Link <small>(Optional)</small>
                            </label>

                            <input type="url" name="instagram_link" class="form-control">
                        </div>

                        <!-- LinkedIn -->
                        <div class="col-md-4">
                            <label class="form-label">
                                LinkedIn <small>(Optional)</small>
                            </label>

                            <input type="url" name="linkedin_link" class="form-control">
                        </div>

                        <!-- T-Shirt -->
                        <div class="col-md-4">
                            <label class="form-label">T Shirt Size</label>

                            <select class="mt-3 p-1 form-select" name="tshirt_size" required>

                                <option value="">Select Size</option>
                                <option>XS</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                                <option>XXL</option>
                                <option>XXXL</option>
                            </select>
                        </div>

                        <!-- Submit -->
                        <div class="col-12 mt-4">
                            <div class="d-grid">
                                <button type="button" id="submitbtn" class="btn tg-btn">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </div>
                </form>

                <!-- Success Message -->
                <div id="successMessage" style="display:none; margin-top:30px; text-align:center;">

                    <h3>Thank You!</h3>

                    <p>
                        Your details have been submitted successfully.
                        Our team will get in touch with you soon.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const submitbtn = document.getElementById("submitbtn");

            // Convert form data to JSON object
            function getFormData() {

                const form = document.getElementById("redline-form");
                const formData = new FormData(form);

                const data = {};

                formData.forEach((value, key) => {
                    data[key] = value;
                });

                return data;
            }

            // Submit Button Click
            if (submitbtn) {

                submitbtn.addEventListener("click", function () {

                    const form = document.getElementById("redline-form");

                    // HTML5 Validation
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    submitbtn.disabled = true;
                    submitbtn.textContent = "Submitting...";

                    const formData = getFormData();

                    // Send data to n8n webhook
                    fetch("https://n8n.exhibit.social/webhook/acea76e1-6d95-4a2c-80fe-c0d9e3bb5373", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(formData)
                    })
                        .then(response => {

                            if (!response.ok) {
                                throw new Error("Webhook request failed");
                            }

                            // Hide form
                            document.getElementById("redline-form").style.display = "none";

                            // Show success message
                            document.getElementById("successMessage").style.display = "block";
                        })
                        .catch(error => {

                            console.error("n8n webhook error:", error);

                            alert("Something went wrong. Please try again.");

                            submitbtn.disabled = false;
                            submitbtn.textContent = "Submit";
                        });
                });
            }
        });
    </script>

@endsection
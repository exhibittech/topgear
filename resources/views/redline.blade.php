<!-- resources/views/redline.blade.php -->
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'Redline Club')
<style>
    #paymentSection {
        display: none;
    }
</style>

@section('content')

    <div class="container">
        <div class="offset-lg-2 offset-md-1 col-lg-8 col-md-10 form">
            <div class="tgsection-title">
                <h2>Redline Club</h2>
            </div>
            <!-- STEP 1 : FORM -->
            <div id="formSection" class="sign-up form-container">
                <form class="" method="POST" autocomplete="off" action="#" id="redline-form">

                    <div class="row g-3">

                        <!-- Row 1 -->
                        <div class="col-md-4">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required="">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Mobile</label>
                            <input type="text" name="mobile" class="form-control" required="">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required="">
                        </div>

                        <!-- Row 2 -->
                        <div class="col-md-4">
                            <label class="form-label">Car Brand</label>
                            <input type="text" name="car_brand" class="form-control" required="">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Car Model</label>
                            <input type="text" name="car_model" class="form-control" required="">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Car Number</label>
                            <input type="text" name="car_number" class="form-control" required="">
                        </div>

                        <!-- Row 3 -->
                        <div class="col-md-4">
                            <label class="form-label">Instagram Link <small>(Optional)</small></label>
                            <input type="url" name="instagram_link" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">LinkedIn <small>(Optional)</small></label>
                            <input type="url" name="linkedin_link" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">T Shirt Size</label>
                            <select class="mt-3 p-1 form-select" name="tshirt_size" required="">
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
                                <button type="button" id="proceedBtn" class="btn tg-btn">Proceed</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!-- STEP 2 : PAYMENT -->
            <div id="paymentSection">
                <h2 class="text-center mb-4">Complete Payment</h2>

                <div class="row g-3">

                    <div class="col-md-12">
                        <label class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control amount-box" value="₹30,000" readonly>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="d-grid">
                            <button type="button" class="btn tg-btn">Pay</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const proceedBtn = document.getElementById("proceedBtn");

            if (proceedBtn) {
                proceedBtn.addEventListener("click", function () {

                    const form = document.getElementById("redline-form");

                    if (form.checkValidity()) {
                        document.getElementById("formSection").style.display = "none";
                        document.getElementById("paymentSection").style.display = "block";
                    } else {
                        form.reportValidity();
                    }

                });
            }

        });
    </script>

@endsection
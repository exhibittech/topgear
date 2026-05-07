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

    <div class="tg-banner-wrap">
        <img src="https://topgearmag.in/uploads/Banners/redlineclub.jpg" width="100%">
    </div>
    <div class="container">
        <div class="offset-lg-1 offset-md-1 col-lg-10 col-md-10 form">
            <div class="tgsection-title">
                <h2>Redline Club</h2>
            </div>
            <!-- STEP 1 : FORM -->
            <div id="formSection" class="sign-up form-container">
                <p>Welcome to TopGear India’s new and exclusive enthusiasts’ community - Top Gear India Red Line Club.</p>

                <p>Our inaugural event, set for May 16, 2026, is strictly invite-only and reserved for a select group of
                    India’s most passionate drivers and their high-performance machines. This is your chance to take your
                    car to the Aamby Valley Airstrip and run it flat out, completely unrestricted. No crowds. No
                    interruptions. Just you, your car, and a perfectly laid-out quarter mile, as many times as you dare.</p>

                <p>Think of it as an unlimited drag day with your inner circle, set against one of the country’s most
                    iconic driving venues, backed by TopGear hospitality and surrounded by people who understand exactly why
                    you care about that extra tenth of a second.</p>

                <p>To be part of it, enter your details below and join the waiting list. Entries are
                    strictly limited to 50 cars, each with a plus-one invite. And yes, entry is car-dependent, because here,
                    the machine always comes first.</p>

                <p>We’ll see you at the Red Line.</p>
                <form class="" method="POST" autocomplete="off" action="#" id="redline-form">

                    <div class="row g-3">

                        <!-- Row 1 -->
                        <div class="col-md-4">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required="">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Mobile</label>
                            <input type="tel" name="mobile" class="form-control" required="" pattern="[0-9]{10}"
                                maxlength="10" title="Please enter a valid 10-digit mobile number">
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
                            <input type="text" name="car_number" class="form-control" required="" minlength="9"
                                maxlength="10" title="Car number must be 9 or 10 characters">
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
                                <button type="button" id="submitbtn" class="btn tg-btn">Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const submitbtn = document.getElementById("submitbtn");
            let memberId = null; // stored after saving details

            // Collect form data as an object
            function getFormData() {
                const form = document.getElementById("redline-form");
                const formData = new FormData(form);
                const data = {};
                formData.forEach((value, key) => { data[key] = value; });
                return data;
            }

            // STEP 1: Save details to DB, then show payment section
            if (submitbtn) {
                submitbtn.addEventListener("click", function () {
                    const form = document.getElementById("redline-form");

                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    submitbtn.disabled = true;
                    submitbtn.textContent = "Saving...";

                    const formData = getFormData();

                    // Send form data to n8n webhook (fire-and-forget, doesn't block main flow)
                    fetch("https://n8n.exhibit.social/webhook/acea76e1-6d95-4a2c-80fe-c0d9e3bb5373", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(formData)
                    }).catch(err => console.error('n8n webhook error (non-blocking):', err));

                    fetch("{{ route('redline.saveDetails') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify(formData)
                    })
                        .then(res => {
                            if (!res.ok) {
                                return res.text().then(text => {
                                    console.error('Save details error:', text);
                                    throw new Error('Server returned ' + res.status);
                                });
                            }
                            return res.json();
                        })
                        .then(data => {
                            if (data.success) {
                                memberId = data.member_id;
                                console.log('Member saved, ID:', memberId);
                                document.getElementById("formSection").style.display = "none";
                                document.getElementById("paymentSection").style.display = "block";
                            } else {
                                alert("Could not save your details. Please try again.");
                                submitbtn.disabled = false;
                                submitbtn.textContent = "Proceed";
                            }
                        })
                        .catch(err => {
                            console.error('Save details failed:', err);
                            alert("Something went wrong. Please try again.");
                            submitbtn.disabled = false;
                            submitbtn.textContent = "Proceed";
                        });
                });
            }

        });
    </script>

@endsection
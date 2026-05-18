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
                <p>Congratulations! You’ve just been invited to something rather special. Welcome to TopGear India’s new and
                    exclusive enthusiasts’ community - Top Gear India Red Line Club.</p>

                <p>Our inaugural event, set for June 07, 2026, is strictly invite-only and reserved for a select group of
                    India’s most passionate drivers and their high-performance machines. This is your chance to take your
                    car to the Aamby Valley Airstrip and run it flat out, completely unrestricted. No crowds. No
                    interruptions. Just you, your car, and a perfectly laid-out quarter mile, as many times as you dare.</p>
                <p>Think of it as an unlimited drag day with your inner circle, set against one of the country’s most
                    iconic driving venues, backed by TopGear hospitality and surrounded by people who understand exactly why
                    you care about that extra tenth of a second.</p>

                <p>To be part of it, enter your details below and secure your place on the early bird list. Entries are
                    strictly limited to 50 cars, each with a plus-one invite. And yes, entry is car-dependent, because here,
                    the machine always comes first.</p>
                <p><b>Event Cost:</b> ₹30,000 per car - inclusive driver + 1 passenger (inclusive of breakfast, lunch
                    and refreshments). Hospitality will include a large air conditioned waiting area for invited guests.
                </p>
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
                                <button type="button" id="proceedBtn" class="btn tg-btn">Proceed To Payment Link</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!-- STEP 2 : PAYMENT -->
            <div id="paymentSection">
                <p>An entry fee of INR 30,000 (inclusive of F&B and taxes) confirms your spot for 1 Car & 2 Pax.</p>

                <!-- <h2 class="text-center mb-4">Complete Payment</h2> -->

                <div class="row g-3">

                    <div class="col-12 mt-4">
                        <div class="d-grid">
                            <button type="button" id="razorpayBtn" class="btn tg-btn">Pay Now</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Razorpay Checkout Script --}}
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const proceedBtn = document.getElementById("proceedBtn");
            const razorpayBtn = document.getElementById("razorpayBtn");
            let memberId = null; // stored after saving details

            // Collect form data as an object
            function getFormData() {
                const form = document.getElementById("redline-form");
                const formData = new FormData(form);
                const data = {};
                formData.forEach((value, key) => { data[key] = value; });
                return data;
            }

            // Poll server to check if payment was captured (fallback mechanism)
            function pollPaymentStatus(maxAttempts = 10) {
                razorpayBtn.disabled = true;
                razorpayBtn.textContent = "Verifying payment...";

                let attempts = 0;

                const interval = setInterval(() => {
                    attempts++;
                    console.log('Polling payment status, attempt', attempts);

                    fetch("{{ route('redline.checkPaymentStatus') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({ member_id: memberId })
                    })
                        .then(res => res.json())
                        .then(data => {
                            console.log('Poll result:', data);
                            if (data.paid) {
                                clearInterval(interval);
                                alert(data.message || "Payment verified successfully! Welcome to the Redline Club.\nYour payment confirmation receipt is sent on your registered email id.");
                                window.location.href = "{{ route('redline.index') }}";
                            } else if (attempts >= maxAttempts) {
                                clearInterval(interval);
                                razorpayBtn.disabled = false;
                                razorpayBtn.textContent = "Pay Now";
                                alert("We couldn't confirm your payment yet. If you already paid, please wait a few minutes and refresh the page, or contact us.");
                            }
                        })
                        .catch(err => {
                            console.error('Poll error:', err);
                            if (attempts >= maxAttempts) {
                                clearInterval(interval);
                                razorpayBtn.disabled = false;
                                razorpayBtn.textContent = "Pay Now";
                            }
                        });
                }, 3000); // Check every 3 seconds
            }

            // STEP 1: Save details to DB, then show payment section
            if (proceedBtn) {
                proceedBtn.addEventListener("click", function () {
                    const form = document.getElementById("redline-form");

                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    proceedBtn.disabled = true;
                    proceedBtn.textContent = "Saving...";

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
                                proceedBtn.disabled = false;
                                proceedBtn.textContent = "Proceed";
                            }
                        })
                        .catch(err => {
                            console.error('Save details failed:', err);
                            alert("Something went wrong. Please try again.");
                            proceedBtn.disabled = false;
                            proceedBtn.textContent = "Proceed";
                        });
                });
            }

            // STEP 2: Razorpay Checkout
            if (razorpayBtn) {
                razorpayBtn.addEventListener("click", function () {

                    razorpayBtn.disabled = true;
                    razorpayBtn.textContent = "Processing...";

                    // 1. Create order on the server (with member_id)
                    fetch("{{ route('redline.createOrder') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({ member_id: memberId })
                    })
                        .then(res => {
                            if (!res.ok) {
                                return res.text().then(text => {
                                    console.error('Create order error:', text);
                                    throw new Error('Server returned ' + res.status);
                                });
                            }
                            return res.json();
                        })
                        .then(order => {

                            const formData = getFormData();

                            // Clean up mobile number for Razorpay
                            let mobile = (formData.mobile || "").replace(/\D/g, "");

                            // 2. Open Razorpay Checkout
                            const options = {
                                key: "{{ $razorpayKey }}",
                                amount: order.amount,
                                currency: order.currency,
                                name: "TopGear India",
                                description: "Redline Club Membership",
                                order_id: order.order_id,
                                prefill: {
                                    name: formData.name || "",
                                    email: formData.email || "",
                                    contact: mobile
                                },
                                theme: {
                                    color: "#e21b22"
                                },
                                handler: function (response) {
                                    // 3. Payment successful — verify on server
                                    console.log('Razorpay payment response:', response);

                                    const payload = {
                                        member_id: memberId,
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_signature: response.razorpay_signature
                                    };

                                    console.log('Sending verification payload:', payload);

                                    razorpayBtn.disabled = true;
                                    razorpayBtn.textContent = "Verifying payment...";

                                    fetch("{{ route('redline.verifyPayment') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                            "Accept": "application/json"
                                        },
                                        body: JSON.stringify(payload)
                                    })
                                        .then(res => {
                                            console.log('Verify response status:', res.status);
                                            if (!res.ok) {
                                                return res.text().then(text => {
                                                    console.error('Server error response:', text);
                                                    throw new Error('Server returned ' + res.status);
                                                });
                                            }
                                            return res.json();
                                        })
                                        .then(data => {
                                            console.log('Verification result:', data);
                                            if (data.success) {
                                                alert(data.message);
                                                window.location.href = "{{ route('redline.index') }}";
                                            } else {
                                                // Verification failed, try polling as fallback
                                                console.log('Verify failed, falling back to polling...');
                                                pollPaymentStatus();
                                            }
                                        })
                                        .catch(err => {
                                            console.error('Verification error:', err);
                                            // Verify call failed, try polling as fallback
                                            console.log('Verify errored, falling back to polling...');
                                            pollPaymentStatus();
                                        });
                                },
                                modal: {
                                    ondismiss: function () {
                                        console.log('Razorpay modal dismissed, checking if payment was made...');
                                        // User closed the modal — maybe they completed UPI payment
                                        // Poll to check if payment was actually captured
                                        pollPaymentStatus(5); // fewer attempts for dismiss case
                                    }
                                }
                            };

                            const rzp = new Razorpay(options);
                            rzp.open();
                        })
                        .catch(err => {
                            console.error(err);
                            alert("Could not initiate payment. Please try again.");
                            razorpayBtn.disabled = false;
                            razorpayBtn.textContent = "Pay Now";
                        });
                });
            }

        });
    </script>

@endsection
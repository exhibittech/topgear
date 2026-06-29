{{-- resources/views/breakfast-drive.blade.php --}}
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'Breakfast Drive | TopGear India')

@section('styles')
<style>
    #paymentSection {
        display: none;
    }

    .bd-hero-badge {
        display: inline-block;
        background: #e21b22;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 4px 14px;
        border-radius: 2px;
        margin-bottom: 12px;
    }

    .bd-event-card {
        background: #111;
        border-left: 4px solid #e21b22;
        border-radius: 6px;
        padding: 20px 24px;
        margin: 28px 0;
    }

    .bd-event-card .bd-label {
        font-size: 10px;
        font-weight: 700;
        color: #e21b22;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .bd-event-card .bd-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 8px;
        font-size: 15px;
        color: #fff;
    }

    .bd-event-card .bd-row:last-child { margin-bottom: 0; }

    .bd-event-card .bd-row span { color: #fff; }

    .bd-price-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fdf3f3;
        border: 1px solid #f5c6c6;
        border-radius: 4px;
        padding: 10px 20px;
        margin: 18px 0 28px;
        font-size: 18px;
        font-weight: 700;
        color: #e21b22;
    }
</style>
@endsection

@section('content')

    <div class="tg-banner-wrap">
        <img src="https://topgearmag.in/uploads/Banners/redlinebreakfastdrivebanner.jpeg" width="100%" alt="TopGear India Breakfast Drive">
    </div>

    <div class="container">
        <div class="offset-lg-1 offset-md-1 col-lg-10 col-md-10 form">
            <div class="tgsection-title">
                <h1>Breakfast Drive</h1>
            </div>

            {{-- STEP 1: FORM --}}
            <div id="formSection" class="sign-up form-container">

                <span class="bd-badge" style="display:inline-block;background:#e21b22;color:#fff;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 14px;border-radius:2px;margin-bottom:16px;">TopGear India</span>

                <p>You've been invited to join TopGear India for an exclusive morning out — the <strong>Breakfast Drive</strong>. Start your Sunday with fellow enthusiasts on an early morning drive through the city, followed by a sit-down breakfast.</p>

                <p>This is a private, invite-only affair for a select group of drivers. No crowds, no compromises — just good roads, great company, and an outstanding breakfast.</p>

                {{-- Event Info Card --}}
                <div class="bd-event-card">
                    <div class="bd-label">Event Details</div>
                    <div class="bd-row">📅 &nbsp;<span>Sunday, 5th July 2026</span></div>
                    <div class="bd-row">📍 &nbsp;<span>JW Marriott Sahar, Mumbai</span></div>
                    <div class="bd-row">🚗 &nbsp;<span>Drive begins at <strong>7:00 AM</strong></span></div>
                    <div class="bd-row">🍳 &nbsp;<span>Breakfast at <strong>9:00 AM</strong></span></div>
                </div>

                <div class="bd-price-tag">
                    ₹1,500 <span style="font-size:14px;font-weight:400;color:#888;">per car · inclusive of breakfast</span>
                </div>

                <form method="POST" autocomplete="off" action="#" id="breakfast-drive-form">

                    <div class="row g-3">

                        {{-- Row 1 --}}
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

                        {{-- Row 2 --}}
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

                        {{-- Row 3 --}}
                        <div class="col-md-6">
                            <label class="form-label">Instagram Link <small>(Optional)</small></label>
                            <input type="url" name="instagram_link" class="form-control" placeholder="https://instagram.com/yourhandle">
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 mt-4">
                            <div class="d-grid">
                                <button type="button" id="bdProceedBtn" class="btn tg-btn">Proceed To Payment</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            {{-- STEP 2: PAYMENT --}}
            <div id="paymentSection">
                <div class="bd-event-card" style="margin-bottom:24px;">
                    <div class="bd-label">Confirm Your Spot</div>
                    <div class="bd-row">📅 &nbsp;<span>Sunday, 5th July 2026 · JW Marriott Sahar, Mumbai</span></div>
                    <div class="bd-row">🚗 &nbsp;<span>Drive: 7:00 AM &nbsp;|&nbsp; 🍳 Breakfast: 9:00 AM</span></div>
                </div>

                <p>An entry fee of <strong>INR 1,500</strong> (inclusive of breakfast) secures your spot for 1 car.</p>

                <div class="row g-3">
                    <div class="col-12 mt-2">
                        <div class="d-grid">
                            <button type="button" id="bdRazorpayBtn" class="btn tg-btn">Pay ₹1,500 Now</button>
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

            const proceedBtn  = document.getElementById("bdProceedBtn");
            const razorpayBtn = document.getElementById("bdRazorpayBtn");
            let memberId      = null;

            function getFormData() {
                const form     = document.getElementById("breakfast-drive-form");
                const formData = new FormData(form);
                const data     = {};
                formData.forEach((value, key) => { data[key] = value; });
                return data;
            }

            function pollPaymentStatus(maxAttempts = 10) {
                razorpayBtn.disabled    = true;
                razorpayBtn.textContent = "Verifying payment...";

                let attempts = 0;

                const interval = setInterval(() => {
                    attempts++;
                    console.log('Polling payment status, attempt', attempts);

                    fetch("{{ route('breakfast-drive.checkPaymentStatus') }}", {
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
                            alert(data.message || "Payment verified! Your spot for the Breakfast Drive is confirmed.\nA confirmation has been sent to your registered email.");
                            window.location.href = "{{ route('breakfast-drive.index') }}";
                        } else if (attempts >= maxAttempts) {
                            clearInterval(interval);
                            razorpayBtn.disabled    = false;
                            razorpayBtn.textContent = "Pay ₹1,500 Now";
                            alert("We couldn't confirm your payment yet. If you already paid, please wait a few minutes and refresh the page, or contact us at info@topgearmag.in.");
                        }
                    })
                    .catch(err => {
                        console.error('Poll error:', err);
                        if (attempts >= maxAttempts) {
                            clearInterval(interval);
                            razorpayBtn.disabled    = false;
                            razorpayBtn.textContent = "Pay ₹1,500 Now";
                        }
                    });
                }, 3000);
            }

            // STEP 1: Save details → show payment section
            if (proceedBtn) {
                proceedBtn.addEventListener("click", function () {
                    const form = document.getElementById("breakfast-drive-form");

                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    proceedBtn.disabled    = true;
                    proceedBtn.textContent = "Saving...";

                    const formData = getFormData();

                    // Fire-and-forget to n8n webhook
                    fetch("https://n8n.exhibit.social/webhook/acea76e1-6d95-4a2c-80fe-c0d9e3bb5373", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ ...formData, event: "Breakfast Drive" })
                    }).catch(err => console.error('n8n webhook error (non-blocking):', err));

                    fetch("{{ route('breakfast-drive.saveDetails') }}", {
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
                            document.getElementById("formSection").style.display    = "none";
                            document.getElementById("paymentSection").style.display = "block";
                        } else {
                            alert("Could not save your details. Please try again.");
                            proceedBtn.disabled    = false;
                            proceedBtn.textContent = "Proceed To Payment";
                        }
                    })
                    .catch(err => {
                        console.error('Save details failed:', err);
                        alert("Something went wrong. Please try again.");
                        proceedBtn.disabled    = false;
                        proceedBtn.textContent = "Proceed To Payment";
                    });
                });
            }

            // STEP 2: Razorpay Checkout
            if (razorpayBtn) {
                razorpayBtn.addEventListener("click", function () {

                    razorpayBtn.disabled    = true;
                    razorpayBtn.textContent = "Processing...";

                    fetch("{{ route('breakfast-drive.createOrder') }}", {
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
                        let mobile = (formData.mobile || "").replace(/\D/g, "");

                        const options = {
                            key: "{{ $razorpayKey }}",
                            amount: order.amount,
                            currency: order.currency,
                            name: "TopGear India",
                            description: "Breakfast Drive – 5th July 2026",
                            order_id: order.order_id,
                            prefill: {
                                name:    formData.name  || "",
                                email:   formData.email || "",
                                contact: mobile
                            },
                            theme: {
                                color: "#e21b22"
                            },
                            handler: function (response) {
                                console.log('Razorpay payment response:', response);

                                const payload = {
                                    member_id:            memberId,
                                    razorpay_payment_id:  response.razorpay_payment_id,
                                    razorpay_order_id:    response.razorpay_order_id,
                                    razorpay_signature:   response.razorpay_signature
                                };

                                razorpayBtn.disabled    = true;
                                razorpayBtn.textContent = "Verifying payment...";

                                fetch("{{ route('breakfast-drive.verifyPayment') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Accept": "application/json"
                                    },
                                    body: JSON.stringify(payload)
                                })
                                .then(res => {
                                    if (!res.ok) {
                                        return res.text().then(text => {
                                            console.error('Server error response:', text);
                                            throw new Error('Server returned ' + res.status);
                                        });
                                    }
                                    return res.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        alert(data.message + "\nA confirmation has been sent to your registered email.");
                                        window.location.href = "{{ route('breakfast-drive.index') }}";
                                    } else {
                                        console.log('Verify failed, falling back to polling...');
                                        pollPaymentStatus();
                                    }
                                })
                                .catch(err => {
                                    console.error('Verification error:', err);
                                    pollPaymentStatus();
                                });
                            },
                            modal: {
                                ondismiss: function () {
                                    console.log('Razorpay modal dismissed, checking if payment was made...');
                                    pollPaymentStatus(5);
                                }
                            }
                        };

                        const rzp = new Razorpay(options);
                        rzp.open();
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Could not initiate payment. Please try again.");
                        razorpayBtn.disabled    = false;
                        razorpayBtn.textContent = "Pay ₹1,500 Now";
                    });
                });
            }

        });
    </script>

@endsection

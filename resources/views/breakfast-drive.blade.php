{{-- resources/views/breakfast-drive.blade.php --}}
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'Breakfast Drive | TopGear India')

@section('styles')
<style>
    #paymentSection { display: none; }

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
        transition: all 0.3s ease;
    }

    /* Guest selector buttons */
    .bd-guest-selector {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .bd-guest-btn {
        border: 2px solid #ddd;
        border-radius: 6px;
        padding: 8px 22px;
        font-size: 15px;
        font-weight: 600;
        background: #fff;
        color: #555;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .bd-guest-btn:hover {
        border-color: #e21b22;
        color: #e21b22;
    }
    .bd-guest-btn.active {
        border-color: #e21b22;
        background: #e21b22;
        color: #fff;
    }

    /* Guest fields block */
    .bd-guest-block {
        background: #f9f9f9;
        border: 1px solid #eee;
        border-radius: 6px;
        padding: 16px 20px;
        margin-top: 12px;
        display: none;
    }
    .bd-guest-block .form-label {
        color: #222;
        font-weight: 500;
    }
    .bd-guest-block .bd-guest-title {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #e21b22;
        margin-bottom: 12px;
    }

    /* Live total */
    .bd-total-display {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 24px 0 8px;
        padding: 14px 20px;
        background: #fff8f8;
        border: 1px solid #f5c6c6;
        border-radius: 6px;
    }
    .bd-total-display .bd-total-label {
        font-size: 13px;
        color: #888;
    }
    .bd-total-display .bd-total-amount {
        font-size: 22px;
        font-weight: 700;
        color: #e21b22;
    }
    .bd-total-display .bd-total-breakdown {
        font-size: 12px;
        color: #aaa;
        margin-top: 2px;
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
                    ₹1,500 <span style="font-size:14px;font-weight:400;color:#888;">per person · inclusive of breakfast</span>
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

                        {{-- Guest Selector --}}
                        <div class="col-12 mt-4">
                            <label class="form-label d-block" style="font-weight:600;margin-bottom:10px;">
                                Bringing someone along?
                            </label>
                            <div class="bd-guest-selector">
                                <button type="button" class="bd-guest-btn active" data-guests="0">Just me</button>
                                <button type="button" class="bd-guest-btn" data-guests="1">+1 Guest</button>
                                <button type="button" class="bd-guest-btn" data-guests="2">+2 Guests</button>
                                <button type="button" class="bd-guest-btn" data-guests="3">+3 Guests</button>
                            </div>
                            {{-- Hidden input tracks the count --}}
                            <input type="hidden" name="guests_count" id="guestsCountInput" value="0">
                        </div>

                        {{-- Guest 1 fields --}}
                        <div class="col-12" id="guest1Block">
                            <div class="bd-guest-block" id="guest1Fields">
                                <div class="bd-guest-title">Guest 1</div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Guest 1 Name</label>
                                        <input type="text" name="guests[0][name]" class="form-control" id="guest1Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Guest 1 Mobile</label>
                                        <input type="tel" name="guests[0][mobile]" class="form-control"
                                            pattern="[0-9]{10}" maxlength="10" id="guest1Mobile"
                                            title="Please enter a valid 10-digit mobile number">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Guest 2 fields --}}
                        <div class="col-12" id="guest2Block">
                            <div class="bd-guest-block" id="guest2Fields">
                                <div class="bd-guest-title">Guest 2</div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Guest 2 Name</label>
                                        <input type="text" name="guests[1][name]" class="form-control" id="guest2Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Guest 2 Mobile</label>
                                        <input type="tel" name="guests[1][mobile]" class="form-control"
                                            pattern="[0-9]{10}" maxlength="10" id="guest2Mobile"
                                            title="Please enter a valid 10-digit mobile number">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Guest 3 fields --}}
                        <div class="col-12" id="guest3Block">
                            <div class="bd-guest-block" id="guest3Fields">
                                <div class="bd-guest-title">Guest 3</div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Guest 3 Name</label>
                                        <input type="text" name="guests[2][name]" class="form-control" id="guest3Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Guest 3 Mobile</label>
                                        <input type="tel" name="guests[2][mobile]" class="form-control"
                                            pattern="[0-9]{10}" maxlength="10" id="guest3Mobile"
                                            title="Please enter a valid 10-digit mobile number">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Live Total --}}
                        <div class="col-12">
                            <div class="bd-total-display">
                                <div>
                                    <div class="bd-total-label">Total Amount</div>
                                    <div class="bd-total-amount" id="bdTotalDisplay">₹1,500</div>
                                    <div class="bd-total-breakdown" id="bdBreakdownDisplay">1 person × ₹1,500</div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 mt-2">
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

                <p id="paymentSummaryText">An entry fee of <strong>₹1,500</strong> (inclusive of breakfast) secures your spot.</p>

                <div class="row g-3">
                    <div class="col-12 mt-2">
                        <div class="d-grid">
                            <button type="button" id="bdRazorpayBtn" class="btn tg-btn">Pay Now</button>
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
            let totalPaise    = 150000; // tracks the server-confirmed total

            const PRICE_PER_PERSON = 1500;

            // ── Guest selector logic ─────────────────────────────────────
            const guestBtns       = document.querySelectorAll(".bd-guest-btn");
            const guestsCountInput= document.getElementById("guestsCountInput");
            const guest1Fields    = document.getElementById("guest1Fields");
            const guest2Fields    = document.getElementById("guest2Fields");
            const guest3Fields    = document.getElementById("guest3Fields");
            const totalDisplay    = document.getElementById("bdTotalDisplay");
            const breakdownDisplay= document.getElementById("bdBreakdownDisplay");

            function setGuestRequired(fields, required) {
                fields.querySelectorAll("input").forEach(inp => {
                    if (required) {
                        inp.setAttribute("required", "");
                    } else {
                        inp.removeAttribute("required");
                        inp.value = "";
                    }
                });
            }

            function updateGuestUI(count) {
                // Update button states
                guestBtns.forEach(btn => {
                    btn.classList.toggle("active", parseInt(btn.dataset.guests) === count);
                });

                guestsCountInput.value = count;

                // Show/hide guest blocks with animation
                if (count >= 1) {
                    guest1Fields.style.display = "block";
                    setGuestRequired(guest1Fields, true);
                } else {
                    guest1Fields.style.display = "none";
                    setGuestRequired(guest1Fields, false);
                }

                if (count >= 2) {
                    guest2Fields.style.display = "block";
                    setGuestRequired(guest2Fields, true);
                } else {
                    guest2Fields.style.display = "none";
                    setGuestRequired(guest2Fields, false);
                }

                if (count >= 3) {
                    guest3Fields.style.display = "block";
                    setGuestRequired(guest3Fields, true);
                } else {
                    guest3Fields.style.display = "none";
                    setGuestRequired(guest3Fields, false);
                }

                // Update live total
                const persons = count + 1;
                const total   = persons * PRICE_PER_PERSON;
                totalDisplay.textContent    = "₹" + total.toLocaleString("en-IN");
                breakdownDisplay.textContent = persons + " person" + (persons > 1 ? "s" : "") + " × ₹" + PRICE_PER_PERSON.toLocaleString("en-IN");

                // Update pay button text
                razorpayBtn.textContent = "Pay ₹" + total.toLocaleString("en-IN") + " Now";
            }

            guestBtns.forEach(btn => {
                btn.addEventListener("click", () => updateGuestUI(parseInt(btn.dataset.guests)));
            });

            // Init UI
            updateGuestUI(0);

            // ── Helpers ──────────────────────────────────────────────────
            function getFormData() {
                const form     = document.getElementById("breakfast-drive-form");
                const count    = parseInt(guestsCountInput.value);
                const data     = {
                    name:           form.querySelector("[name=name]").value,
                    mobile:         form.querySelector("[name=mobile]").value,
                    email:          form.querySelector("[name=email]").value,
                    car_brand:      form.querySelector("[name=car_brand]").value,
                    car_model:      form.querySelector("[name=car_model]").value,
                    car_number:     form.querySelector("[name=car_number]").value,
                    instagram_link: form.querySelector("[name=instagram_link]").value,
                    guests_count:   count,
                    guests:         []
                };

                if (count >= 1) {
                    data.guests.push({
                        name:   document.getElementById("guest1Name").value,
                        mobile: document.getElementById("guest1Mobile").value
                    });
                }
                if (count >= 2) {
                    data.guests.push({
                        name:   document.getElementById("guest2Name").value,
                        mobile: document.getElementById("guest2Mobile").value
                    });
                }
                if (count >= 3) {
                    data.guests.push({
                        name:   document.getElementById("guest3Name").value,
                        mobile: document.getElementById("guest3Mobile").value
                    });
                }

                return data;
            }

            function pollPaymentStatus(maxAttempts = 10) {
                razorpayBtn.disabled    = true;
                razorpayBtn.textContent = "Verifying payment...";

                let attempts = 0;

                const interval = setInterval(() => {
                    attempts++;

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
                        if (data.paid) {
                            clearInterval(interval);
                            alert(data.message || "Payment confirmed! Your spot for the Breakfast Drive is secured.\nA confirmation has been sent to your email.");
                            window.location.href = "{{ route('breakfast-drive.index') }}";
                        } else if (attempts >= maxAttempts) {
                            clearInterval(interval);
                            razorpayBtn.disabled    = false;
                            razorpayBtn.textContent = "Pay ₹" + (totalPaise / 100).toLocaleString("en-IN") + " Now";
                            alert("We couldn't confirm your payment yet. If you already paid, please wait a few minutes or contact us at info@topgearmag.in.");
                        }
                    })
                    .catch(err => {
                        console.error("Poll error:", err);
                        if (attempts >= maxAttempts) {
                            clearInterval(interval);
                            razorpayBtn.disabled    = false;
                            razorpayBtn.textContent = "Pay ₹" + (totalPaise / 100).toLocaleString("en-IN") + " Now";
                        }
                    });
                }, 3000);
            }

            // ── STEP 1: Save details → show payment ───────────────────────
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
                    }).catch(err => console.error("n8n webhook error:", err));

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
                        if (!res.ok) return res.text().then(t => { throw new Error(t); });
                        return res.json();
                    })
                    .then(data => {
                        if (data.success) {
                            memberId   = data.member_id;
                            totalPaise = data.amount_paise;

                            const persons = formData.guests_count + 1;
                            const totalRs = totalPaise / 100;

                            // Update payment section summary
                            document.getElementById("paymentSummaryText").innerHTML =
                                "An entry fee of <strong>₹" + totalRs.toLocaleString("en-IN") +
                                "</strong> for " + persons + " person" + (persons > 1 ? "s" : "") +
                                " (inclusive of breakfast) secures your spot.";

                            razorpayBtn.textContent = "Pay ₹" + totalRs.toLocaleString("en-IN") + " Now";

                            document.getElementById("formSection").style.display    = "none";
                            document.getElementById("paymentSection").style.display = "block";
                        } else {
                            alert("Could not save your details. Please try again.");
                            proceedBtn.disabled    = false;
                            proceedBtn.textContent = "Proceed To Payment";
                        }
                    })
                    .catch(err => {
                        console.error("Save details failed:", err);
                        alert("Something went wrong. Please try again.");
                        proceedBtn.disabled    = false;
                        proceedBtn.textContent = "Proceed To Payment";
                    });
                });
            }

            // ── STEP 2: Razorpay Checkout ─────────────────────────────────
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
                        if (!res.ok) return res.text().then(t => { throw new Error(t); });
                        return res.json();
                    })
                    .then(order => {

                        const formData = getFormData();
                        const mobile   = (formData.mobile || "").replace(/\D/g, "");

                        const options = {
                            key:         "{{ $razorpayKey }}",
                            amount:      order.amount,
                            currency:    order.currency,
                            name:        "TopGear India",
                            description: "Breakfast Drive – 5th July 2026",
                            order_id:    order.order_id,
                            prefill: {
                                name:    formData.name  || "",
                                email:   formData.email || "",
                                contact: mobile
                            },
                            theme: { color: "#e21b22" },
                            handler: function (response) {
                                razorpayBtn.disabled    = true;
                                razorpayBtn.textContent = "Verifying payment...";

                                fetch("{{ route('breakfast-drive.verifyPayment') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Accept": "application/json"
                                    },
                                    body: JSON.stringify({
                                        member_id:           memberId,
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id:   response.razorpay_order_id,
                                        razorpay_signature:  response.razorpay_signature
                                    })
                                })
                                .then(res => {
                                    if (!res.ok) return res.text().then(t => { throw new Error(t); });
                                    return res.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        alert(data.message + "\nA confirmation has been sent to your registered email.");
                                        window.location.href = "{{ route('breakfast-drive.index') }}";
                                    } else {
                                        pollPaymentStatus();
                                    }
                                })
                                .catch(() => pollPaymentStatus());
                            },
                            modal: {
                                ondismiss: function () {
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
                        razorpayBtn.textContent = "Pay ₹" + (totalPaise / 100).toLocaleString("en-IN") + " Now";
                    });
                });
            }

        });
    </script>

@endsection

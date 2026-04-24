<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Red Line Club</title>
</head>
<body style="margin:0;padding:0;background-color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#0a0a0a;">
        <tr>
            <td align="center" style="padding:40px 20px;">

                <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background-color:#111111;border-radius:8px;overflow:hidden;border-top:4px solid #e21b22;">

                    {{-- Header --}}
                    <tr>
                        <td align="center" style="padding:36px 40px 24px;background-color:#111111;">
                            <img src="https://topgearmag.in/uploads/Banners/redlineclub.jpg"
                                 alt="TopGear India Red Line Club"
                                 width="560"
                                 style="width:100%;max-width:560px;border-radius:4px;display:block;">
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:32px 40px 24px;">

                            <p style="margin:0 0 20px;font-size:22px;font-weight:700;color:#ffffff;line-height:1.3;">
                                Dear {{ $member->name }},
                            </p>

                            <p style="margin:0 0 16px;font-size:16px;color:#cccccc;line-height:1.7;">
                                You're officially in. Welcome to the <strong style="color:#e21b22;">Red Line Club</strong> — TopGear India's exclusive community for India's most passionate drivers.
                            </p>

                            <p style="margin:0 0 16px;font-size:16px;color:#cccccc;line-height:1.7;">
                                Your registration and payment of <strong style="color:#ffffff;">INR 30,000</strong> have been confirmed. Your spot is secured for <strong style="color:#ffffff;">1 Car & 2 Pax</strong> at the inaugural event.
                            </p>

                            {{-- Event Details Box --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:28px 0;background-color:#1a1a1a;border-left:4px solid #e21b22;border-radius:4px;">
                                <tr>
                                    <td style="padding:20px 24px;">
                                        <p style="margin:0 0 6px;font-size:11px;font-weight:700;color:#e21b22;letter-spacing:2px;text-transform:uppercase;">Event Details</p>
                                        <p style="margin:0 0 10px;font-size:20px;font-weight:700;color:#ffffff;">Founder's Edition — Red Line Club</p>
                                        <p style="margin:0 0 6px;font-size:15px;color:#cccccc;">📅 &nbsp;May 16, 2026</p>
                                        <p style="margin:0 0 6px;font-size:15px;color:#cccccc;">📍 &nbsp;Aamby Valley Airstrip, Maharashtra</p>
                                        <p style="margin:0;font-size:15px;color:#cccccc;">🚗 &nbsp;1 Car & 2 Pax (Invite Only)</p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Car Details Box --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:0 0 28px;background-color:#1a1a1a;border-radius:4px;">
                                <tr>
                                    <td style="padding:20px 24px;">
                                        <p style="margin:0 0 12px;font-size:11px;font-weight:700;color:#888888;letter-spacing:2px;text-transform:uppercase;">Your Registered Car</p>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="padding:4px 0;font-size:14px;color:#888888;width:120px;">Brand</td>
                                                <td style="padding:4px 0;font-size:14px;color:#ffffff;font-weight:600;">{{ $member->car_brand }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:4px 0;font-size:14px;color:#888888;">Model</td>
                                                <td style="padding:4px 0;font-size:14px;color:#ffffff;font-weight:600;">{{ $member->car_model }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:4px 0;font-size:14px;color:#888888;">Number</td>
                                                <td style="padding:4px 0;font-size:14px;color:#ffffff;font-weight:600;">{{ $member->car_number }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 16px;font-size:16px;color:#cccccc;line-height:1.7;">
                                More details about the event — including the schedule, parking, and run format — will follow closer to the date. Keep an eye on your inbox.
                            </p>

                            <p style="margin:0 0 32px;font-size:16px;color:#cccccc;line-height:1.7;">
                                We'll see you at the Red Line. 🏁
                            </p>



                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:24px 40px;border-top:1px solid #222222;background-color:#0d0d0d;">
                            <p style="margin:0 0 8px;font-size:13px;color:#555555;line-height:1.6;">
                                For any queries, reply to this email or write to us at
                                <a href="mailto:info@topgearmag.in" style="color:#e21b22;text-decoration:none;">info@topgearmag.in</a>
                            </p>
                            <p style="margin:0;font-size:12px;color:#444444;">
                                © {{ date('Y') }} TopGear India. All rights reserved. &nbsp;|&nbsp;
                                <a href="https://topgearmag.in" style="color:#555555;text-decoration:none;">topgearmag.in</a>
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>

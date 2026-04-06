<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmed – Tonet Salon</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: #0f0f0f;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #e5e5e5;
        }
        .wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1a1a1a;
        }
        /* Header */
        .header {
            background: linear-gradient(135deg, #1a0000 0%, #3d0000 50%, #1a0000 100%);
            padding: 40px 32px;
            text-align: center;
            border-bottom: 2px solid #c0392b;
        }
        .salon-logo {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 3px;
            color: #ffffff;
            text-transform: uppercase;
        }
        .salon-logo span {
            color: #e74c3c;
        }
        .header-tagline {
            font-size: 12px;
            color: #999;
            letter-spacing: 2px;
            margin-top: 6px;
            text-transform: uppercase;
        }
        /* Status Badge */
        .status-section {
            background: linear-gradient(135deg, #0d2818, #0a3d20);
            padding: 36px 32px;
            text-align: center;
            border-bottom: 1px solid #1e4d2b;
        }
        .status-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 36px;
            line-height: 1;
        }
        .status-title {
            font-size: 24px;
            font-weight: 700;
            color: #2ecc71;
            margin-bottom: 8px;
        }
        .status-subtitle {
            font-size: 14px;
            color: #aaa;
            line-height: 1.6;
        }
        /* Body */
        .body {
            padding: 32px;
        }
        .greeting {
            font-size: 16px;
            color: #ddd;
            margin-bottom: 24px;
            line-height: 1.6;
        }
        .greeting strong {
            color: #ffffff;
        }
        /* Appointment Card */
        .appointment-card {
            background: #242424;
            border: 1px solid #333;
            border-left: 4px solid #2ecc71;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 28px;
        }
        .card-title {
            font-size: 11px;
            font-weight: 700;
            color: #2ecc71;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 16px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #2d2d2d;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            flex-shrink: 0;
            margin-right: 16px;
        }
        .detail-value {
            font-size: 14px;
            color: #e0e0e0;
            font-weight: 500;
            text-align: right;
        }
        /* Info Box */
        .info-box {
            background: #1a1a2e;
            border: 1px solid #2c2c5e;
            border-radius: 8px;
            padding: 20px 24px;
            margin-bottom: 28px;
        }
        .info-box p {
            font-size: 14px;
            color: #b0b0cc;
            line-height: 1.7;
        }
        .info-box p + p {
            margin-top: 10px;
        }
        /* CTA Button */
        .cta-section {
            text-align: center;
            margin-bottom: 32px;
        }
        .cta-note {
            font-size: 13px;
            color: #888;
            margin-bottom: 4px;
        }
        /* Footer */
        .footer {
            background: #111;
            padding: 28px 32px;
            text-align: center;
            border-top: 1px solid #222;
        }
        .footer-logo {
            font-size: 16px;
            font-weight: 700;
            color: #666;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .footer-logo span { color: #c0392b; }
        .footer-address {
            font-size: 12px;
            color: #555;
            line-height: 1.8;
        }
        .footer-divider {
            border: none;
            border-top: 1px solid #222;
            margin: 16px 0;
        }
        .footer-legal {
            font-size: 11px;
            color: #444;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="wrapper">

        <!-- Header -->
        <div class="header">
            <div class="salon-logo">TONET <span>SALON</span></div>
            <div class="header-tagline">Premium Beauty & Wellness</div>
        </div>

        <!-- Status Banner -->
        <div class="status-section">
            <div class="status-icon">✓</div>
            <div class="status-title">Appointment Confirmed!</div>
            <div class="status-subtitle">
                Great news! Your appointment has been reviewed<br>and officially confirmed by our team.
            </div>
        </div>

        <!-- Body -->
        <div class="body">
            <p class="greeting">
                Hello, <strong>{{ $appointment->customer_name }}</strong>! 👋
                <br><br>
                We're thrilled to confirm your upcoming appointment at <strong>Tonet Salon</strong>.
                Please review your booking details below and mark your calendar!
            </p>

            <!-- Appointment Details Card -->
            <div class="appointment-card">
                <div class="card-title">📋 Appointment Details</div>

                <div class="detail-row">
                    <span class="detail-label">Client Name</span>
                    <span class="detail-value">{{ $appointment->customer_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Service</span>
                    <span class="detail-value">{{ $appointment->service->name ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date & Time</span>
                    <span class="detail-value">
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('F j, Y') }}<br>
                        <small style="color:#aaa;">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</small>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Price</span>
                    <span class="detail-value" style="color: #2ecc71; font-weight: 700;">
                        ₱{{ number_format($appointment->service->price ?? 0, 2) }}
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value" style="color: #2ecc71; font-weight: 700;">✅ Confirmed</span>
                </div>
                @if($appointment->message)
                <div class="detail-row">
                    <span class="detail-label">Your Note</span>
                    <span class="detail-value" style="font-style: italic; color: #aaa;">{{ $appointment->message }}</span>
                </div>
                @endif
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <p>⏰ <strong style="color:#ddd;">Please arrive 5–10 minutes early</strong> to ensure we can give you our full attention from the start of your session.</p>
                <p>📞 If you need to reschedule or have any questions, please contact us as soon as possible so we can accommodate you.</p>
            </div>

            <!-- CTA -->
            <div class="cta-section">
                <p class="cta-note">We look forward to seeing you! 💇‍♀️✨</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">TONET <span>SALON</span></div>
            <div class="footer-address">
                Premium Beauty & Wellness<br>
                📧 tonetsalon@gmail.com
            </div>
            <hr class="footer-divider">
            <div class="footer-legal">
                This is an automated notification from Tonet Salon Management System.<br>
                Please do not reply directly to this email.
            </div>
        </div>

    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Cancelled – Tonet Salon</title>
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
            background: linear-gradient(135deg, #1a0a0a, #2d0d0d);
            padding: 36px 32px;
            text-align: center;
            border-bottom: 1px solid #3d1515;
        }
        .status-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
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
            color: #e74c3c;
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
            border-left: 4px solid #e74c3c;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 28px;
        }
        .card-title {
            font-size: 11px;
            font-weight: 700;
            color: #e74c3c;
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
        /* Info Box – next steps */
        .info-box {
            background: #1a1a1a;
            border: 1px solid #2d2d2d;
            border-radius: 8px;
            padding: 20px 24px;
            margin-bottom: 28px;
        }
        .info-box-title {
            font-size: 13px;
            font-weight: 700;
            color: #e74c3c;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }
        .info-box p {
            font-size: 14px;
            color: #aaa;
            line-height: 1.7;
        }
        .info-box p + p {
            margin-top: 10px;
        }
        /* Apology Note */
        .apology-box {
            background: linear-gradient(135deg, #1a0a0a, #200d0d);
            border: 1px solid #3d1515;
            border-radius: 8px;
            padding: 20px 24px;
            margin-bottom: 28px;
            text-align: center;
        }
        .apology-box p {
            font-size: 14px;
            color: #cc9999;
            line-height: 1.7;
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
            <div class="status-icon">✕</div>
            <div class="status-title">Appointment Cancelled</div>
            <div class="status-subtitle">
                We're sorry to inform you that your appointment<br>has been cancelled by our team.
            </div>
        </div>

        <!-- Body -->
        <div class="body">
            <p class="greeting">
                Hello, <strong>{{ $appointment->customer_name }}</strong>,
                <br><br>
                We regret to inform you that your appointment at <strong>Tonet Salon</strong> has been cancelled.
                Please see the details of the cancelled booking below.
            </p>

            <!-- Appointment Details Card -->
            <div class="appointment-card">
                <div class="card-title">📋 Cancelled Appointment Details</div>

                <div class="detail-row">
                    <span class="detail-label">Client Name</span>
                    <span class="detail-value">{{ $appointment->customer_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Service</span>
                    <span class="detail-value">{{ $appointment->service->name ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Original Date & Time</span>
                    <span class="detail-value">
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('F j, Y') }}<br>
                        <small style="color:#aaa;">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</small>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value" style="color: #e74c3c; font-weight: 700;">❌ Cancelled</span>
                </div>
                @if($appointment->message)
                <div class="detail-row">
                    <span class="detail-label">Notes</span>
                    <span class="detail-value" style="font-style: italic; color: #aaa;">{{ $appointment->message }}</span>
                </div>
                @endif
            </div>

            <!-- Apology Note -->
            <div class="apology-box">
                <p>
                    We sincerely apologize for any inconvenience this may have caused.<br>
                    We value your time and your trust in Tonet Salon. 🙏
                </p>
            </div>

            <!-- Next Steps -->
            <div class="info-box">
                <div class="info-box-title">🔄 What to do next?</div>
                <p>📅 You are welcome to <strong style="color: #ddd;">book a new appointment</strong> at your earliest convenience through our website.</p>
                <p>📞 If you believe this cancellation was made in error or have any concerns, please contact us directly at <strong style="color: #ddd;">tonetsalon@gmail.com</strong> and we will be happy to assist you.</p>
                <p>💝 We hope to see you at Tonet Salon again soon!</p>
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

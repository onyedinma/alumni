<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ getSettingImage('app_fav_icon') }}" type="image/png" sizes="16x16">
    <title>{{ getOption('app_name') }} - {{__('Ticket Verification')}}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --brand-gold: #D4AF5A;
            --brand-maroon: #8B2635;
            --brand-dark: #0B0E11;
            --brand-surface: #12161C;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--brand-dark) 0%, var(--brand-surface) 50%, var(--brand-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background orbs */
        body::before,
        body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            z-index: 0;
        }

        body::before {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, var(--brand-maroon), rgba(212, 175, 90, 0.3));
            top: -50px;
            left: -50px;
            animation: float 15s infinite ease-in-out;
        }

        body::after {
            width: 250px;
            height: 250px;
            background: linear-gradient(45deg, var(--brand-gold), rgba(139, 38, 53, 0.3));
            bottom: -50px;
            right: -50px;
            animation: float 20s infinite ease-in-out reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(30px, -30px) scale(1.1);
            }
        }

        /* Verification Card */
        .verify-card {
            background: rgba(18, 22, 28, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 90, 0.2);
            border-radius: 24px;
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
        }

        .verify-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--brand-maroon), var(--brand-gold), var(--brand-maroon));
        }

        /* Header */
        .verify-header {
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.3) 0%, rgba(18, 22, 28, 0.9) 100%);
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .verify-header img {
            max-height: 50px;
            margin-bottom: 16px;
        }

        .verify-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }

        /* Body */
        .verify-body {
            padding: 40px 30px;
            text-align: center;
        }

        /* Status Icon */
        .status-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 40px;
        }

        .status-icon.success {
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(76, 175, 80, 0.1));
            border: 3px solid rgba(76, 175, 80, 0.5);
            color: #4CAF50;
            animation: pulseSuccess 2s infinite;
        }

        .status-icon.failed {
            background: linear-gradient(135deg, rgba(244, 67, 54, 0.2), rgba(244, 67, 54, 0.1));
            border: 3px solid rgba(244, 67, 54, 0.5);
            color: #F44336;
        }

        @keyframes pulseSuccess {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.4);
            }

            50% {
                box-shadow: 0 0 0 15px rgba(76, 175, 80, 0);
            }
        }

        /* Status Text */
        .status-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .status-title.success {
            color: #4CAF50;
        }

        .status-title.failed {
            color: #F44336;
        }

        /* Ticket Details */
        .ticket-details {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }

        .ticket-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .ticket-row:last-child {
            border-bottom: none;
        }

        .ticket-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .ticket-value {
            color: var(--brand-gold);
            font-weight: 600;
            font-size: 14px;
        }

        .event-name {
            color: rgba(255, 255, 255, 0.8);
            font-size: 15px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px dashed rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body>

    <div class="verify-card">
        <!-- Header -->
        <div class="verify-header">
            <img src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}" />
            <h1>{{__('Ticket Verification')}}</h1>
        </div>

        <!-- Body -->
        <div class="verify-body">
            @if($success == true)
                <!-- Success State -->
                <div class="status-icon success">
                    <i class="fas fa-check"></i>
                </div>
                <h4 class="status-title success">{{ __('Successfully Verified') }}</h4>

                <div class="ticket-details">
                    <div class="ticket-row">
                        <span class="ticket-label">{{ __('Ticket No') }}</span>
                        <span class="ticket-value">{{ $ticket->ticket_number }}</span>
                    </div>
                    <div class="ticket-row">
                        <span class="ticket-label">{{ __('Participant') }}</span>
                        <span class="ticket-value">{{ $ticket->user->name }}</span>
                    </div>
                    <p class="event-name">
                        <i class="fas fa-calendar-alt" style="color: var(--brand-gold); margin-right: 8px;"></i>
                        {{ $ticket->event->title }}
                    </p>
                </div>
            @else
                <!-- Failed State -->
                <div class="status-icon failed">
                    <i class="fas fa-times"></i>
                </div>
                <h4 class="status-title failed">{{ __('Verification Failed') }}</h4>
                <p style="color: rgba(255, 255, 255, 0.6); font-size: 15px;">
                    {{ __('The ticket could not be verified. Please check the ticket details and try again.') }}
                </p>
            @endif
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
</body>

</html>
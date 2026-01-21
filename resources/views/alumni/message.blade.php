@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <style>
        /* Premium Messages Section */
        .premium-messages-section {
            background: var(--bg-primary, #0B0E11) !important;
            padding: 20px 30px;
            min-height: calc(100vh - 100px);
        }

        /* Chat Container */
        .content-chat {
            display: flex;
            gap: 20px;
            height: calc(100vh - 180px);
            background: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            border-radius: 24px;
            padding: 0;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
        }

        /* Top Border Gradient */
        .content-chat::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
            border-radius: 24px 24px 0 0;
            z-index: 10;
        }

        /* Left Sidebar - User List */
        .content-chat-user {
            width: 320px;
            background: var(--bg-elevated, #171C23) !important;
            border-right: 1px solid var(--border-dark, #1F2630) !important;
            display: flex;
            flex-direction: column;
            padding-top: 6px;
        }

        .head-chat {
            padding: 20px;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            background: transparent !important;
        }

        .head-chat .title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--gold, #D4AF5A) !important;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .head-chat .title::before {
            content: '\f4ad';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 22px;
        }

        /* Search Box */
        .search-two {
            padding: 10px 12px !important;
            position: relative;
            background: transparent !important;
        }

        .search-two input {
            width: 100% !important;
            background: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            border-radius: 8px !important;
            padding: 6px 32px 6px 12px !important;
            color: var(--text-primary, #E6EAF0) !important;
            font-size: 13px !important;
            height: 36px !important;
            transition: all 0.3s ease;
        }

        .search-two input:focus {
            outline: none;
            border-color: var(--gold, #D4AF5A) !important;
            box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.1);
        }

        .search-two input::placeholder {
            color: var(--text-disabled, #5E6675) !important;
        }

        .search-two .icon {
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent !important;
            border: none;
            padding: 5px;
        }

        .search-two .icon img {
            filter: invert(68%) sepia(48%) saturate(434%) hue-rotate(359deg) brightness(91%) contrast(88%);
        }

        /* User List */
        .list-search-user-chat {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            background: transparent !important;
        }

        /* Right Side - Chat Messages */
        .content-chat-message-user-wrap {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            background: var(--bg-primary, #0B0E11) !important;
        }

        .content-chat-message-user {
            display: none;
            flex-direction: column;
            height: 100%;
            background: transparent !important;
        }

        .content-chat-message-user.active {
            display: flex;
        }

        /* Chat Header */
        .head-chat-message-user {
            padding: 20px 30px;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            background: var(--bg-elevated, #171C23) !important;
        }

        /* Chat Body */
        .body-chat-message-user {
            flex: 1;
            overflow-y: auto;
            padding: 20px 30px;
            background: var(--bg-primary, #0B0E11) !important;
        }

        /* Chat Footer */
        .footer-chat-message-user {
            padding: 20px 30px;
            border-top: 1px solid var(--border-dark, #1F2630) !important;
            background: var(--bg-elevated, #171C23) !important;
        }

        #files-area {
            margin-bottom: 10px;
            color: var(--text-secondary, #B4BCC8);
        }

        .footer-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .message-user-send {
            flex: 1;
        }

        .send-message {
            width: 100%;
            background: var(--bg-primary, #0B0E11);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 12px;
            padding: 12px 16px;
            color: var(--text-primary, #E6EAF0);
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .send-message:focus {
            outline: none;
            border-color: var(--gold, #D4AF5A);
            box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.1);
        }

        .send-message::placeholder {
            color: var(--text-disabled, #5E6675);
        }

        .atta-btn,
        .send-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 1px solid var(--border-dark, #1F2630);
            background: var(--bg-primary, #0B0E11);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .atta-btn:hover,
        .send-btn:hover {
            background: var(--gold, #D4AF5A);
            border-color: var(--gold, #D4AF5A);
            transform: translateY(-2px);
        }

        .atta-btn img,
        .send-btn img {
            filter: invert(68%) sepia(48%) saturate(434%) hue-rotate(359deg) brightness(91%) contrast(88%);
        }

        .atta-btn:hover img,
        .send-btn:hover img {
            filter: brightness(0);
        }

        .send-btn {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%);
            border-color: var(--gold, #D4AF5A);
        }

        .send-btn:hover {
            background: linear-gradient(135deg, #e3c16e 0%, #c4a159 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 175, 90, 0.3);
        }

        .send-btn img {
            filter: brightness(0);
        }

        /* Scrollbar Styling */
        .list-search-user-chat::-webkit-scrollbar,
        .body-chat-message-user::-webkit-scrollbar {
            width: 6px;
        }

        .list-search-user-chat::-webkit-scrollbar-track,
        .body-chat-message-user::-webkit-scrollbar-track {
            background: var(--bg-primary, #0B0E11);
        }

        .list-search-user-chat::-webkit-scrollbar-thumb,
        .body-chat-message-user::-webkit-scrollbar-thumb {
            background: var(--gold, #D4AF5A);
            border-radius: 3px;
        }

        .list-search-user-chat::-webkit-scrollbar-thumb:hover,
        .body-chat-message-user::-webkit-scrollbar-thumb:hover {
            background: var(--maroon, #8B2635);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-chat-user {
                width: 280px;
            }
        }

        /* ======== Chat User List Items ======== */
        .user-chat {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 4px;
            background: transparent;
        }

        .user-chat:hover {
            background: var(--bg-primary, #0B0E11);
        }

        .user-chat.active {
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.3) 0%, rgba(212, 175, 90, 0.2) 100%) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
        }

        .user-chat-img {
            position: relative;
            flex-shrink: 0;
        }

        .user-chat-img img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-dark, #1F2630);
        }

        .user-chat.active .user-chat-img img {
            border-color: var(--gold, #D4AF5A);
        }

        .user-chat-img .online,
        .user-chat-img .offline {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid var(--bg-elevated, #171C23);
        }

        .user-chat-img .online {
            background: #0fa958;
        }

        .user-chat-img .offline {
            background: var(--text-disabled, #5E6675);
        }

        .user-chat-text-time {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 8px;
            min-width: 0;
        }

        .user-chat-text {
            flex: 1;
            min-width: 0;
        }

        .user-chat-text .name {
            color: var(--text-primary, #E6EAF0) !important;
            font-size: 14px;
            font-weight: 600;
            margin: 0 0 4px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-chat.active .user-chat-text .name {
            color: var(--gold, #D4AF5A) !important;
        }

        .user-chat-text small {
            color: var(--text-secondary, #B4BCC8) !important;
            font-size: 12px;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-chat-time {
            text-align: right;
            flex-shrink: 0;
        }

        .user-chat-time .time {
            color: var(--text-disabled, #5E6675);
            font-size: 11px;
            margin: 0 0 4px 0;
        }

        .user-chat-time .notify {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 10px;
            background: var(--maroon, #8B2635);
            color: #FFFFFF;
            font-size: 11px;
            font-weight: 600;
            margin: 0;
        }

        /* ======== Chat Header - User Info ======== */
        .head-chat-message-user {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .message-user-img {
            position: relative;
            flex-shrink: 0;
        }

        .message-user-img img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gold, #D4AF5A);
        }

        .message-user-img .online,
        .message-user-img .offline {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 2px solid var(--bg-elevated, #171C23);
        }

        .message-user-img .online {
            background: #0fa958;
        }

        .message-user-img .offline {
            background: var(--text-disabled, #5E6675);
        }

        .message-user-text .title {
            color: var(--gold, #D4AF5A) !important;
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 4px 0;
        }

        .message-user-text .status {
            font-size: 12px;
            margin: 0;
            color: var(--text-secondary, #B4BCC8) !important;
        }

        /* ======== Message Bubbles - Actual Classes ======== */

        /* Received messages (left side) */
        .message-user-left {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 12px;
        }

        .message-user-left-text {
            max-width: 70%;
        }

        .message-user-left-text .text {
            background: var(--bg-elevated, #171C23) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            border-radius: 16px !important;
            border-bottom-left-radius: 4px !important;
            padding: 12px 16px !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        .message-user-left-text .text p {
            margin: 0 !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        /* Sent messages (right side) */
        .message-user-right {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 12px;
        }

        .message-user-right-text {
            max-width: 70%;
        }

        .message-user-right-text .text {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%) !important;
            border: none !important;
            border-radius: 16px !important;
            border-bottom-right-radius: 4px !important;
            padding: 12px 16px !important;
            color: #0B0E11 !important;
        }

        .message-user-right-text .text p {
            margin: 0 !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            color: #0B0E11 !important;
        }

        /* Timestamps and read receipts */
        .time-read {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            margin-top: 6px;
        }

        .message-user-left-text .time-read .time {
            font-size: 10px !important;
            color: var(--text-disabled, #5E6675) !important;
        }

        .message-user-right-text .time-read .time {
            font-size: 10px !important;
            color: rgba(11, 14, 17, 0.6) !important;
        }

        /* Read receipt checkmark */
        .message-user-right-text .fill-green svg path {
            fill: #0B0E11 !important;
        }

        .message-user-left-text .time-read svg path {
            fill: var(--gold, #D4AF5A) !important;
        }

        /* Photo/media galleries in chat */
        .messagePhoto {
            list-style: none !important;
            padding: 0 !important;
            margin: 8px 0 0 0 !important;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .messagePhoto li {
            border-radius: 12px;
            overflow: hidden;
        }

        .messagePhoto img,
        .messagePhoto video {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 12px;
        }

        /* Empty chat state */
        .no-chat-message {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--text-secondary, #B4BCC8);
            text-align: center;
            padding: 40px;
        }

        .no-chat-message i {
            font-size: 56px;
            color: var(--gold, #D4AF5A);
            margin-bottom: 20px;
            opacity: 0.4;
        }

        .no-chat-message p {
            font-size: 16px;
            margin: 0;
        }

        /* ======== Framework Override Fixes ======== */
        /* Force gold color for chat header name */
        .message-user-text .title,
        .head-chat-message-user .title,
        .message-user-text h4,
        .head-chat-message-user h4 {
            color: var(--gold, #D4AF5A) !important;
        }

        /* Force light color for chat header status */
        .message-user-text .status,
        .head-chat-message-user .status,
        .message-user-text p:not(.title),
        .message-user-text span {
            color: var(--text-secondary, #B4BCC8) !important;
        }

        /* Ensure other text in active chat is readable */
        .user-chat.active .user-chat-text small,
        .user-chat.active .time {
            color: var(--text-primary, #E6EAF0) !important;
            opacity: 0.8;
        }

        /* In case the name is a link */
        .message-user-text a {
            color: var(--gold, #D4AF5A) !important;
        }
    </style>

    <div class="premium-messages-section">
        <!-- Start -->
        <div class="content-chat">
            <!-- Left -->
            <div class="content-chat-user">
                <!-- Title -->
                <div class="head-chat">
                    <h4 class="title">{{ __('Chat') }}</h4>
                </div>
                <!-- Search -->
                <div class="search-two">
                    <input type="text" id="chat-search-field" placeholder="{{ __('Search People') }}" />
                    <button type="button" class="icon"><img src="{{ asset('assets/images/icon/search-1.svg') }}"
                            alt="" /></button>
                </div>
                <!-- User list -->
                <div class="list-search-user-chat" id="chat-user">
                    @include('alumni.partials.chat-user-list')
                </div>
            </div>
            <!-- Right -->
            <div class="content-chat-message-user-wrap">
                <!-- Single Use Message -->
                @foreach ($users as $user)
                    @php
                        if (request()->get('receiver_id') == $user->id) {
                            $isActive = 'active';
                        } elseif (request()->get('receiver_id') == NULL && $loop->first) {
                            $isActive = 'active';
                        } else {
                            $isActive = '';
                        }
                    @endphp
                    <div class="content-chat-message-user {{ $isActive }}" data-id={{ $user->id }}>
                        <!-- Head -->
                        <div class="head-chat-message-user" id="chat-head-{{ $user->id }}">
                            @include('alumni.partials.chat-head')
                        </div>
                        <!-- Body -->
                        <div class="body-chat-message-user" id="chat-body-{{ $user->id }}">

                        </div>
                    </div>
                @endforeach
                <!-- Footer -->
                <div class="footer-chat-message-user border-0">
                    <!-- Attachment preview -->
                    <div id="files-area">
                        <span id="filesList">
                            <span id="files-names"></span>
                        </span>
                    </div>
                    <!-- input - buttons -->
                    <form action="{{ route('chats.send_message') }}" enctype="multipart/form-data" id="send-form"
                        data-handler="sendResponse" method="POST">
                        @csrf
                        <div class="footer-inputs d-flex justify-content-between g-10">
                            <input type="hidden" name="receiver_id" id="form-receiver-id" value="">
                            <div class="message-user-send">
                                <input type="text" name="message" class="send-message"
                                    placeholder="{{ __('Type your message here') }}..." />
                            </div>
                            <button type="button" class="atta-btn">
                                <label for="mAttachment"><img src="{{ asset('assets/images/icon/attachment.svg')}}"
                                        alt="" /></label>
                                <input type="file" name="file[]" id="mAttachment"
                                    accept=".png,.jpg,.svg,.jpeg,.gif,.mp4,.mov,.avi,.mkv,.webm,.flv" class="d-none"
                                    multiple />
                            </button>
                            <button type="submit" class="send-btn">
                                <img src="{{ asset('assets/images/icon/send.svg')}}" alt="" />
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="pusherEnable" value="{{ getOption('pusher_status', 0) }}">
    <input type="hidden" id="pusherKey" value="{{ getOption('pusher_app_key') }}">
    <input type="hidden" id="pusherCluster" value="{{ getOption('pusher_cluster') }}">
    <input type="hidden" id="single-user-chat-route" value="{{ route('chats.single_user_chat') }}">
@endsection

@push('script')
    <script src="{{ asset('common/js/pusher.min.js') }}"></script>
    <script src="{{ asset('alumni/js/chat.js') }}?ver={{ env('VERSION', 0) }}"></script>
@endpush
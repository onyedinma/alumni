@if(getOption('whatsapp_status') == STATUS_ACTIVE && getOption('whatsapp_number'))
    @php
        $whatsappNumber = preg_replace('/[^0-9]/', '', getOption('whatsapp_number'));
        $defaultMessage = getOption('whatsapp_default_message', 'Hi, I need assistance');
        $position = getOption('whatsapp_position', 'right');
    @endphp

    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($defaultMessage) }}" target="_blank"
        class="whatsapp-float-btn" style="
                position: fixed;
                bottom: 24px;
                {{ $position == 'left' ? 'left: 24px;' : 'right: 24px;' }}
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 56px;
                height: 56px;
                background-color: #25D366;
                color: #fff;
                border-radius: 50%;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                text-decoration: none;
                transition: all 0.3s ease;
            " aria-label="Chat on WhatsApp"
        onmouseover="this.style.backgroundColor='#128C7E'; this.style.transform='scale(1.1)';"
        onmouseout="this.style.backgroundColor='#25D366'; this.style.transform='scale(1)';">
        <i class="fab fa-whatsapp" style="font-size: 32px;"></i>
    </a>
@endif
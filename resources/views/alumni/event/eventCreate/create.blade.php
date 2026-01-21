@extends('layouts.app')
@push('title')
    {{$title}}
@endpush

@section('content')
<style>
    /* Premium Page Background to Match Global Dark Theme */
    .create-event-section {
        background: var(--bg-primary, #0B0E11); /* Deep Black */
        padding: 40px 0;
        min-height: 100vh;
    }

    /* Premium Card with Gold/Red Glow */
    .premium-event-card {
        background: var(--bg-surface, #12161C); /* Dark Surface */
        border: 1px solid var(--border-dark, #1F2630);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 0 40px rgba(0, 0, 0, 0.5); /* Deep shadow */
        position: relative;
        /* overflow: hidden; Removed to allow date picker to show */
    }
    
    /* Top Border Gradient */
    .premium-event-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
        border-radius: 24px 24px 0 0; /* rounded top corners */
    }

    /* Headings */
    .form-title {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        color: var(--gold, #D4AF5A);
        text-align: center;
        margin-bottom: 10px;
    }
    
    .form-subtitle {
        color: var(--text-secondary, #B4BCC8);
        text-align: center;
        margin-bottom: 40px;
        font-size: 15px;
    }

    /* Start of Form Grip Gap */
    .premium-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Two columns */
        gap: 24px;
    }
    
    /* Full width for specific inputs */
    .full-width {
        grid-column: 1 / -1;
    }

    /* Labels with Icon */
    .premium-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-primary, #E6EAF0);
        font-weight: 500;
        font-size: 14px;
        margin-bottom: 10px;
    }
    
    .premium-label .label-icon {
        color: var(--gold, #D4AF5A);
        font-size: 16px;
    }
    
    .text-required {
        color: var(--maroon, #8B2635); /* Red asterisk */
    }
    
    /* Inputs */
    .premium-input, 
    .premium-select,
    .premium-textarea {
        width: 100%;
        background: var(--bg-primary, #0B0E11);
        border: 1px solid var(--border-dark, #1F2630);
        border-radius: 12px;
        padding: 14px 16px;
        color: var(--text-primary, #E6EAF0);
        font-size: 15px;
        transition: all 0.3s ease;
    }
    
    .premium-input:focus,
    .premium-select:focus,
    .premium-textarea:focus {
        outline: none;
        border-color: var(--gold, #D4AF5A);
        box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.15); /* Gold Glow */
        background: var(--bg-elevated, #171C23);
    }
    
    .premium-input::placeholder {
        color: var(--text-disabled, #5E6675);
    }

    /* Style the native datetime picker */
    input[type="datetime-local"].premium-input {
        position: relative;
    }
    
    /* Style the calendar icon (webkit browsers) */
    input[type="datetime-local"].premium-input::-webkit-calendar-picker-indicator {
        cursor: pointer;
        filter: invert(68%) sepia(48%) saturate(434%) hue-rotate(359deg) brightness(91%) contrast(88%);
        font-size: 18px;
        padding: 4px;
    }
    
    input[type="datetime-local"].premium-input::-webkit-calendar-picker-indicator:hover {
        filter: invert(79%) sepia(28%) saturate(629%) hue-rotate(358deg) brightness(97%) contrast(88%);
    }

    /* File Upload Area */
    .premium-upload-box {
        border: 2px dashed var(--border-dark, #1F2630);
        background: var(--bg-elevated, #171C23) url("{{ asset('assets/images/icon/upload-img-1.svg') }}") no-repeat center 30%;
        border-radius: 16px;
        padding: 40px 20px;
        text-align: center;
        position: relative;
        transition: all 0.3s ease;
        cursor: pointer;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
    }
    
    .premium-upload-box:hover {
        border-color: var(--gold, #D4AF5A);
        background-color: rgba(212, 175, 90, 0.05);
    }
    
    .premium-upload-box p {
        color: var(--text-secondary, #B4BCC8);
        margin-top: 10px;
        font-size: 14px;
    }
    
    .premium-upload-box input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    
    .premium-upload-box img.preview-image {
        max-width: 100%;
        max-height: 140px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 8px;
        display: none; /* Hidden by default */
    }

    /* Submit Button */
    .btn-premium-gold {
        background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%);
        color: #000000; /* Black text on gold for classic contrast */
        border: none;
        padding: 16px 40px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
    }
    
    .btn-premium-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(212, 175, 90, 0.4);
        background: linear-gradient(135deg, #e3c16e 0%, #c4a159 100%);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .premium-form-grid {
            grid-template-columns: 1fr; /* Stack on mobile */
        }
        .premium-event-card {
            padding: 24px;
        }
    }
</style>

<div class="create-event-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="premium-event-card">
                    
                    <h2 class="form-title">{{__('Create New Event')}}</h2>
                    <p class="form-subtitle">{{__('Host an amazing event for our alumni community.')}}</p>

                    <form class="ajax reset" data-handler="commonResponseRedirect" data-redirect-url="{{route('event.my-event')}}" action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="premium-form-grid">
                            
                            <!-- Event Title -->
                            <div class="full-width">
                                <label for="eventTitle" class="premium-label">
                                    <i class="fa-solid fa-flag label-icon"></i>
                                    {{__('Event Title')}} <span class="text-required">*</span>
                                </label>
                                <input type="text" class="premium-input" id="eventTitle" name="title" placeholder="{{ __('Annual Alumni Meetup 2024') }}">
                            </div>

                            <!-- Date -->
                            <div>
                                <label for="eventDate" class="premium-label">
                                    <i class="fa-solid fa-calendar-days label-icon"></i>
                                    {{__('Date & Time')}} <span class="text-required">*</span>
                                </label>
                                <input type="datetime-local" name="date" id="eventDate" class="premium-input" required>
                            </div>

                            <!-- Category (No Icon for Dropdown) -->
                            <div>
                                <label for="eventCategory" class="premium-label">
                                    {{__('Category')}} <span class="text-required">*</span>
                                </label>
                                <select class="premium-select sf-select-without-search" name="event_category_id" id="event_category_id">
                                    <option selected="">{{__('Select Category')}}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Type (No Icon for Dropdown) -->
                            <div>
                                <label for="eventType" class="premium-label">
                                    {{__('Event Type')}} <span class="text-required">*</span>
                                </label>
                                <select class="premium-select sf-select-without-search" id="eventType" name="type">
                                  @foreach(eventType() as $index => $type)
                                    <option value="{{$index}}"> {{ $type }}</option>
                                  @endforeach
                                </select>
                            </div>

                            <!-- Number of Tickets -->
                            <div>
                                <label for="eventTicket" class="premium-label">
                                    <i class="fa-solid fa-ticket label-icon"></i>
                                    {{__('Total Tickets')}} <span class="text-required">*</span>
                                </label>
                                <input type="number" name="number_of_ticket" class="premium-input" id="eventTicket" placeholder="Ex: 300">
                            </div>

                            <!-- Ticket Price (Hidden by default based on original logic, but styled) -->
                            <div class="d-none" id="eventPrice">
                                <label for="price" class="premium-label">
                                    <i class="fa-solid fa-dollar-sign label-icon"></i>
                                    {{__('Ticket Price')}} <span class="text-required">*</span>
                                </label>
                                <input type="number" name="price" step="0.01" class="premium-input" id="price" placeholder="$0.00">
                            </div>

                            <!-- Location -->
                            <div class="full-width">
                                <label for="eventLocation" class="premium-label">
                                    <i class="fa-solid fa-location-dot label-icon"></i>
                                    {{__('Location')}} <span class="text-required">*</span>
                                </label>
                                <input name="location" class="premium-input" id="eventLocation" placeholder="{{ __('e.g. Grand Hall, City Center') }}" />
                            </div>

                            <!-- Description -->
                            <div class="full-width">
                                <label for="eventDescription" class="premium-label">
                                    <i class="fa-solid fa-align-left label-icon"></i>
                                    {{__('Description')}} <span class="text-required">*</span>
                                </label>
                                <textarea name="description" class="premium-textarea min-h-180 summernoteOne" id="eventDescription" rows="5" placeholder="{{ __('Write a compelling description for your event...') }}"></textarea>
                            </div>

                            <!-- Thumbnail Upload -->
                            <div>
                                <label class="premium-label">
                                    <i class="fa-solid fa-image label-icon"></i>
                                    {{__('Event Thumbnail')}} <span class="text-required">*</span> <small class="text-muted">(jpg, png)</small>
                                </label>
                                <div class="premium-upload-box">
                                    <img src="" class="preview-image">
                                    <div class="zImage-inside">
                                      <p>{{__('Drag & drop or Click')}}</p>
                                    </div>
                                    <input type="file" name="thumbnail" accept="image/*" onchange="previewFile(this)">
                                </div>
                            </div>

                            <!-- Ticket Image Upload -->
                            <div>
                                <label class="premium-label">
                                    <i class="fa-solid fa-ticket label-icon"></i>
                                    {{__('Ticket Design')}} <span class="text-required">*</span> <small class="text-muted">(jpg, png)</small>
                                </label>
                                <div class="premium-upload-box">
                                    <img src="" class="preview-image">
                                    <div class="zImage-inside">
                                      <p>{{__('Drag & drop or Click')}}</p>
                                    </div>
                                    <input type="file" name="ticket_image" accept="image/*" onchange="previewFile(this)">
                                </div>
                            </div>

                        </div> <!-- End Grid -->

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-center mt-5">
                            <button type="submit" class="btn-premium-gold">
                                {{__('Publish Event')}}
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>

                    </form>
                </div> <!-- End Card -->

            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('admin/js/event.js') }}"></script>
    <script>
        // Simple script to handle file preview if not already in event.js
        function previewFile(input) {
            var file = input.files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                   var parent = input.closest('.premium-upload-box');
                   var preview = parent.querySelector('.preview-image');
                   var placeholder = parent.querySelector('.zImage-inside');
                   
                   preview.src = reader.result;
                   preview.style.display = 'block';
                   placeholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
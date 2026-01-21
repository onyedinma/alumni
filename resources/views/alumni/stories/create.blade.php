@extends('layouts.app')
@push('title')
    {{$title}}
@endpush

@section('content')
    <style>
        /* Premium Story Create Section */
        .create-story-section {
            background: var(--bg-primary, #0B0E11);
            padding: 40px 0;
            min-height: 100vh;
        }

        /* Premium Card with Gold/Red Glow */
        .premium-story-card {
            background: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        /* Top Border Gradient */
        .premium-story-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
            border-radius: 24px 24px 0 0;
        }

        /* Headings */
        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--gold, #D4AF5A);
            margin-bottom: 30px;
        }

        /* Labels */
        .premium-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary, #E6EAF0);
            margin-bottom: 8px;
        }

        .premium-label .label-icon {
            color: var(--gold, #D4AF5A);
            font-size: 16px;
        }

        .text-required {
            color: var(--maroon, #8B2635);
        }

        /* Input Fields */
        .premium-input {
            background: var(--bg-primary, #0B0E11);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 12px;
            padding: 12px 16px;
            color: var(--text-primary, #E6EAF0);
            font-size: 14px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .premium-input:focus {
            outline: none;
            border-color: var(--gold, #D4AF5A);
            box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.1);
        }

        .premium-input::placeholder {
            color: var(--text-disabled, #5E6675);
        }

        /* Textarea (Summernote override) */
        .note-editor {
            background: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            border-radius: 12px !important;
        }

        .note-editing-area .note-editable {
            background: var(--bg-primary, #0B0E11) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        .note-toolbar {
            background: var(--bg-elevated, #171C23) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        .note-btn {
            background: var(--bg-primary, #0B0E11) !important;
            color: var(--text-primary, #E6EAF0) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
        }

        /* Image Upload Box */
        .zImage-inside {
            background: var(--bg-primary, #0B0E11);
            border: 2px dashed var(--border-dark, #1F2630);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
        }

        .zImage-inside:hover {
            border-color: var(--gold, #D4AF5A);
            background: rgba(212, 175, 90, 0.05);
        }

        .zImage-inside p {
            color: var(--text-secondary, #B4BCC8) !important;
        }

        /* Submit Button */
        .btn-premium-gold {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%);
            color: #000000;
            border: none;
            border-radius: 12px;
            padding: 13px 50px;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(212, 175, 90, 0.3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-premium-gold:hover {
            background: linear-gradient(135deg, #e3c16e 0%, #c4a159 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(212, 175, 90, 0.4);
            color: #000000;
        }

        .text-mime-type {
            color: var(--text-secondary, #B4BCC8);
            font-size: 12px;
        }
    </style>

    <div class="create-story-section">
        <div class="container">
            <h4 class="form-title"><i class="fa-solid fa-pen-nib"
                    style="color: var(--gold, #D4AF5A); margin-right: 12px;"></i>{{$title}}</h4>
            <div class="premium-story-card">
                <form class="ajax reset" data-handler="commonResponseRedirect"
                    data-redirect-url="{{route('stories.my-story')}}" action="{{ route('stories.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="max-w-840">
                        <div class="row rg-25">
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="title" class="premium-label">
                                            <i class="fa-solid fa-heading label-icon"></i>
                                            {{__('Title')}} <span class="text-required">*</span>
                                        </label>
                                        <input type="text" class="premium-input" id="title" name="title"
                                            placeholder="{{ __('Story Title') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="body" class="premium-label">
                                            <i class="fa-solid fa-align-left label-icon"></i>
                                            {{__('Description')}} <span class="text-required">*</span>
                                        </label>
                                        <textarea name="body" class="premium-input min-h-180 summernoteOne" id="body"
                                            placeholder="{{ __('Write your story...') }}" spellcheck="false"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap zImage-upload-details">
                                        <label for="zImageUpload" class="premium-label">
                                            <i class="fa-solid fa-image label-icon"></i>
                                            {{__('Upload Image')}} <span class="text-mime-type">(jpg,jpeg,png)</span> <span
                                                class="text-required">*</span>
                                        </label>

                                        <div class="zImage-inside">
                                            <div class="d-flex justify-content-center pb-12">
                                                <i class="fa-solid fa-cloud-arrow-up"
                                                    style="font-size: 32px; color: var(--gold, #D4AF5A);"></i>
                                            </div>
                                            <p class="fs-15 fw-500 lh-16">
                                                {{__('Drag & drop files here or click to browse')}}</p>
                                            <div class="upload-img-box">
                                                <img src="">
                                                <input type="file" name="thumbnail" accept="image/*"
                                                    onchange="previewFile(this)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-premium-gold mt-30">
                            <i class="fa-solid fa-paper-plane"></i>
                            {{__('Publish Now')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@extends('frontend.layouts.app')
@push('title')
    {{ $title }} - {{ getOption('app_name') }}
@endpush

@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">{{ $title }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-decoration-none">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Excos List Area Start -->
    <div class="excos-area py-5">
        <div class="container">
            <!-- Tenor Selection -->
            @if($tenors->count() > 1)
                <div class="d-flex justify-content-center mb-5">
                    <form action="{{ route('excos') }}" method="GET" class="d-flex align-items-center gap-3">
                        <label class="fw-bold fs-5 text-dark m-0">{{ __('Select Tenor:') }}</label>
                        <select name="tenor_id" class="form-select form-select-lg border-2" onchange="this.form.submit()" style="min-width: 250px;">
                            @foreach($tenors as $tenor)
                                <option value="{{ $tenor->id }}" {{ ($selectedTenor && $selectedTenor->id == $tenor->id) ? 'selected' : '' }}>
                                    {{ $tenor->title }} {{ $tenor->is_current ? ' (Current)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            @endif

            <div class="row g-4 justify-content-center">
                @forelse($excos as $exco)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm text-center alumni-card transition-hover">
                            <div class="card-body p-4 pt-5 relative">
                                <!-- Photo -->
                                <div class="mx-auto mb-4" style="width: 150px; height: 150px; border-radius: 50%; padding: 5px; background: linear-gradient(45deg, #d4af37, #f3e5ab);">
                                    @if($exco->photo)
                                        <img src="{{ asset($exco->photo) }}" class="w-100 h-100 rounded-circle object-fit-cover bg-white" alt="{{ $exco->name }}">
                                    @else
                                        <div class="w-100 h-100 rounded-circle bg-light d-flex align-items-center justify-content-center border border-white border-4">
                                            <i class="bi bi-person text-secondary" style="font-size: 4rem;"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <h4 class="fw-bold mb-1 text-dark">{{ $exco->name }}</h4>
                                <h6 class="text-primary fw-semibold mb-3" style="color: #d4af37 !important;">{{ $exco->position }}</h6>
                                
                                @if($exco->bio)
                                    <p class="text-muted small mb-0 px-2" style="display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;" title="{{ $exco->bio }}">
                                        {{ $exco->bio }}
                                    </p>
                                @endif
                                
                                @if($exco->bio && mb_strlen($exco->bio) > 100)
                                    <button class="btn btn-link btn-sm text-decoration-none p-0 mt-2" style="color: #d4af37;" data-bs-toggle="modal" data-bs-target="#bioModal{{ $exco->id }}">{{ __('Read more') }}</button>
                                    <!-- Bio Modal is rendered outside -->
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-3 text-muted">{{ __('No executives found for the selected tenor.') }}</h4>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Render Modals Outside of the transform cards -->
        @foreach($excos as $exco)
            @if($exco->bio && mb_strlen($exco->bio) > 100)
                <div class="modal fade" id="bioModal{{ $exco->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0 pb-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center pt-0 px-4 pb-4">
                                <div class="mx-auto mb-3" style="width: 100px; height: 100px; border-radius: 50%; padding: 3px; background: linear-gradient(45deg, #d4af37, #f3e5ab);">
                                    @if($exco->photo)
                                        <img src="{{ asset($exco->photo) }}" class="w-100 h-100 rounded-circle object-fit-cover bg-white" alt="{{ $exco->name }}">
                                    @else
                                        <div class="w-100 h-100 rounded-circle bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person text-secondary fs-1"></i>
                                        </div>
                                    @endif
                                </div>
                                <h5 class="fw-bold mb-1">{{ $exco->name }}</h5>
                                <p class="text-primary fw-semibold mb-4" style="color: #d4af37 !important;">{{ $exco->position }}</p>
                                
                                <p class="text-muted text-start" style="line-height: 1.6;">
                                    {!! nl2br(e($exco->bio)) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        
    </div>
    <!-- Excos List Area End -->

    <style>
        .transition-hover {
            transition: all 0.3s ease;
        }
        .alumni-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        }
    </style>
@endsection

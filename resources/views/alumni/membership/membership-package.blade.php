@extends('layouts.app')

@push('title')
	{{$title}}
@endpush

@section('content')
	<style>
		/* Premium Membership Section */
		.premium-membership-section {
			background: var(--bg-primary, #0B0E11);
			padding: 40px 0;
			min-height: 100vh;
		}

		/* Premium Card */
		.premium-card {
			background: var(--bg-surface, #12161C);
			border: 1px solid var(--border-dark, #1F2630);
			border-radius: 24px;
			padding: 40px;
			box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
			position: relative;
		}

		.premium-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 6px;
			background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
			border-radius: 24px 24px 0 0;
		}

		/* Typography */
		.page-title {
			font-family: 'Playfair Display', serif;
			font-size: 28px;
			font-weight: 700;
			color: var(--gold, #D4AF5A);
			margin-bottom: 24px;
			display: flex;
			align-items: center;
			gap: 12px;
		}

		/* Status Banner */
		.status-banner {
			background: var(--bg-elevated, #171C23);
			border: 1px solid var(--border-dark, #1F2630);
			border-radius: 16px;
			padding: 24px;
			display: flex;
			align-items: center;
			gap: 20px;
			margin-bottom: 40px;
		}

		.status-icon {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 24px;
			flex-shrink: 0;
		}

		.status-icon.active {
			background: rgba(15, 169, 88, 0.1);
			color: #0fa958;
			border: 1px solid #0fa958;
		}

		.status-icon.inactive {
			background: rgba(234, 67, 53, 0.1);
			color: #ea4335;
			border: 1px solid #ea4335;
		}

		.status-text h4 {
			color: var(--text-primary, #E6EAF0);
			font-size: 18px;
			font-weight: 600;
			margin-bottom: 8px;
		}

		.status-text h4 span {
			color: var(--gold, #D4AF5A);
		}

		.expire-badge {
			display: inline-block;
			padding: 6px 12px;
			background: var(--bg-primary, #0B0E11);
			border: 1px solid var(--border-dark, #1F2630);
			border-radius: 6px;
			color: var(--text-secondary, #B4BCC8);
			font-size: 13px;
		}

		/* Membership Plan Cards */
		.plan-card {
			background: var(--bg-elevated, #171C23);
			border: 1px solid var(--border-dark, #1F2630);
			border-radius: 16px;
			padding: 30px;
			transition: all 0.3s ease;
			height: 100%;
			display: flex;
			flex-direction: column;
			position: relative;
		}

		.plan-card.active {
			border-color: var(--gold, #D4AF5A);
			background: rgba(212, 175, 90, 0.05);
		}

		.plan-card.active::after {
			content: 'Current Plan';
			position: absolute;
			top: 12px;
			right: 12px;
			background: var(--gold, #D4AF5A);
			color: #000;
			font-size: 11px;
			font-weight: 700;
			padding: 4px 8px;
			border-radius: 4px;
			text-transform: uppercase;
		}

		.plan-card:hover {
			transform: translateY(-5px);
			border-color: var(--gold, #D4AF5A);
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
		}

		.plan-icon {
			width: 70px;
			height: 70px;
			margin-bottom: 20px;
			filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.3));
		}

		.plan-icon img {
			width: 100%;
			height: 100%;
			object-fit: contain;
		}

		.plan-title {
			color: var(--text-primary, #E6EAF0);
			font-family: 'Playfair Display', serif;
			font-size: 22px;
			font-weight: 600;
			margin-bottom: 15px;
		}

		.plan-price {
			color: var(--gold, #D4AF5A);
			font-size: 32px;
			font-weight: 700;
			margin-bottom: 24px;
			display: flex;
			align-items: baseline;
			gap: 4px;
		}

		.plan-duration {
			color: var(--text-secondary, #B4BCC8);
			font-size: 14px;
			font-weight: 400;
		}

		.plan-btn {
			margin-top: auto;
			display: block;
			width: 100%;
			padding: 12px;
			text-align: center;
			background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%);
			color: #000;
			font-weight: 600;
			border-radius: 10px;
			text-decoration: none;
			transition: all 0.3s ease;
		}

		.plan-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
			color: #000;
		}

		.plan-btn.disabled {
			background: var(--bg-primary, #0B0E11);
			color: var(--text-muted, #5E6675);
			border: 1px solid var(--border-dark, #1F2630);
			cursor: default;
			pointer-events: none;
		}
	</style>

	<!-- Page content area start -->
	<div class="premium-membership-section">
		<div class="container">
			<h4 class="page-title"><i class="fa-solid fa-crown"></i> {{$title}}</h4>

			<div class="premium-card">
				<div class="row justify-content-center">
					<div class="col-lg-10">
						<!-- Current Member status -->
						<div class="status-banner">
							@if($user->currentMembership)
								<div class="status-icon active">
									<i class="fa-solid fa-check"></i>
								</div>
							@else
								<div class="status-icon inactive">
									<i class="fa-solid fa-exclamation"></i>
								</div>
							@endif

							<div class="status-text">
								@if($user->currentMembership)
									<h4>{{ __('Currently you are a') }}
										<span>{{ $user->currentMembership->membership->title }}</span> {{ __('Member') }}</h4>
									<span class="expire-badge">
										{{ __('Expires at') }} : {{ $user->currentMembership->expired_date }}
									</span>
								@else
									<h4>{{ __('Currently you have no membership plan') }}</h4>
									<p class="mb-0 text-muted" style="color: var(--text-secondary, #B4BCC8);">
										{{ __('Choose a plan below to unlock exclusive benefits.') }}</p>
								@endif
							</div>
						</div>

						<!-- Membership package -->
						<div class="row rg-30">
							@forelse ($allMembership as $membership)
								<div class="col-lg-4 col-sm-6">
									<div
										class="plan-card {{ ($user->currentMembership && $user->currentMembership->membership_id == $membership->id) ? 'active' : '' }}">
										<div class="plan-icon">
											<img src="{{getFileUrl($membership->badge)}}" alt="">
										</div>

										<h4 class="plan-title">{{$membership->title}}</h4>

										<div class="plan-price">
											{{showPrice($membership->price)}}
											<span class="plan-duration">/ {{$membership->duration}}
												{{getDurationType($membership->duration_type)}}</span>
										</div>

										@if($user->currentMembership && $user->currentMembership->membership_id == $membership->id)
											<button class="plan-btn disabled">{{ __('Current Plan') }}</button>
										@else
											<a href="{{ route('checkout', ['type' => 'membership', 'slug' => $membership->slug]) }}"
												class="plan-btn">{{__('Get Membership')}}</a>
										@endif
									</div>
								</div>
							@empty
								<div class="col-12 text-center py-5">
									<i class="fa-solid fa-box-open"
										style="font-size: 48px; color: var(--text-muted, #5E6675); margin-bottom: 20px;"></i>
									<p style="color: var(--text-secondary, #B4BCC8);">{{ __('No Membership Plans Found') }}</p>
								</div>
							@endforelse
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page content area end -->

@endsection
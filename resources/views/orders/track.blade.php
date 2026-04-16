@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- Back Button - Ab ye sahi route par le jayega --}}
           

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Track Order #ORD-{{ $order->id }}</h5>
                            <small class="text-muted">Placed on: {{ $order->created_at->format('d M, Y') }}</small>
                        </div>
                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 text-uppercase" style="letter-spacing: 1px;">
                            <i class="fas fa-circle me-1" style="font-size: 8px;"></i> {{ $order->status }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Tracking Progress Bar --}}
                    <div class="track-container mb-5">
                        <div class="steps d-flex justify-content-between">
                            @php
                                $statusList = ['pending', 'processing', 'shipped', 'delivered'];
                                $currentStatus = strtolower($order->status);
                                $currentIdx = array_search($currentStatus, $statusList);
                            @endphp

                            @foreach($statusList as $index => $step)
                                <div class="step-item text-center {{ $index <= $currentIdx ? 'active' : '' }}">
                                    <div class="step-icon shadow-sm mb-2">
                                        <i class="fas {{ $step == 'pending' ? 'fa-shopping-basket' : ($step == 'processing' ? 'fa-cogs' : ($step == 'shipped' ? 'fa-truck' : 'fa-check-double')) }}"></i>
                                    </div>
                                    <p class="small fw-bold text-uppercase mb-0">{{ $step }}</p>
                                    @if($index <= $currentIdx)
                                        <small class="text-muted d-block" style="font-size: 10px;">{{ $order->updated_at->format('d M') }}</small>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="progress-line">
                            <div class="line-fill" style="width: {{ ($currentIdx / 3) * 100 }}%"></div>
                        </div>
                    </div>

                    <div class="row g-4">
                        {{-- Courier / Delivery Boy Info --}}
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 border h-100 shadow-sm">
                                <h6 class="fw-bold mb-3 d-flex align-items-center text-dark border-bottom pb-2">
                                    <i class="fas fa-truck-loading me-2 text-success"></i> Delivery Partner
                                </h6>
                                
                                @if($order->courier_name)
                                    <div class="d-flex align-items-center mb-4 mt-3">
                                        <div class="bg-white p-3 rounded-circle shadow-sm me-3 border border-success border-2">
                                            <i class="fas fa-user-tie fa-2x text-dark"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">Delivery Agent Name</p>
                                            <h6 class="fw-bold mb-0 text-dark text-capitalize fs-5">{{ $order->courier_name }}</h6>
                                        </div>
                                    </div>

                                    <div class="bg-white p-3 rounded-3 border mb-3">
                                        <p class="mb-1 small text-muted">Direct Mobile Number:</p>
                                        <h6 class="fw-bold mb-0 text-primary fs-5">{{ $order->courier_phone }}</h6>
                                    </div>

                                    <a href="tel:{{ $order->courier_phone }}" class="btn btn-dark w-100 rounded-pill py-2 shadow-sm fw-bold">
                                        <i class="fas fa-phone-alt me-2"></i> Call to Coordinate
                                    </a>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-box-open fa-3x text-muted opacity-25 mb-3"></i>
                                        <p class="text-muted small mb-0 fw-bold uppercase">Preparing your order</p>
                                        <p class="text-muted small">Tracking info will update soon.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- OTP & Address Section --}}
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 border h-100 shadow-sm">
                                <h6 class="fw-bold mb-3 d-flex align-items-center text-dark border-bottom pb-2">
                                    <i class="fas fa-shield-check me-2 text-primary"></i> Verification Details
                                </h6>
                                
                                {{-- OTP DISPLAY BOX --}}
                                <div class="p-4 bg-white rounded-4 border border-primary border-dashed text-center mb-4 mt-2">
                                    <p class="text-muted small mb-2 text-uppercase fw-bold ls-1">Delivery Confirmation OTP</p>
                                    @if($order->status == 'delivered')
                                        <h2 class="fw-bold text-success mb-0"><i class="fas fa-check-circle me-2"></i>Verified</h2>
                                        <small class="text-muted">Order delivered successfully</small>
                                    @else
                                        <h1 class="fw-bold text-primary mb-0" style="letter-spacing: 8px; font-size: 2.5rem;">
                                            {{ $order->delivery_otp ?? '----' }}
                                        </h1>
                                        <p class="text-danger small mt-2 mb-0">
                                            <i class="fas fa-info-circle me-1"></i> Share this with delivery boy only.
                                        </p>
                                    @endif
                                </div>

                                <div class="p-3 bg-white rounded-3 border">
                                    <h6 class="fw-bold small mb-2"><i class="fas fa-map-marker-alt text-danger me-1"></i> Shipping Address</h6>
                                    <p class="small text-muted mb-0 lh-base">
                                        {{ $order->address }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .track-container { position: relative; padding: 20px 0; }
    .steps { position: relative; z-index: 2; }
    .step-item { width: 25%; position: relative; }
    .step-icon {
        width: 55px; height: 55px; background: #fff; border: 2px solid #e9ecef;
        border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;
        color: #adb5bd; transition: 0.3s;
    }
    .step-item.active .step-icon { background: #198754; color: #fff; border-color: #198754; box-shadow: 0 4px 10px rgba(25, 135, 84, 0.2); }
    .step-item.active p { color: #198754; font-weight: 700; }
    .progress-line {
        position: absolute; top: 48px; left: 12%; width: 76%; height: 5px;
        background: #e9ecef; z-index: 1; border-radius: 10px;
    }
    .line-fill { height: 100%; background: #198754; transition: 1s ease; border-radius: 10px; }
    .border-dashed { border-style: dashed !important; border-width: 2px !important; }
    .ls-1 { letter-spacing: 1px; }
</style>
@endsection
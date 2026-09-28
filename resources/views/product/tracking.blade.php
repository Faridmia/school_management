@extends('layouts.app')

@section('style')
<style>
    .track-timeline {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 40px 0 20px 0;
        position: relative;
    }
    .track-timeline::before {
        content: '';
        position: absolute;
        top: 22px;
        left: 5%;
        right: 5%;
        height: 4px;
        background-color: #e0e0e0;
        z-index: 1;
    }
    /* Stepper connector colors based on progress */
    .track-timeline.step-1::before {
        background: linear-gradient(to right, #28a745 0%, #e0e0e0 0%);
    }
    .track-timeline.step-2::before {
        background: linear-gradient(to right, #28a745 33%, #e0e0e0 33%);
    }
    .track-timeline.step-3::before {
        background: linear-gradient(to right, #28a745 66%, #e0e0e0 66%);
    }
    .track-timeline.step-4::before {
        background: linear-gradient(to right, #28a745 100%, #28a745 100%);
    }
    .track-step {
        z-index: 2;
        text-align: center;
        width: 25%;
        position: relative;
    }
    .track-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: #e0e0e0;
        color: #fff;
        line-height: 44px;
        text-align: center;
        margin: 0 auto 10px auto;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .track-step.active .track-icon {
        background-color: #c96; /* Theme Primary Gold */
        box-shadow: 0 0 0 4px rgba(201, 150, 96, 0.2);
    }
    .track-step.completed .track-icon {
        background-color: #28a745; /* Success Green */
    }
    .track-label {
        font-size: 1.3rem;
        font-weight: 600;
        color: #777;
    }
    .track-step.active .track-label {
        color: #c96;
        font-weight: bold;
    }
    .track-step.completed .track-label {
        color: #28a745;
    }
</style>
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Order Tracking<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Track Order</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content text-start">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Tracking form -->
                    <div class="card p-5 mb-5 shadow-sm border-0">
                        <h3 class="card-title text-center mb-4">Track Live Order Status</h3>
                        <form action="{{ route('order.track.post') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="order_number">Order Number <span class="text-danger">*</span></label>
                                    <input type="text" name="order_number" id="order_number" value="{{ old('order_number', $order->order_number ?? '') }}" class="form-control" placeholder="e.g. ORD-20260824-1234" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="billing_email">Billing Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="billing_email" id="billing_email" value="{{ old('billing_email', $order->billing_email ?? '') }}" class="form-control" placeholder="e.g. customer@example.com" required>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-round min-width-sm">
                                    <span>TRACK ORDER</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    @if(isset($order))
                        <!-- Tracking Timeline Results -->
                        <div class="card p-5 shadow-sm border-0">
                            <h3 class="card-title text-start mb-4">Order #{{ $order->order_number }} Summary</h3>
                            
                            @php
                                $status = $order->status;
                                $step = 1; // Default placed
                                if ($status == 'processing') {
                                    $step = 2;
                                } elseif ($status == 'on-hold') {
                                    $step = 3;
                                } elseif ($status == 'completed') {
                                    $step = 4;
                                }
                            @endphp

                             @if(in_array($status, ['cancelled', 'refunded', 'failed']))
                                <div class="text-center p-4 mb-4" style="background-color: #fdf2f2; border: 1px solid #fde8e8; border-radius: 6px;">
                                    <h4 class="mb-2" style="color: #c53030; font-weight: bold;"><i class="icon-warning-sign"></i> Order Status: {{ strtoupper($status) }}</h4>
                                    <p class="mb-0" style="color: #9b2c2c; font-size: 1.3rem;">This order is currently inactive and cannot be tracked further. For assistance, contact support.</p>
                                </div>
                            @else
                                <div class="track-timeline step-{{ $step }}">
                                    <!-- Step 1 -->
                                    <div class="track-step {{ $step >= 1 ? ($step == 1 ? 'active' : 'completed') : '' }}">
                                        <div class="track-icon">
                                            @if($step > 1) <i class="icon-check"></i> @else 1 @endif
                                        </div>
                                        <div class="track-label">Placed</div>
                                    </div>
                                    <!-- Step 2 -->
                                    <div class="track-step {{ $step >= 2 ? ($step == 2 ? 'active' : 'completed') : '' }}">
                                        <div class="track-icon">
                                            @if($step > 2) <i class="icon-check"></i> @else 2 @endif
                                        </div>
                                        <div class="track-label">Confirmed</div>
                                    </div>
                                    <!-- Step 3 -->
                                    <div class="track-step {{ $step >= 3 ? ($step == 3 ? 'active' : 'completed') : '' }}">
                                        <div class="track-icon">
                                            @if($step > 3) <i class="icon-check"></i> @else 3 @endif
                                        </div>
                                        <div class="track-label">Shipped</div>
                                    </div>
                                    <!-- Step 4 -->
                                    <div class="track-step {{ $step >= 4 ? ($step == 4 ? 'active' : 'completed') : '' }}">
                                        <div class="track-icon">
                                            @if($step > 4) <i class="icon-check"></i> @else 4 @endif
                                        </div>
                                        <div class="track-label">Delivered</div>
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5>Billing Address</h5>
                                    <p>
                                        {{ $order->billing_first_name }} {{ $order->billing_last_name }}<br>
                                        {{ $order->billing_address_1 }}<br>
                                        Postcode: {{ $order->billing_postcode }}<br>
                                        Phone: {{ $order->billing_phone }}
                                    </p>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <h5>Order Info</h5>
                                    <p>
                                        <strong>Date:</strong> {{ date('d-m-Y', strtotime($order->created_at)) }}<br>
                                        <strong>Total:</strong> ${{ number_format($order->total, 2) }}<br>
                                        <strong>Payment:</strong> {{ strtoupper($order->payment_method) }}
                                    </p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5>Items Ordered</h5>
                            <table class="table table-clean">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                <a href="{{ url($item->product->slug ?? '#') }}">{{ $item->product_name }}</a>
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-right">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

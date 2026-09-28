@extends('layouts.app')

@section('style')
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Request Return/Refund<span>User Dashboard</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Return Item</li>
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

                    <div class="card p-5 shadow-sm border-0">
                        <h3 class="card-title mb-4">Submit Return Request</h3>
                        
                        <!-- Product Details Summary -->
                        <div class="row mb-4 p-3 bg-light rounded">
                            <div class="col-md-8">
                                <h5>Product Details</h5>
                                <p class="mb-1"><strong>Name:</strong> {{ $item->product_name }}</p>
                                @php
                                    $attributes = [];
                                    if(!empty($item->size)) {
                                        $attributes[] = 'Size: ' . $item->size->name;
                                    }
                                    if(!empty($item->color)) {
                                        $attributes[] = 'Color: ' . $item->color->name;
                                    }
                                @endphp
                                @if(count($attributes) > 0)
                                    <p class="mb-1 text-muted"><strong>Attributes:</strong> {{ implode(' | ', $attributes) }}</p>
                                @endif
                                <p class="mb-0"><strong>Purchased Qty:</strong> {{ $item->quantity }} | <strong>Price:</strong> ${{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="col-md-4 text-md-right mt-2 mt-md-0">
                                <h5>Order Ref</h5>
                                <p class="mb-0"><strong>#{{ $order->order_number }}</strong></p>
                                <p class="text-muted" style="font-size: 1.2rem;">{{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                            </div>
                        </div>

                        <!-- Return Submission Form -->
                        <form action="{{ route('user.orders.return.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_item_id" value="{{ $item->id }}">

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="qty">Quantity to Return <span class="text-danger">*</span></label>
                                    <select name="qty" id="qty" class="form-control" required>
                                        @for($q = 1; $q <= $item->quantity; $q++)
                                            <option value="{{ $q }}">{{ $q }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="reason">Reason for Return <span class="text-danger">*</span></label>
                                    <select name="reason" id="reason" class="form-control" required>
                                        <option value="">Select a reason</option>
                                        <option value="Damaged/Defective">Product is damaged or defective</option>
                                        <option value="Incorrect Item">Received wrong item / wrong size</option>
                                        <option value="Not as Described">Doesn't match website description</option>
                                        <option value="Changed Mind">No longer wanted / changed mind</option>
                                        <option value="Other">Other (Please describe below)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="comment">Additional Comments / Details</label>
                                <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Write additional comments about the issue..."></textarea>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-round min-width-sm">
                                    <span>SUBMIT RETURN REQUEST</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                                <a href="{{ route('user.orders') }}" class="btn btn-outline-dark btn-round min-width-sm ml-3">Cancel</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

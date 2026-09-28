@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')

<div class="content-wrapper text-start">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Return & Refund Requests</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                @include('admin.layouts._message')

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">All Customer Returns</h3>
                    </div>
                    
                    <div class="card-body p-0">
                        <table class="table table-striped" role="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Info</th>
                                    <th>Customer</th>
                                    <th>Product Details</th>
                                    <th>Qty</th>
                                    <th>Reason / Comment</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Refund</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($returns as $return)
                                    <tr>
                                        <td>{{ $return->id }}</td>
                                        <td>
                                            <strong>#{{ $return->order->order_number }}</strong>
                                        </td>
                                        <td>
                                            {{ $return->user->name }}<br>
                                            <small class="text-muted">{{ $return->user->email }}</small>
                                        </td>
                                        <td>
                                            {{ $return->item->product_name ?? 'N/A' }}
                                            @php
                                                $attributes = [];
                                                if($return->item && !empty($return->item->size)) {
                                                    $attributes[] = 'Size: ' . $return->item->size->name;
                                                }
                                                if($return->item && !empty($return->item->color)) {
                                                    $attributes[] = 'Color: ' . $return->item->color->name;
                                                }
                                            @endphp
                                            @if(count($attributes) > 0)
                                                <br><small class="text-muted">({{ implode(', ', $attributes) }})</small>
                                            @endif
                                        </td>
                                        <td>{{ $return->qty }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $return->reason }}</span>
                                            @if(!empty($return->comment))
                                                <br><small class="text-muted">{{ $return->comment }}</small>
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($return->created_at)) }}</td>
                                        <td>
                                            @if($return->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($return->status == 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($return->refund_status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @else
                                                <span class="badge bg-success">Refunded</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($return->status == 'pending')
                                                <a href="{{ route('admin.returns.approve', $return->id) }}" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to approve this return? This will refund the amount and restore the stock quantity.')">Approve</a>
                                                <a href="{{ route('admin.returns.reject', $return->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this return request?')">Reject</a>
                                            @else
                                                <span class="text-muted">Processed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center p-4">No return requests found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {!! $returns->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

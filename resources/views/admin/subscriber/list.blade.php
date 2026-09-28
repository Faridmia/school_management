@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')

<div class="content-wrapper text-start">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Newsletter Subscribers</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                @include('admin.layouts._message')

                <!-- Search form -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Search Subscribers</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-9 mb-2">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Email" value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <button type="submit" class="btn btn-primary w-100">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Subscriber List</h3>
                    </div>
                    
                    <div class="card-body p-0">
                        <table class="table table-striped" role="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date Subscribed</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subscribers as $subscriber)
                                    <tr>
                                        <td>{{ $subscriber->id }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>
                                            @if($subscriber->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Unsubscribed</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y h:i A', strtotime($subscriber->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('admin.subscriber.delete', $subscriber->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this subscriber?')">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center p-4">No subscribers found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {!! $subscribers->appends(request()->except('page'))->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

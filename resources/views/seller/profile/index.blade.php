@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Seller Profile</h3>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <strong>Name:</strong> {{ auth()->user()->name }}
                    </div>

                    <div class="mb-3">
                        <strong>Email:</strong> {{ auth()->user()->email }}
                    </div>

                    <div class="mb-3">
                        <strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}
                    </div>

                    <a href="{{ route('seller.profile.change-password') }}" class="btn btn-primary">
                        Change Password
                    </a>

               <!-- Instead of route('seller.dashboard') -->
<a href="{{ route('seller.home') }}">Dashboard</a>
                        Back to Dashboard
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@extends('admin.adminlayouts.app')
@section('title')
Admin Dashboard
@endsection
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h2 class="font-weight-bold">{{ __('Admin Dashboard') }}</h2>
                    </div>

                    <div class="card-body">
                        <h4>Admin Dashboard Page</h4>

                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <a href="{{ route('admin.logout') }}" class="btn btn-link"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

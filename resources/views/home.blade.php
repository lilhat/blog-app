@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <br><br>
                    {{ __('Redirecting to home page...') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Wait for 3 seconds (3000 milliseconds)
    setTimeout(function() {
        // Redirect to the homepage
        window.location.href = "/";
    }, 2000);
</script>

@endsection

@extends('admin.layouts.auth')

@section('content')

{{-- <div class="text-center mt-4">
    <h1 class="h2">Welcome Back</h1>
    <p class="lead">
        Sign in to {{env('APP_NAME')}} admin
    </p>
</div> --}}

<div class="card">
    <div class="card-body">
        <div class="m-sm-4">          
            <div class="text-center"><h3>Sign in to {{env('APP_NAME')}} admin</h3></div>
            <form action="" method="post">
                @include('includes.message')
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control form-control-lg" type="text" name="username"
                        placeholder="Enter your username" value="{{old('username')}}" />
                    @error('username')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control form-control-lg" type="password" name="password"
                        placeholder="Enter your password" />
                    @error('password')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label class="form-check">
                        <input class="form-check-input" type="checkbox" value="remember-me"
                            name="remember" checked>
                        <span class="form-check-label">
                            Remember me next time
                        </span>
                    </label>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection
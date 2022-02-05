@extends('admin.layouts.main')

@section('custom_css')

@endsection

@section('content')
<h1 class="h3 mb-3">Change Password</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Password info</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            @include('includes.message')
                            <div class="mb-3">
                                <label class="form-label" for="">Current Password</label>
                                <input type="password" class="form-control" placeholder="current password" name="current_password">
                                @error('current_password')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="">New Password</label>
                                <input type="password" class="form-control" placeholder="new password" name="password">
                                @error('password')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="confirm password" name="password_confirmation">
                                @error('password_confirmation')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                       
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')

@endsection

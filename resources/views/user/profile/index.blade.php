@extends('user.layouts.main')

@section('custom_css')

@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Public info</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    
                    @csrf

                    @include('includes.message')

                    <div class="row">
                        
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="">First Name</label>
                                <input type="text" class="form-control" placeholder="first name" name="first_name" value="{{!empty(old('first_name'))?old('first_name'):Auth::user()->first_name}}">
                                @error('first_name')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="">Last Name</label>
                                <input type="text" class="form-control" placeholder="last name" name="last_name" value="{{!empty(old('last_name'))?old('last_name'):Auth::user()->last_name}}">
                                @error('last_name')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Email Address</label>
                        <input type="text" class="form-control" placeholder="email" value="{{Auth::user()->email}}" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary float-end">Save changes</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')

@endsection

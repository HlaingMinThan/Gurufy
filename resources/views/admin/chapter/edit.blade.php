@extends('admin.layouts.main')

@section('custom_css')

@endsection

@section('content')
<h1 class="h3 mb-3">Chapter</h1>

<div class="row">
	<div class="col-8">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">
	                Update Chapter
	                <a href="{{route('admin-chapter-list', ['subject_id' => $item->subject_id])}}" class="float-end btn btn-outline-warning btn-sm">Chapter List</a>
	            </h5>
            </div>
            <div class="card-body">
                <form action="" method="post">

                	<!-- @include('includes.message') -->

                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="">Name</label>
                        <input type="text" class="form-control" placeholder="name" name="name" value="{{$item->name}}">
                        @error('name')
                            <small class="text-danger mt-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 d-grid">
                    	<button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')

@endsection

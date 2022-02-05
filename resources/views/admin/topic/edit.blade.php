@extends('admin.layouts.main')

@section('custom_css')

@endsection

@section('content')
<h1 class="h3 mb-3">Topic</h1>

<div class="row">
	<div class="col-8">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">
	                Update Topic
	                <a href="{{route('admin-topic-list', ['chapter_id' => $item->chapter_id])}}" class="float-end btn btn-outline-warning btn-sm">Topic List</a>
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

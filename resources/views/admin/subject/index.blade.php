@extends('admin.layouts.main')

@section('custom_css')

@endsection

@section('content')
<h1 class="h3 mb-3">Subject</h1>

<div class="row">
	<div class="col-9">
		<div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    All Subjects of Standard <strong>{{$standard->name}}</strong>
                    <a href="{{route('admin-standard-list')}}" class="float-end btn btn-sm btn-outline-warning">Back to Standard Management</a>
                </h5>

            </div>

            <div class="card-body">
            	<table class="table">
            		<thead>
            			<tr>
            				<th>SN</th>
            				<th>Name</th>
            				<th>Created At</th>
            				<th>Status</th>
            				<th>Action</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php foreach ($items as $key => $value): ?>

            				<tr>
	            				<td>{{$key+1}}</td>
	            				<td>{{$value->name}}</td>
	            				<td>{{$value->createdAt()}}</td>
	            				<td>{!! $value->statusName() !!}</td>
	            				<td>
	            					
	            					<a href="{{route('admin-subject-edit', ['id' => $value->id])}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
	            					<a href="{{route('admin-chapter-list', ['subject_id' => $value->id])}}" class="btn btn-info"><i class="fa fa-cog"></i></a>
	            					<a href="{{route('admin-subject-destroy', ['id' => $value->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
	            				</td>
	            			</tr>
            				
            			<?php endforeach ?>
            		</tbody>
            	</table>
            </div>

        </div>
	</div>
    <div class="col-3">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Add New Subject </h5>
            </div>
            <div class="card-body">
                <form action="" method="post">

                	<!-- @include('includes.message') -->

                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="">Name</label>
                        <input type="text" class="form-control" placeholder="name" name="name" value="{{!empty(old('name'))?old('name'):Auth::guard('admin')->user()->name}}">
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

@extends('admin.layouts.main')

@section('custom_css')

@endsection

@section('content')
<h1 class="h3 mb-3">Question List</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">All Questions</h5>
            </div>
            <div class="card-body">
                

                <div class="table-responsive mt-5">
                    <table class="table" id="data-table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Question Title</th>
                                <th>Standard</th>
                                <th>Subject</th>
                                <th>Chapter</th>
                                <th>Topic</th>
                                <!-- <th>Question Type</th> -->
                                <th>Level</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th style="min-width: 53px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $key => $value): ?>
                                <tr>
                                    <!-- <td>{{$key+1}}</td> -->
                                    <td>{{$value->serial}}</td>
                                    <td>{!! $value->title !!}</td>
                                    <td>{{ $value->topic->chapter->subject->standard->name }}</td>
                                    <td>{{ $value->topic->chapter->subject->name }}</td>
                                    <td>{{ $value->topic->chapter->name }}</td>
                                    <td>{{ $value->topic->name }}</td>
                                    <!-- <td>{!! $value->typeName() !!}</td> -->
                                    <td>{{$value->level}}</td>
                                    <td>{!! $value->statusName() !!}</td>
                                    <td>{!! $value->createdAt() !!}</td>
                                    <td>
                                        <a href="{{route('admin-question-edit', ['question_id' => $value->id])}}" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('admin-question-destroy', ['id' => $value->id])}}" class="btn btn-sm btn-outline-danger delete-button-new"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                            <?php if (count($items) == 0): ?>

                        <tr>
                            <td colspan="7" class="text-center">No data found</td>
                        </tr>
                                                
                    <?php endif ?>                        
                        
                    </tbody>
                </table>

                {{$items->links()}}
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')

@endsection

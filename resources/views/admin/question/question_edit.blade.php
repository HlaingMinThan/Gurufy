@extends('admin.layouts.main')

@section('custom_css')

@endsection

@section('content')
<h1 class="h3 mb-3">Question</h1>

<div class="row" id="question">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Edit Question</h5>
            </div>
            <div class="card-body">
                <form id="questionCreate" action="{{ url('/admin/question-edit/'. $question_details->id) }}" method="post" enctype="multipart/form-data">
                    
                    @csrf
                    <div class="row">
                        <div class="col-md-12">

                            @include('includes.message')

                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <label class="form-label" for="">Standard</label>
                                    <select class="form-control" id="standard" v-model="standard" v-on:change="subjects = standard.subjects; chapters = []; topics = []">
                                        <option :value="item" v-for="(item, index) in standards">@{{item.name}}</option>
                                    </select>
                                </div>

                                <div class="col-md-3" v-if="subjects.length > 0">
                                    <label class="form-label" for="">Subject</label>
                                    <select class="form-control" id="subject" v-model="subject" v-on:change="chapters = subject.chapters; topics = [];">
                                        <option :value="item" v-for="(item, index) in subjects">@{{item.name}}</option>
                                    </select>
                                </div>

                                <div class="col-md-3" v-if="chapters.length > 0">
                                    <label class="form-label" for="">Chapter</label>
                                    <select class="form-control" id="chapter" v-model="chapter" v-on:change="topics = chapter.topics">
                                        <option :value="item" v-for="(item, index) in chapters">@{{item.name}}</option>
                                    </select>
                                </div>

                                <div class="col-md-3" v-if="topics.length > 0">
                                    <label class="form-label" for="">Topic</label>
                                    <select class="form-control" id="topic" name="topic" v-model="topic">
                                        <option :value="item.id" v-for="(item, index) in topics">@{{item.name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" for="">Type</label>
                                    <select class="form-control" id="type" name="type">
                                         @if($question_details->question_type == "1") <option value="1" >MCQ</option> @endif
                                         @if($question_details->question_type == "2") <option value="2" >Fill in the blank</option> @endif
                                         @if($question_details->question_type == "3") <option value="3" >Matching</option> @endif
                                         @if($question_details->question_type == "4") <option value="4" >Formula Rendering</option> @endif
                                         @if($question_details->question_type == "5") <option value="5" >Arranging Statements</option> @endif
                                         @if($question_details->question_type == "6") <option value="6" >Descriptive</option> @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row" id="title_content">
                                <div class="col">
                                    <label class="form-label" for="">Title</label>
                                    <textarea name="title" id="title" class="form-control" rows="5" cols="80">
                                        {{!empty(old('title')) ? old('title') : $question_details->title}}
                                    </textarea>
                                    <?php 
                                        $options = json_decode($question_details->options); 
                                        $answers = json_decode($question_details->correct_answer); 
                                        // echo $options[0]->{'0'}; exit;
                                        $option_count = count($options);
                                        // if(in_array("Rich Food", $answers)){
                                        //     echo "yes";
                                        // }
                                    ?>
                                    @error('title')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            
                            @if($question_details->question_type == "4") 
                            <div class="row mt-2" id="image_div_content">
                                <div class="col">
                                    <?php
                                        $image = $question_details->question_file ? $question_details->question_file : '#';
                                    ?>
                                    <img id="blah" src="@if($question_details->question_file){{asset('/question_images/'.$question_details->question_file)}}@else # @endif " alt="Question Image" style="max-width: 280px;"/><br />
                                    <label class="form-label" for="">Upload Image</label>                                    
                                    <input class="form-control" type="file" name="question_image" id="question_image" onchange="readURL(this);" />
                                </div>
                            </div>
                            @endif

                            @if($question_details->question_type == "1" || $question_details->question_type == "2" || $question_details->question_type == "4" ||
                            $question_details->question_type == "5")
                            <div class="row mt-2" id="option_content">
                                @foreach($options as $key=>$option)
                                <label class="form-label" for="">Option</label>
                                <div class="row">
                                    <div class="col-10">
                                        
                                        <textarea class="form-control ml-2 option_values existing_option" name="option_value[]" >{{ $option }}</textarea>
                                        
                                    </div>
                                    <div class="col-2" style="display: block; position: relative;">
                                        
                                        <input type="checkbox" class="checkbox_option" name="correct_answer[]" value="{{ $key }}" @if($question_details->question_type == "1") style="display:inline;" @else style="display:none;" @endif  @if(in_array($option, $answers)) checked="checked" @endif/>
                                        <label class="form-label checkbox_option" for="" @if($question_details->question_type == "1") style="display:inline" @else style="display:none" @endif>Correct Answer</label>
                                        
                                        <!-- @if($key == 0)
                                        <span id="add_more_option">+</span>
                                        @else
                                        <span class="remove_option" data-index="">-</span>
                                        @endif -->
                                    </div>
                                </div>  
                                @endforeach  
                            </div>
                            @endif
                            
                            @if($question_details->question_type == "3")
                            <div class="row mt-2" id="option_content_matching">                               
                                @foreach($options as $key => $option)
                                <div class="row">
                                    <div class="col-1 mt-1" style="text-align: right;">
                                        <label class="form-label" for="">Left</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control ml-2 option_value_left" name="option_value_left[]" value="{{ $option->left }}">
                                    </div>
                                    <div class="col-1 mt-1" style="text-align: right;">
                                        <label class="form-label" for="">Right</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control ml-2 option_value_right" name="option_value_right[]" value="{{ $option->right }}">
                                    </div>
                                    <div class="col-2" style="display: inline; position: relative;">
                                        @if($key == 0)
                                        <span id="add_more_option_matching">+</span>
                                        @else
                                        <span class="remove_option_matching">-</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            
                            @if($question_details->question_type == "2" ||$question_details->question_type == "3" || $question_details->question_type == "4" || $question_details->question_type == "5") 
                            <div class="row mt-2" id="sequence_content">                                
                                <div class="col">
                                    Old Answer Sequence: 
                                    @foreach($answers as $answer)
                                        <span style="background-color: lightgrey;padding: 3px 5px;">{{ $answer }}</span>
                                    @endforeach
                                    <br />
                                    <label class="form-label" for="">Answer Sequence</label>                                    
                                    <select class="sequence_answer col-12" id="sequence_answer" name="sequence_answer[]" multiple="multiple">
                                        <?php print_r($options);?>    
                                            @foreach($options as $option)
                                                <option value=@if($question_details->question_type == "3"){{ $option->right }} @else {{ $option }} @endif>@if($question_details->question_type == "3"){{ $option->right }} @else {{ $option }} @endif</option>
                                            @endforeach
                                    </select>
                                </div>                                
                            </div>
                            @endif


                             <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" for="">Explanation to correct answer</label>
                                    <textarea class="form-control" name="explanation" class="explanation" id="explanation">{{$question_details->explanation}}</textarea>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" for="">Level</label>
                                    <select class="form-control" name="level">
                                        @for($i = 1; $i < 13; $i++)
                                            <option value="{{$i}}" @if($question_details->level == $i) selected="selected" @endif>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" for="">Serial</label>
                                    <input class="form-control" name="serial" class="serial" id="serial" value="{{$question_details->serial}}">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" for="">Status</label>
                                    <select class="form-control" name="status" name="level">                   
                                        <option value="1" @if($question_details->status == 1) selected="selected" @endif >Active</option>
                                        <option value="0" @if($question_details->status == 0) selected="selected" @endif >Inactive</option>                                       
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>

                    <button type="submit" id="submitBtn" class="btn btn-primary mt-3">Save changes</button>
                    
                </form>

                <!-- Just for copy from and hidden -->
                <div id="copy_option" style="display: none;">
                    <label class="form-label option_label" for="">Option</label>
                    <div class="row">
                        <div class="col-10">
                            <textarea class="option form-control ml-2 option_values" name="option_value[]"></textarea>
                        </div>
                        <div class="col-2" style="display: block; position: relative;">
                            <input type="checkbox" class="checkbox_option" name="correct_answer[]" value="option1" style="margin-top: 10px;" />
                            <label class="form-label checkbox_option" for="" @if($question_details->question_type == "1") style="display:inline" @else style="display:none" @endif>Correct Answer</label>
                            <span class="remove_option" data-index="">-</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-2" id="copy_option_matching" style="display: none;">
                    <div class="row">
                        <div class="col-1 mt-1" style="text-align: right;">
                            <label class="form-label left_option" for="">Left 1</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control ml-2 option_value_left" name="option_value_left[]">
                        </div>
                        <div class="col-1 mt-1" style="text-align: right;">
                            <label class="form-label right_option" for="">Right 1</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control ml-2 option_value_right" name="option_value_right[]">
                        </div>
                        <div class="col-2" style="display: block; position: relative;">
                            <span class="remove_option_matching">-</span>
                        </div>
                    </div>
                </div>
                
                <!-- end for copy -->


            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="/ckeditor/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

    let Question = new Vue({
        el: '#question',
        data: {
            questionDetails : <?php echo $question_details->toJson();?>,
            standards: <?php echo $items;?>,
            subjects: [],
            chapters: [],
            topics: [],
            standard: null,
            subject: null,
            chapter: null,
            topic: null
        },
        mounted(){
            let that = this;

            // that.standard = that.standards[0];
            that.standards.forEach(function(item){
                if(item.id == that.questionDetails.topic.chapter.subject.standard_id){
                    that.standard = item;
                }
            })
            

            that.subjects = that.standard.subjects;
            // that.subject = that.subjects[0];
            that.subjects.forEach(function(item){
                if(item.id == that.questionDetails.topic.chapter.subject_id){
                    that.subject = item;
                }
            })


            that.chapters = that.subject.chapters;
            that.chapters.forEach(function(item){
                if(item.id == that.questionDetails.topic.chapter_id){
                    that.chapter = item;
                }
            })
            // that.chapter = that.chapters[0];
            that.topics = that.chapter.topics;
            that.topics.forEach(function(item){
                if(item.id == that.questionDetails.topic_id){
                    that.topic = item.id;
                }
            })
            // that.topic = this.topics[0].id;
        }
    });



    // let sequence_answer_values=[];
    // let old_sequence_answer = [<?php echo '"'.implode('","', $answers).'"' ?>];
    // let initialOptionValue = "{{ $option_count }}";
    // console.log('option count: ', initialOptionValue);

    //console.log(initialOptionValue);
    //console.log('old answers', old_sequence_answer);
    // let sequence_answer_values_left=[];
    // let sequence_answer_values_right=[];

    CKEDITOR.replace( 'title', {
        filebrowserUploadUrl: "{{route('admin-question-image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        height: '110px'
    });

    CKEDITOR.replace( 'explanation', {
        filebrowserUploadUrl: "{{route('admin-question-image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        height: '110px'
    });

    let option = 1;

    $('.existing_option').each(function(){
        let idName = 'option'+(option+1);
        option++;
        $(this).attr('id', idName);
        console.log(idName);
        makeAnserCkeditor(idName);
    })

    function makeAnserCkeditor(id) {
        CKEDITOR.replace( id, {
            filebrowserUploadUrl: "{{route('admin-question-image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            height: '50px'
        });
    }

    $('.sequence_answer').select2();
    $(".sequence_answer").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);

        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });

    //$('#sequence_answer').val(['I eat rice', 'I study', 'then I go to school']); 
    //$('#sequence_answer').trigger('change'); 
    
    //$('#sequence_content').hide();
    //$("#image_div_content").hide();
    //$("#show_image").hide();
    //$("#option_content_matching").hide();

    
    
    $(document).on('click', '#add_more_option', function(){
        //$('.remove_option').hide();
        let element = $('#copy_option');
        let idName = 'option'+(option+1);
        option++;
        element.find('.option').attr('id', idName);
        type = $('#type').val();
        
        // element.find('label.option_label').html("Option"); //+ (initialOptionValue+1)
        
        
        if(type == "1"){
            element.find('input.checkbox_option').val(initialOptionValue).show(); //(initialOptionValue+1)
        }else{
            element.find('input.checkbox_option').val(initialOptionValue).hide();
        }
        //element.find('span').html('-').show();
        // $('#option_content').append(element.html());
        $('.add_more_option').before(element.html());

        makeAnserCkeditor(idName);


        initialOptionValue++;
    });
    

    $('#submitBtn').on('click', function(e){
        e.preventDefault();
        type = $('#type').val();
        
        // if(type == "1"){
        //     if ($("#questionCreate input:checkbox:checked").length == 0){
        //         alert('Please select correct answer');
        //     }else{
        //         $("#questionCreate").submit();
        //     }
        // }else if(type == "2" || type == "3" || type == "4" || type == "5"){
        //     if($('#sequence_answer').val() == ""){
        //         alert('Please fillup correct answer sequence');
        //     }else{
        //         $("#questionCreate").submit();
        //     }
        // }else{
        //     $("#questionCreate").submit();
        // }

        $("#questionCreate").submit();

        
    });

    $('#type').on('change', function(){
        type = $('#type').val();
        if(type !== "1"){
            $("#questionCreate input:checkbox").hide();
            $("#questionCreate .checkbox_option").hide();
        }else{
            $("#questionCreate input:checkbox").show();
            $("#questionCreate .checkbox_option").show();
        }

        if(type == "6" || type == "3"){
            $("#option_content").hide();
        }else{
            $("#option_content").show();
        }

        if(type == "2" || type == "3" || type == "4" || type == "5"){
            $("#sequence_content").show();
        }else{
            $("#sequence_content").hide();
        }

        if(type == "4"){
            $("#image_div_content").show();
            //$("#title_content").hide();
        }else{
            $("#image_div_content").hide();
            //$("#title_content").show();
        }

        if(type == "3"){
            //$("#title_content").hide();
            //$("#option_content").hide();
            $("#option_content_matching").show();
        }else{
            //$("#title_content").show();
            //$("#option_content").show();
            $("#option_content_matching").hide();
        }

    });

    $(document).on('change', '.option_values', () => {
        sequence_answer_values=[];
        $('#sequence_answer').html('');
        $('#questionCreate input.option_values').each(function(){
            let value = $(this).val();
            sequence_answer_values.push(value);
            $('#sequence_answer').append('<option value="'+ value +'">'+ value +'</option>');
        });
    });

    $(document).on('change', '.option_value_right', () => {
        sequence_answer_values=[];
        $('#sequence_answer').html('');
        $('#questionCreate input.option_value_right').each(function(){
            let value = $(this).val();
            sequence_answer_values.push(value);
            $('#sequence_answer').append('<option value="'+ value +'">'+ value +'</option>');
        });
    });

    $('#add_more_option_matching').on('click', function(){
        //$('.remove_option').hide();
        let element = $('#copy_option_matching');
        type = $('#type').val();
        
        element.find('label.left_option').html("Left"); //(initialOptionValue+1)
        element.find('label.right_option').html("Right"); // (initialOptionValue+1)
        
        //element.find('span').html('-').show();
        $('#option_content_matching').append(element.html());

        initialOptionValue++;
    });

    $(document).on('click', '.remove_option', function(){
        $(this).parent().parent().remove();
        sequence_answer_values=[];
        $('#sequence_answer').html('');
        $('#questionCreate input.option_values').each(function(){
            let value = $(this).val();
            sequence_answer_values.push(value);
            $('#sequence_answer').append('<option value="'+ value +'">'+ value +'</option>');
        });
    });
    $(document).on('click', '.remove_option_matching', function(){
        $(this).parent().parent().remove();
        sequence_answer_values=[];
        $('#sequence_answer').html('');
        $('#questionCreate input.option_value_right').each(function(){
            let value = $(this).val();
            sequence_answer_values.push(value);
            $('#sequence_answer').append('<option value="'+ value +'">'+ value +'</option>');
        });
    });
    

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(100)
                    .show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection

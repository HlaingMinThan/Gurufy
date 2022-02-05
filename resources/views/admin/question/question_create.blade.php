@extends('admin.layouts.main')

@section('custom_css')

@endsection

@section('content')
<h1 class="h3 mb-3">Question</h1>

<div class="row" id="question">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Create Question</h5>
            </div>
            <div class="card-body">
                <form id="questionCreate" action="{{ url('/admin/question-create') }}" method="post" enctype="multipart/form-data">
                    
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
                                        <option value="1">MCQ</option>
                                        <option value="2">Fill in the blank</option>
                                        <option value="3">Matching</option>
                                        <option value="4">Formula Rendering</option>
                                        <option value="5">Arranging Statements</option>
                                        <option value="6">Descriptive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" id="title_content">
                                <div class="col">
                                    <label class="form-label" for="">Title</label>
                                    <textarea name="title" id="title" class="form-control" rows="5" cols="80">
                                        {{!empty(old('title'))?old('title'):Auth::guard('admin')->user()->title}}
                                    </textarea>

                                    @error('title')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                    <span id="js_validation_title" class="text-danger mt-2 text-center" style="display: none;"></span>
                                </div>
                            </div>

                            <div class="row mt-2" id="image_div_content">
                                <div class="col">
                                    <img id="blah" src="#" alt="your image" id="show_image" style="display: none;"/>
                                    <label class="form-label" for="">Upload Image</label>                                    
                                    <input class="form-control" type="file" name="question_image" accept="image/*" id="question_image" onchange="readURL(this);" />
                                </div>
                                <span id="js_validation_image" class="text-danger mt-2 text-center" style="display: none;"></span>
                            </div>

                            <div class="mt-2" id="option_content">
                                <label class="form-label" for="">Option :</label>
                                <div class="row">
                                    <div class="col-10">
                                        <textarea id="option1" class="form-control option_values" name="option_value[]"></textarea>
                                    </div>
                                    <div class="col-2" style="display: block; position: relative;">
                                        <input type="checkbox" class="checkbox_option" name="correct_answer[]" value="0" style="margin-top: 10px;" />
                                        <label class="form-label checkbox_option" for="">Correct Answer</label>
                                    </div>  
                                </div>
                            </div>

                            <div class="row add_more_option">
                                <div class="col-md-10">
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-success" id="add_more_option"><i class="fa fa-plus"></i> Add new option</button>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="row">
                                <span id="js_validation_option" class="text-danger mt-2 text-center" style="display: none;"></span>
                            </div>

                            

                            <div class="row mt-2" id="option_content_matching">
                                <div class="row">
                                    <div class="col-1" style="text-align: right;">
                                        <label class="form-label" for="">Left</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control ml-2 option_value_left" name="option_value_left[]">
                                    </div>
                                    <div class="col-1" style="text-align: right;">
                                        <label class="form-label" for="">Right</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control ml-2 option_value_right" name="option_value_right[]">
                                    </div>
                                    <div class="col-2" style="display: block; position: relative;">
                                        <span id="add_more_option_matching">+</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <span id="js_validation_option_matching" class="text-danger mt-2 text-center" style="display: none;"></span>
                            </div>

                            <div class="row mt-2" id="sequence_content">
                                <div class="col">
                                    <label class="form-label" for="">Answer Sequence</label>                                    
                                    <select class="sequence_answer col-12" id="sequence_answer" name="sequence_answer[]" multiple="multiple">
                                    </select>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" for="">Explanation to correct answer</label>
                                    <textarea class="form-control" name="explanation" class="explanation" id="explanation"></textarea>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" for="">Level</label>
                                    <select class="form-control" name="level">
                                        @for($i=1; $i < 12; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" for="">Status</label>
                                    <select class="form-control" name="status" name="level">                   
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>                                       
                                    </select>
                                </div>
                            </div>

                        </div>
                       
                    </div>

                    <button type="submit" id="submitBtn" class="btn btn-primary mt-3">Save changes</button>
                </form>

                <!-- Just for copy from and hidden -->
                <div id="copy_option" style="display: none;">
                    <label class="form-label option_label" for="">Option :</label>
                    <div class="row">
                        <div class="col-10">
                            <textarea class="option form-control option_values" name="option_value[]"></textarea>
                        </div>
                        <div class="col-2" style="display: block; position: relative;">
                            <input type="checkbox" class="checkbox_option" name="correct_answer[]" value="option1" style="margin-top: 10px;" />
                            <label class="form-label checkbox_option" for="">Correct Answer</label>
                            <button type="button" class="btn btn-danger remove_option"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row mt-2" id="copy_option_matching" style="display: none;">
                    <div class="row">
                        <div class="col-1" style="text-align: right;">
                            <label class="form-label left_option" for="">Left 1</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control ml-2 option_value_left" name="option_value_left[]">
                        </div>
                        <div class="col-1" style="text-align: right;">
                            <label class="form-label right_option" for="">Right 1</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control ml-2 option_value_right" name="option_value_right[]">
                        </div>
                        <div class="col-2" style="display: block; position: relative;">
                            <button type="button" class="btn btn-danger remove_option_matching"><i class="fa fa-minus"></i> Remove</button>
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
<!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->
<script src="/ckeditor/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>


    let Question = new Vue({
        el: '#question',
        data: {
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
            this.standard = this.standards[0];
            this.subjects = this.standard.subjects;
            this.subject = this.subjects[0];
            this.chapters = this.subject.chapters;
            this.chapter = this.chapters[0];
            this.topics = this.chapter.topics;
            this.topic = this.topics[0].id;
        }
    });



    let initialOptionValue = 1;
    let sequence_answer_values=[];
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
    $('#sequence_content').hide();
    $("#image_div_content").hide();
    $("#show_image").hide();
    $("#option_content_matching").hide();


    makeAnserCkeditor('option1');

    let option = 1;
    
    $('#add_more_option').on('click', function(){
        //$('.remove_option').hide();
        let element = $('#copy_option');
        let idName = 'option'+(option+1);
        option++;
        element.find('.option').attr('id', idName);
        type = $('#type').val();
        
        // element.find('label.option_label').html("Option"); //+ (initialOptionValue+1)
        
        
        if(type == "1"){
            element.find('input.checkbox_option').val(initialOptionValue).show(); //(initialOptionValue+1)
            element.find('label.checkbox_option').show();
        }else{
            element.find('input.checkbox_option').val(initialOptionValue).hide();
            element.find('label.checkbox_option').hide();
        }
        //element.find('span').html('-').show();
        
        $('.add_more_option').before(element.html());
        makeAnserCkeditor(idName);
        

        initialOptionValue++;
    });
    

    $('#submitBtn').on('click', function(e){
        e.preventDefault();
        type = $('#type').val();

        textbox_data = CKEDITOR.instances.title.getData();
        if(textbox_data === ''){
            $('#js_validation_title').html('Title field is required.').show();
        }else{
            $('#js_validation_title').html('Title field i   s required.').hide();
        }


        
        // if(type == "1"){
        //     if ($("#questionCreate input.option_values").length < 2){
        //         $('#js_validation_option').html('Please set at least two options').show();
        //         return false;
        //     } else if ($("#questionCreate input.option_values").length > 1){
        //         $("#questionCreate input.option_values").each(function(){
        //             if($(this).val().length === 0){
        //                 $('#js_validation_option').html('Please complete option fields.').show();
        //                 return false;
        //             }else{
        //                 $('#js_validation_option').html('').hide();
        //                 if ($("#questionCreate input:checkbox:checked").length == 0){
        //                     $('#js_validation_option').html('Please select correct answer').show();
        //                     return false;
        //                 }else{
        //                     $('#js_validation_option').html('').hide();
        //                     $("#questionCreate").submit();
        //                 }
        //             }
        //         });
        //     }

        
        // }else if(type == "2"){
        //     if ($("#questionCreate input.option_values").length > 0){
        //         $("#questionCreate input.option_values").each(function(){
        //             if($(this).val().length === 0){
        //                 console.log("jlksjdfk jf kl");
        //                 $('#js_validation_option').html('Please complete option fields.').show();
        //                 return false;
        //             }else{
        //                 $('#js_validation_option').html('').hide();
                        
        //                 if($("#sequence_answer").select2('val').length !== $("#questionCreate input.option_values").length){
        //                     $('#js_validation_option').html('Options number and answer sequence number are not same.').show();
        //                 }else{
        //                     $('#js_validation_option').html('').hide();
        //                     $("#questionCreate").submit();
        //                 }
        //             }
        //         });
        //     }
        //     // if($('#sequence_answer').val() == ""){
        //     //     alert('Please fillup correct answer sequence');
        //     // }else{
        //     //     $("#questionCreate").submit();
        //     // }
        // }else if(type == "3"){
        //     if ($("#questionCreate input.option_value_left").length < 2){
        //         $('#js_validation_option_matching').html('Please set at least two pair options').show();
        //         return false;
        //     } else if ($("#questionCreate input.option_value_left").length > 1){
        //         $("#questionCreate input.option_value_left").each(function(){
        //             if($(this).val().length === 0){
        //                 $('#js_validation_option_matching').html('Please complete option fields.').show();
        //                 return false;
        //             }else{
        //                 $('#js_validation_option_matching').html('').hide();
        //                 $("#questionCreate input.option_value_right").each(function(){
        //                     if($(this).val().length === 0){
        //                         $('#js_validation_option_matching').html('Please complete option fields.').show();
        //                         return false;
        //                     }else{
        //                         $('#js_validation_option_matching').html('').hide();
        //                         if($("#sequence_answer").select2('val').length !== $("#questionCreate input.option_value_right").length){
        //                             $('#js_validation_option_matching').html('Options number and answer sequence number are not same.').show();
        //                         }else{
        //                             $('#js_validation_option_matching').html('').hide();
        //                             $("#questionCreate").submit();
        //                         }
        //                     }
        //                 })

        //             }
        //         });
        //     }
        // }else if(type == "4"){
        //     //let imageFile = $('#question_image').files;
        //     let imageFile = document.getElementById("question_image");
        //     console.log('image file', imageFile.files.length);
        //     if(!imageFile.files.length){
        //         $('#js_validation_image').html('Image file is required.').show();
        //         return false;
        //     }else{
        //         $('#js_validation_image').html('').hide();
        //     }
        //     if ($("#questionCreate input.option_values").length > 0){
        //         $("#questionCreate input.option_values").each(function(){
        //             if($(this).val().length === 0){
        //                 $('#js_validation_option').html('Please complete option fields.').show();
        //                 return false;
        //             }else{
        //                 $('#js_validation_option').html('').hide();
                        
        //                 if($("#sequence_answer").select2('val').length !== $("#questionCreate input.option_values").length){
        //                     $('#js_validation_option').html('Options number and answer sequence number are not same.').show();
        //                 }else{
        //                     $('#js_validation_option').html('').hide();
        //                     $("#questionCreate").submit();
        //                 }
        //             }
        //         });
        //     }
        // }else if(type == "5"){
        //     if ($("#questionCreate input.option_values").length > 0){
        //         $("#questionCreate input.option_values").each(function(){
        //             if($(this).val().length === 0){
        //                 $('#js_validation_option').html('Please complete option fields.').show();
        //                 return false;
        //             }else{
        //                 $('#js_validation_option').html('').hide();
                        
        //                 if($("#sequence_answer").select2('val').length !== $("#questionCreate input.option_values").length){
        //                     $('#js_validation_option').html('Options number and answer sequence number are not same.').show();
        //                 }else{
        //                     $('#js_validation_option').html('').hide();
        //                     $("#questionCreate").submit();
        //                 }
        //             }
        //         });
        //     }
        // }else{
        //     //$("#questionCreate").submit();
            
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
        $('#option_content_matching').after(element.html());

        initialOptionValue++;
    });

    $(document).on('click', '.remove_option', function(){
        $(this).parent().parent().remove();
    });
    $(document).on('click', '.remove_option_matching', function(){
        $(this).parent().parent().remove();
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

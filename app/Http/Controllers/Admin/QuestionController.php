<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Yajra\Datatables\Datatables;

use App\Models\Standard;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $data['items'] = Question::with(['topic', 'topic.chapter', 'topic.chapter.subject', 'topic.chapter.subject.standard'])->orderBy('serial', 'asc')->paginate(20)->withQueryString();
        return view('admin.question.index', $data);
    }

    public function questionCreate(Request $request){
        $data['items'] = Standard::with(['subjects', 'subjects.chapters', 'subjects.chapters.topics'])->where('status', true)->get()->toJson();
        return view('admin.question.question_create', $data);
    }

    public function questionCreateAction(Request $request)
    {
        if(empty($request->topic)) return redirect()->back()->with('error_message', 'You must select standard, subject, chapter and topic');
        $request->validate([
            'type' => 'required',
        ]);

        $type = $request->type;
        $options = $request->option_value;
        $correct_answer_options = $request->correct_answer;
        $sequence_answer_options = $request->sequence_answer; //basically it will be correct answer by modifying
        $imageName = "";

        if(empty($correct_answer_options) || empty($options)){
            return redirect()->back()->withInput()->with('error_message', 'Please fillup all the fields');
        }


        //for matching 
        $options_left = $request->option_value_left;
        $options_right = $request->option_value_right;

        $correct_answer = [];
        if($type == "1"){
            foreach($correct_answer_options as $option){
                $index = (int) $option;
                array_push($correct_answer, $options[$index]);
            }
        }if($type == "2"){
            foreach($sequence_answer_options as $option){
                array_push($correct_answer, $option);
            }
        } else if($type == "3"){
            $options = [];
            foreach($options_left as $key=>$left){
                $option_array = [];
                //array_push($option_array, $left);
                //array_push($option_array, $options_right[$key]);
                $option_obj = (object) ['left' => $left, 'right' => $options_right[$key]];
                array_push($options, $option_obj);
            }

            foreach($sequence_answer_options as $option){
                array_push($correct_answer, $option);
            }
            
        } else if($type == "4"){
            // $request->validate([
            //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
    
            if($request->hasFile('question_image')){
                $imageName = time().'.'.$request->question_image->extension();  
                $request->question_image->move(public_path('question_images'), $imageName);
            }

            foreach($sequence_answer_options as $option){
                array_push($correct_answer, $option);
            }

        } else if($type == "5"){
            foreach($sequence_answer_options as $option){
                array_push($correct_answer, $option);
            }
        } else if($type == "6"){
            $options = [];
        }

        $serial = Question::max('serial');

        $question = new Question;
        $question->serial = $serial+1;
        $question->title = $request->title;
        $question->topic_id = $request->topic;
        $question->question_type = $type;
        $question->options = json_encode($options);
        $question->correct_answer = json_encode($correct_answer);
        $question->explanation = $request->explanation;
        $question->level = $request->level;
        $question->status = $request->status == "1" ? 1 : 0;

        if($type == "4"){
            $question->question_file = $imageName;
        }

        if($question->save()){
            return redirect()->back()->with('success_message', 'Question created successfully');
        }else{
            return redirect()->back()->with('error_message', 'Question was not created !');
        }

    }

    public function questionEdit(Request $request){
        $question_id = $request->segment(3);
        $question_details = Question::with(['topic', 'topic.chapter', 'topic.chapter.subject'])->where(['id' => $question_id, 'status' => 1])->first();

        //$question_details = (array) $question_details;
        $data['items'] = Standard::with(['subjects', 'subjects.chapters', 'subjects.chapters.topics'])->where('status', true)->get()->toJson();
        $data['question_details'] = $question_details;
        return view('admin.question.question_edit', $data);
    }

    public function questionEditAction(Request $request){
        $question_id = $request->segment(3);

        if(empty($request->topic)) return redirect()->back()->with('error_message', 'You must select standard, subject, chapter and topic');

        $request->validate([
            'type' => 'required',
        ]);
        
        $type = $request->type;
        $options = $request->option_value ? $request->option_value : [];
        $correct_answer_options = $request->correct_answer ? $request->correct_answer : [];
        $sequence_answer_options = $request->sequence_answer ? $request->sequence_answer : []; //basically it will be correct answer by modifying
        $imageName = "";

        //for matching 
        $options_left = $request->option_value_left;
        $options_right = $request->option_value_right;

        $correct_answer = [];
        if($type == "1"){
            foreach($correct_answer_options as $option){
                $index = (int) $option;
                array_push($correct_answer, $options[$index]);
            }
        }if($type == "2"){
            foreach($sequence_answer_options as $option){
                array_push($correct_answer, $option);
            }
        } else if($type == "3"){
            $options = [];
            foreach($options_left as $key=>$left){
                $option_array = [];
                $option_obj = (object) ['left' => $left, 'right' => $options_right[$key]];
                array_push($options, $option_obj);
            }

            foreach($sequence_answer_options as $option){
                array_push($correct_answer, $option);
            }
            
        } else if($type == "4"){
            // $request->validate([
            //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
    
            if($request->hasFile('question_image')){
                $imageName = time().'.'.$request->question_image->extension();  
                $request->question_image->move(public_path('question_images'), $imageName);
            }

            foreach($sequence_answer_options as $option){
                array_push($correct_answer, $option);
            }

        } else if($type == "5"){
            foreach($sequence_answer_options as $option){
                array_push($correct_answer, $option);
            }
        } else if($type == "6"){
            $options = [];
        }



        $question = Question::where(['id' => $question_id])->first();
        $question->title = $request->title;
        $question->serial = $request->serial;
        $question->topic_id = $request->topic;
        $question->question_type = $type;
        $question->options = json_encode($options);
        if(!empty($correct_answer)){
            $question->correct_answer = json_encode($correct_answer);
        }
        $question->level = $request->level;
        $question->explanation = $request->explanation;
        $question->status = $request->status == "1" ? 1 : 0;

        if($type == "4" && $imageName != ""){
            if(file_exists(public_path('question_images').'/'.$question->question_file)){
                unlink(public_path('question_images').'/'.$question->question_file);
            }
            $question->question_file = $imageName;
        }


        if($question->save()){
            return redirect()->back()->with('success_message', 'Question created successfully');
        }else{
            return redirect()->back()->with('error_message', 'Question was not created !');
        }

    }

    public function imageUpload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);

 
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('images'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = '/images/'.$fileName; 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function destroy(Request $request, $id)
    {
        Question::find($id)->delete();
        return redirect()->back()->with('success_message', 'Question successfully deleted!');
    }
}
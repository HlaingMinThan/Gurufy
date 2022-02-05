<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Chapter;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subject_id)
    {
        $data['subject'] = Subject::find($subject_id);
        $data['items'] = Chapter::where('subject_id', $subject_id)->paginate(20)->withQueryString();
        return view('admin.chapter.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $subject_id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $Chapter = new Chapter();
        $Chapter->name = $request->name;
        $Chapter->subject_id = $subject_id;
        $Chapter->created_at = date('Y-m-d H:i:s');
        $Chapter->save();

        return redirect()->back()->with('success_message', 'Successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['item'] = Chapter::find($id);
        return view('admin.chapter.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $Chapter = Chapter::find($id);
        $Chapter->name = $request->name;
        $Chapter->save();

        return redirect()->back()->with('success_message', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('success_message', 'Deleted Successfully');
    }
}

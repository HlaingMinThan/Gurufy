<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Topic;
use App\Models\Chapter;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chapter_id)
    {
        $data['chapter'] = Chapter::find($chapter_id);
        $data['items'] = Topic::where('chapter_id', $chapter_id)->paginate(20)->withQueryString();
        return view('admin.topic.index', $data);
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
    public function store(Request $request, $chapter_id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $Topic = new Topic();
        $Topic->name = $request->name;
        $Topic->chapter_id = $chapter_id;
        $Topic->created_at = date('Y-m-d H:i:s');
        $Topic->save();

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
        $data['item'] = Topic::find($id);
        return view('admin.topic.edit', $data);
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
        $Topic = Topic::find($id);
        $Topic->name = $request->name;
        $Topic->save();

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

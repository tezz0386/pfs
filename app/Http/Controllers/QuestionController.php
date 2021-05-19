<?php

namespace App\Http\Controllers;

use App\Help\UserHelp;
use App\Models\Question;
use Illuminate\Http\Request;
use Auth;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return Question::select('title',)->orderByDesc('created_at')->get(10);
        return view('question-create', [
            'title'=>'pfs-ask',
            'levels'=>UserHelp::getLevels(),
            'universities'=>USerHelp::getUniversities(),
            'programs'=>UserHelp::getPrograms(),
            'faculties'=>USerHelp::getFaculties(),
            'contents'=>UserHelp::getContents1(),
            'contents2'=>UserHelp::getContents2(),
            'contents3'=>UserHelp::getContents3(),
            'crashes'=>UserHelp::crash(),
            'questions'=>Question::select('title')->orderByDesc('created_at')->get(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $question = new Question();
        $question->uid=Auth::user()->id;
        $question->title=$request->title;
        $question->question_category=$request->question_category;
        $question->question=$request->question;
        if($question->save())
        {
            return back()->with('success', 'Your Question has successfully posted, you will notify when any answer is available for that');
        }else{
            return back()->with('error', 'Sorry!! could not be post, please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}

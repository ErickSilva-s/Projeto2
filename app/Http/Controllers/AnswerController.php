<?php

namespace App\Http\Controllers;


use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
{
    $questionId = $request->input('question_id');
    $userId = Auth::user()->id;
        
    $answers= Answer::create([
        'answer' => $request ->input('answer'),
        'question_id'=>$questionId,
        'user_id' => $userId
    ]);
    return redirect()->route('questions.index', ['answers' => $answers]);

    // $answers = new Answer;
    // $answers->answer = $request->input('answer');
    // $answers->user_id = auth()->user()->id; 
    // $answers->question_id = $question->id;
    // $answers->save();

    // return redirect()->back()->with('success', 'Pergunta enviada com sucesso!');
}

}

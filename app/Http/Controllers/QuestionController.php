<?php

namespace App\Http\Controllers;


use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('user')->get();

        return view('questions.index', compact('questions'));
    }

    public function store(Request $request)
{
    $questions = new Question;
    $questions->question = $request->input('question');
    $questions->user_id = auth()->user()->id; // Obtém o ID do usuário cliente autenticado
    $questions->save();

    return redirect()->back()->with('success', 'Question enviada com sucesso!');
}


    // public function show(Question $question)
    // {
    //     $question->load('user', 'answers.user');

    //     return view('questions.index', compact('question'));
    // }
}

<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Question;
 
class QuestionController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function getQuestions()
    {
        $questions = Question::select('en', 'sr')->get();
        return response()->json($questions);
    }
}
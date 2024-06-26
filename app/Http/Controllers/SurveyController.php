<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MattDaneshvar\Survey\Models\Survey;
use MattDaneshvar\Survey\Models\Entry;
use MattDaneshvar\Survey\Contracts\Answer;
use MattDaneshvar\Survey\Models\Question;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$survey = $this->survay();
        $survey = $this->survay();


        return view('list', ['survey'=> $survey]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('survey.new');
    }

    public function saveAnswer(Request $request)
    {
        $survey = $this->survay();

        $answers = $this->validate($request, $survey->rules);
        
        (new Entry)->for($survey)->fromArray($answers)->push();

        return back()->with('success','Gracias por tu respuesta.');
    }

    protected function survay(){
        return Survey::all()->random();
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nameSurvey = $request->content;
        $question = $request->question;
        $typeSurvey = $request->typeQuestion;
        $options = $request->options;

        // Decodificar las opciones si existen
        $options = json_decode($options, true);
        
        //Creacion de encuesta
        $survey = Survey::create(['name' => $nameSurvey, 'settings' => ['accept-guest-entries' => true]]);


        if($typeSurvey == 'radio'){
            $survey->questions()->create([
                'content' => $question,
                'type' => $typeSurvey,
                'options' => $options,
            ]);
        }elseif($typeSurvey == 'numeric'){
            $survey->questions()->create([
                'content' => $question,
                'type' => $typeSurvey,
                'rules' => ['numeric', 'min:0']
            ]);
        }

        return redirect('/public');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}

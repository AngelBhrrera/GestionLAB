<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Phpml\Nlp\Tokenizer\WhitespaceTokenizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Classification\SVC;
use App\Models\Message;

class ChatbotController extends Controller
{
    public function index()
    {
        // Lógica para obtener mensajes y mostrarlos en la vista
        $messages = Message::all();
        return view('chat.index', compact('messages'));
    }

    public function store(Request $request)
    {
        // Lógica para procesar nuevos mensajes
        $newMessage = $request->input('message');

        // Implementa aquí el procesamiento de lenguaje natural y aprendizaje automático
        $classifier = new SVC();
        $vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
        $tfIdfTransformer = new TfIdfTransformer();

        $samples = ['Hola', 'Cómo estás', 'Adiós'];
        $labels = ['saludo', 'saludo', 'despedida'];

        $vectorizer->fit($samples);
        $vectorizer->transform($samples);

        $tfIdfTransformer->fit($samples);
        $tfIdfTransformer->transform($samples);

        $classifier->train($samples, $labels);

        $predictedLabel = $classifier->predict([$newMessage]);

        // Guardar el mensaje en la base de datos
        Message::create([
            'user_id' => auth()->user()->id,
            'content' => $newMessage,
            'predicted_label' => $predictedLabel,
        ]);

        return redirect()->route('chat.index');
    }
}

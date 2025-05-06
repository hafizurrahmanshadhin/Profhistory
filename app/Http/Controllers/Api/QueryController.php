<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Services\Api\OpenAIService;
use Illuminate\Http\Request;

class QueryController extends Controller {
    public function ask(Request $req) {
        $req->validate([
            'question' => 'required|string',
        ]);

        $question = $req->input('question');

        $matches = Document::whereRaw(
            "MATCH(content) AGAINST (? IN NATURAL LANGUAGE MODE)",
            [$question]
        )
            ->limit(5)
            ->get();

        if ($matches->isEmpty()) {
            return response()->json([
                'question' => $question,
                'answer'   => 'No relevant documents found.',
                'sources'  => [],
            ]);
        }

        $context = $matches
            ->map(fn($doc) => substr($doc->content, 0, 2000))
            ->implode("\n\n---\n\n");

        $answer = OpenAIService::getAnswer($question, $context);

        return response()->json([
            'question' => $question,
            'answer'   => $answer,
            'sources'  => $matches->map(fn($d) => [
                'id'       => $d->id,
                'filename' => $d->filename,
                'preview'  => substr($d->content, 0, 200),
            ]),
        ]);
    }
}

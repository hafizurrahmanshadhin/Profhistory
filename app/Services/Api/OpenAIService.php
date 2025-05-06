<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;

class OpenAIService {
    protected static function headers(): array {
        return [
            'Authorization' => 'Bearer ' . config('services.openai.key'),
            'Content-Type'  => 'application/json',
        ];
    }

    /**
     * Send a single GPT-3.5-Turbo chat completion with system+user messages.
     */
    public static function getAnswer(string $question, string $context): string {
        $prompt = "Context:\n{$context}\n\nQuestion:\n{$question}";

        $res = Http::withHeaders(static::headers())
            ->post('https://api.openai.com/v1/chat/completions', [
                'model'    => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ])
            ->throw()
            ->json();

        return $res['choices'][0]['message']['content'] ?? 'No response from AI.';
    }
}

<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class IaHelper
{
    public static function generateDistractors($question, $answer): ?array
    {
        $apiKey = env('OPENROUTER_API_KEY');

        $prompt = <<<TEXT
            Sua tarefa é gerar exatamente 4 respostas incorretas (distratores) para uma pergunta.

            ⚠️ Regras obrigatórias:

            Você DEVE gerar EXATAMENTE 4 respostas incorretas. Nem mais, nem menos.

            As respostas devem ser plausíveis, ou seja, devem parecer corretas para quem não sabe a resposta.

            As respostas devem ser relacionadas ao tema da pergunta.

            Retorne somente as 4 respostas incorretas, separadas por vírgulas e dentro de chaves {}.

            Não inclua explicações, comentários, código ou texto adicional.

            ❌ NÃO use aspas.
            ❌ NÃO explique nada.
            ✅ Apenas o seguinte formato:
            {resposta1, resposta2, resposta3, resposta4}

            Pergunta: $question
            Resposta correta: $answer
            TEXT;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $apiKey",
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'qwen/qwen3-coder:free',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ]
        ]);

        return $response->json();
    }

    public static function regenerateDistractors($question, $answer, $oldDistractors): ?array
    {
        $apiKey = env('OPENROUTER_API_KEY');
        $oldDistractors = $oldDistractors->toJson();


        $prompt = <<<TEXT
            Sua tarefa é gerar exatamente 4 respostas incorretas (distratores) para uma pergunta.

            ⚠️ Regras obrigatórias:

            Você DEVE gerar EXATAMENTE 4 respostas incorretas. Nem mais, nem menos.

            As respostas devem ser plausíveis, ou seja, devem parecer corretas para quem não sabe a resposta.

            As respostas devem ser relacionadas ao tema da pergunta.

            As respostas NÃO DEVEM ser as seguintes: $oldDistractors

            Retorne somente as 4 respostas incorretas, separadas por vírgulas e dentro de chaves {}.

            Não inclua explicações, comentários, código ou texto adicional.

            ❌ NÃO use aspas.
            ❌ NÃO explique nada.
            ✅ Apenas o seguinte formato:
            {resposta1, resposta2, resposta3, resposta4}

            Pergunta: $question
            Resposta correta: $answer
            TEXT;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $apiKey",
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'qwen/qwen3-coder:free',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ]
        ]);

        return $response->json();
    }
}

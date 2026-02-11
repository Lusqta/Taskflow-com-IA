<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService {
    public static function reorganizeTasks($tasks) {
        $apiKey = env('GROQ_API_KEY');
        $url = "https://api.groq.com/openai/v1/chat/completions";

        $taskList = [];

        foreach ($tasks as $task) {
            $taskList[] = [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description
            ];
        }

        $taskListJson = json_encode($taskList, JSON_UNESCAPED_UNICODE);

        $systemPrompt = "
        Você é um Tech Lead experiente e rigoroso.
        Classifique tarefas de forma estratégica e comparativa.
        Nunca atribua todas como BAIXA.
        Sempre compare impacto sistêmico antes de decidir.
        Utilize as chaves 'high', 'medium' ou 'low' para a prioridade.
        ";

        $userPrompt = "
        Analise o backlog abaixo e classifique prioridades.

        Decision Framework:
        1. Impacta produção ou usuários → high
        2. Bloqueia desenvolvedores → high
        3. Entrega funcionalidade relevante → medium
        4. Apenas melhoria estética/técnica → low

        Backlog:
        $taskListJson

        Retorne APENAS JSON no formato:
        {
          \"insight\": \"uma frase curta de insight estratégico em pt-br\",
          \"tasks\": [
            {\"id\": number, \"priority\": \"high|medium|low\", \"reasoning\": \"string\"}
          ]
        }
        ";

        $response = Http::withToken($apiKey)->post($url, [
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $userPrompt]
            ],
            'temperature' => 0,
            'response_format' => ['type' => 'json_object']
        ]);

        if ($response->failed()) return null;

        $data = $response->json();

        if (!isset($data['choices']) || empty($data['choices'])) {
            return null;
        }

        return json_decode($data['choices'][0]['message']['content'], true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIChatController extends Controller
{
    public function chat(Request $request)
    {
        $apiKey = config('services.openai.key');
        \Log::info('OpenAI Key: ' . $apiKey);

        $userMessage = $request->input('message');

        $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/chat/completions',[
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful customer support agent.'],
                ['role' => 'user', 'content' => $userMessage],
            ],
        ]);
        if (!$response->successful()) {
            return response()->json([
                'error' => 'API call failed',
                'details' => $response->json(),
            ], 500);
        }

        $data = $response->json();

        if (!isset($data['choices'][0]['message']['content'])) {
            return response()->json([
                'error' => 'Invalid response from OpenAI',
                'details' => $data,
            ], 500);
        }

        return response()->json($data['choices'][0]['message']['content']);
    }
}

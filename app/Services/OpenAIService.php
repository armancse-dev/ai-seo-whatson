<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService
{
  public function clusterKeywords(array $keywords): array
  {
    $prompt = "Group the following keywords into logical topic clusters and return JSON only in this format:
{
  \"clusters\": [
    {\"cluster_name\":\"Cluster A\", \"keywords\":[\"kw1\",\"kw2\"]},
    {\"cluster_name\":\"Cluster B\", \"keywords\":[\"kw3\",\"kw4\"]}
  ]
}
Keywords: " . implode(', ', $keywords);

    $response = OpenAI::chat()->create([
      'model' => 'gpt-3.5-turbo',
      'messages' => [
        ['role' => 'user', 'content' => $prompt],
      ],
      'temperature' => 0,
    ]);

    $content = $response->choices[0]->message->content ?? '{}';

    $data = json_decode($content, true);

    return $data['clusters'] ?? [];
  }
}

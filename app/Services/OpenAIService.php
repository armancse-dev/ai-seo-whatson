<?php
namespace App\Services;
use GuzzleHttp\Client;

class OpenAIService {
  protected $client;
  public function __construct(){
    $this->client = new Client([
      'base_uri'=>'https://api.openai.com/v1/',
      'headers'=>[
        'Authorization'=>'Bearer '.config('services.openai.key'),
        'Content-Type'=>'application/json'
      ]
    ]);
  }
  public function clusterKeywords(array $keywords) {
    $prompt = "Group the following keywords into topic clusters and return JSON object only in format: {\"clusters\":[{\"cluster_name\":\"..\",\"keywords\":[..]}]} Keywords: ".implode(', ',$keywords);
    $payload = [
      'model'=>'gpt-4o-mini', // use available model
      'messages'=>[['role'=>'user','content'=>$prompt]],
      'max_tokens'=>800,
      'temperature'=>0.0
    ];
    $res = $this->client->post('chat/completions', ['json'=>$payload]);
    $body = json_decode((string)$res->getBody(), true);
    $content = $body['choices'][0]['message']['content'] ?? null;
    if(!$content) return null;
    $json = json_decode($content, true);
    if($json) return $json;
    // fallback: extract JSON substring
    preg_match('/\{.*\}/s', $content, $m);
    return $m[0] ? json_decode($m[0],true) : null;
  }
}

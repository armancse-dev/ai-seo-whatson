<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use App\Models\Project;
use App\Models\Report;

class RunSeoAudit implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;
    public $project;
    /**
     * Create a new job instance.
     */
    public function __construct(Project $project)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client(['timeout' => 20]);
        $url = rtrim($this->project->website, '/');
        try {
            $res = $client->get($url);
            $html = (string) $res->getBody();
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML($html);

            $title = $dom->getElementsByTagName('title')->item(0)->textContent ?? '';
            $metaDesc = '';
            foreach ($dom->getElementsByTagName('meta') as $m) {
                if (strtolower($m->getAttribute('name')) == 'description')
                    $metaDesc = $m->getAttribute('content');
            }
            $h1Count = $dom->getElementsByTagName('h1')->length;
            $imgs = $dom->getElementsByTagName('img');
            $imagesWithoutAlt = 0;
            foreach ($imgs as $img)
                if (trim($img->getAttribute('alt')) === '')
                    $imagesWithoutAlt++;

            $report = [
                'url' => $url,
                'title' => $title,
                'meta_description' => $metaDesc,
                'h1_count' => $h1Count,
                'images_without_alt' => $imagesWithoutAlt,
            ];
            Report::create(['project_id' => $this->project->id, 'type' => 'audit', 'data' => $report]);
        } catch (\Exception $e) {
            Report::create(['project_id' => $this->project->id, 'type' => 'audit', 'data' => ['error' => $e->getMessage()]]);
        }
    }
}

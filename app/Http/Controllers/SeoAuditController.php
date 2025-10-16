<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Jobs\RunSeoAudit;
class SeoAuditController extends Controller
{
    public function run(Project $project)
    {
        if ($project->user_id !== auth()->id())
            abort(403);
        RunSeoAudit::dispatch($project);
        return response()->json(['message' => 'Audit queued']);
    }

    public function reports(Project $project)
    {
        if ($project->user_id !== auth()->id())
            abort(403);
        return response()->json($project->reports()->latest()->get());
    }
}

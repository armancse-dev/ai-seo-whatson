<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return auth()->user()->projects()->with('reports')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $r->validate(['name' => 'required', 'website' => 'required|url']);
        $project = Project::create(['user_id' => auth()->id(), 'name' => $r->name, 'website' => $r->website, 'settings' => []]);
        return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project); // create Policy or check owner
        return $project->load('keywords', 'reports');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($r->only('name', 'website'));
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;

class ProjectModerationController
{
    public function destroy(Project $project)
    {
        $project->delete();
        return back();
    }
}
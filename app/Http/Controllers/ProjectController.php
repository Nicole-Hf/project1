<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

class ProjectController extends Controller
{
    public function user($token)
    {
        $user = User::where("token", $token)->get()->first();

        if ($user) {
            return $user;
        }

        return "The token is invalid";
    }

    public function store(Request $request, $code)
    {
        $project = Project::where('code', $code)->get()->first();

        if ($project) {
            $project->update([
                'content' => $request->content,
            ]);

            return "The project was successfully stored";
        }

        return "There was a mistake";
    }

    public function chargeDiagram($code)
    {
        $project = Project::where('code', $code)->get()->first();

        if ($project) {
            return $project;
        }

        return "Code not registered";
    }
}

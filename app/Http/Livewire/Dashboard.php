<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Project;
use App\Models\Collaborator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $title, $description, $projectId, $code;
    public $users;

    public $modalCreate, $modalEdit, $modalDestroy, $modalJoin, $modalShare, $modalUsers, $modalError = false;
    public $registered = false;
    public $option = true;
    public $contador, $longitud = 0;

    public function contar()
    {
        if ($this->contador < $this->longitud - 1) {
            $this->contador++;
        }
    }

    public function restar()
    {
        if ($this->contador > 0) {
            $this->contador--;
        }
    }

    public function render()
    {
        $user = User::find(Auth()->user()->id);

        if ($this->option)
            $projects = $user->project;
        else
            $projects = $user->projects;

        /*$cont = 1;
        unset($arrays);
        unset($array);
        $array = array();
        $arrays = array();

        foreach ($projects as $project) {
            if ($cont <= 3) {
                array_push($arrays, $array);
                $cont = $cont + 1;
            } else {
                array_push($arrays, $array);
                $array = array();
                array_push($array, $project);
                $cont = 1;
            }
        }

        array_push($arrays, $array);
        $this->longitud = count($arrays);*/
        return view('livewire.dashboard', compact('projects'));
    }

    public function showProject($projectId)
    {
        $this->projectId = $projectId;
        $this->users = DB::table('users')->join('collaborators', 'collaborators.user_id', '=', 'users.id')
        ->where('collaborators.project_id', $projectId)
        ->select('users.id', 'users.name', 'users.email', 'collaborators.project_id')->get();
        $this->modalUsers = true;
    }

    public function updateShowUsers($projectId)
    {
        $this->users = DB::table('users')
        ->join('collaborators', 'collaborators.user_id', '=','users.id')
        ->where('collaborators.project_id',$proyecto_id)
        ->select('users.id','users.name','users.email','collaborators.project_id')->get();
    }

    public function shareProject($code)
    {
        $this->modalShare = true;
        $this->code = $code;
    }

    public function storeProject()
    {
        if ($this->title != "") {
            $this->modalError = false;
            do {
                $token = Str::uuid();
            } while (Project::where("code", $token)->first() instanceof Project);

            Project::create([
                'title' => $this->title,
                'description' => $this->description,
                'user_id' => Auth()->user()->id,
                'code' => Str::uuid()
            ]);

            $this->clean();
        } else {
            $this->modalError = true;
        }
    }

    public function joinProject()
    {
        if ($this->code == "")  {
            $this->modalError = true;
        } else {
            $project = Project::where("code", $this->code)->get()->first();
            $collaborator = Collaborator::where("user_id", auth()->user()->id)
                ->where("project_id", $project->id)->get()->first();

            if ($project && $collaborator == null) {
                $project->users()->attach(auth()->user()->id);
                $this->registered = false;
                $this->clean();
            } else {
                $this->modalError = true;
                $this->registered = true;
            }
        }
    }

    public function updateProject()
    {
        if ($this->title == "") {
            $this->modalError = true;
        } else{
            $project = Project::find($this->projectId);
            $project->update([
                'title' => $this->title,
                'description' => $this->description,
            ]);
            $this->clean();
        }
    }

    public function modalEdit($id)
    {
        $this->modalEdit = true;
        $this->projectId = $id;
        $project = Project::find($this->projectId);
        $this->title = $project->title;
        $this->description = $project->description;
    }

    public function clean()
    {
        $this->title = null;
        $this->description = null;
        $this->modalEdit = false;
        $this->modalCreate = false;
        $this->modalDestroy = false;
        $this->modalJoin = false;
        $this->code = null;
        $this->modalShare = false;
        $this->modalError = false;
        $this->modalUsers = false;
    }

    public function cancel()
    {
        $this->clean();
    }

    public function modalDestroy($id)
    {
        $this->modalDestroy = true;
        $this->projectId = $id;
    }

    public function destroyProject()
    {
        $project = Project::find($this->projectId);
        $project->delete();
        $this->modalDestroy = false;
        $this->clean();
    }

    public function destroyCollaborator($user, $project)
    {
        $collaborator = Collaborator::where([
            "user_id" => $user,
            "project_id" => $project
        ])->get()->first();
        $collaborator->delete();
        $this->updateShowUsers($proyecto);
    }

    /*public function render()
    {
        return view('livewire.dashboard');
    }*/
}

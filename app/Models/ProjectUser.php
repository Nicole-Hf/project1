<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $table = "project_user";

    protected $fillable = [
        'user_id',
        'project_id'
    ];

    /*public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'projectId');
    }*/
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    protected $table = "collaborators";

    protected $fillable = [
        'userId',
        'projectId'
    ];

    /*public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'projectId');
    }*/
}

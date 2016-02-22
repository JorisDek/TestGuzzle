<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'jira_id',
        'key',
        'name',
        'description'
    ];
}

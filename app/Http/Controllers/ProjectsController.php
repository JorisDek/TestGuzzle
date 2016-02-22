<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        Project::truncate();
                                                                
        $jira_projects = $this->getBodyOfUrl('GET', 'project');
        
        foreach($jira_projects as $jira_project){
            $project = Project::create([   
                'jira_id' => $jira_project->id,
                'key'=> $jira_project->key,
                'name'=> $jira_project->name,
                'description'=> $jira_project->self 
            ]);
        }
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }
    
    
    
    public function getBodyOfUrl($get, $url)
    {
        $client = new Client(['base_uri' => getenv('ATLASSIAN_BASE_URI')]);
       
        $response = $client->request($get, $url,['auth' => [getenv('JIRA_USER'), getenv('JIRA_PASS')]]);
        
        return json_decode($response->getBody());
    }
}

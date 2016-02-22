<?php

use Illuminate\Database\Seeder;
use App\Project;
use GuzzleHttp\Client;

class ProjectsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Project::truncate();

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://code-bridge.atlassian.net/rest/api/2/']);
        // Send a request to http://code-bridge.atlassian.net/rest/api/2/issue/TIC-1
       
        
        $response = $client->request('GET', 'project',['auth' => ['joris', 'tulp6631']]);
        
        $body = $response->getBody();
        //dd($body);                                                                
        $jira_projects = json_decode($body);
        foreach($jira_projects as $jira_project){
            $project = Project::create([   
                'jira_id' => $jira_project->id,
                'key'=> $jira_project->key,
                'name'=> $jira_project->name,
                'description'=> $jira_project->self 
            ]);
        }
    }

}

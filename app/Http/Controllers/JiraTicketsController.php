<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\JiraTickets;
use GuzzleHttp\Client;

class JiraTicketsController extends Controller
{
    public function create()
    {
        return view('jiratickets.create');
    }
    
    public function store(JiraTickets $ticket)
    {
        $response = $this->getResponseOfCall('POST', 'issue');
        
        return redirect('jiratickets', compact('response'));
    }
    public function index()
    {
        return view('jiratickets.index');
    }
    
    public function getResponseOfCall($get, $url)
    {
        $client = new Client([
            'base_uri' => getenv('ATLASSIAN_BASE_URI'),
            'auth' => array(getenv('JIRA_USER'), getenv('JIRA_PASS')),
            'headers' => array('Content-Type' => 'application/json')
        ]);
       
        $response = $client->request($get, $url, 
            ['body' => '{
                            "fields": {
                                "project":
                                { 
                                    "key": "TIC"
                                },
                                "summary": "TestGuzzle5",
                                "description": "Dit is een Guzzle  Test5",
                                "issuetype": {
                                     "name": "Bug"
                                },
                                "assignee": {
                                    "name":"joris"
                                }
                                
                            }
                        }'
        ]);
        
        return $response;
    }
}

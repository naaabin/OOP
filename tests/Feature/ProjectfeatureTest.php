<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ProjectManagerController;

class ProjectfeatureTest extends TestCase
{
    
    //use RefreshDatabase;

    public function test_project_add_using_post_route_by_unauthenciated_user()
    {
        $project = Project::factory()->make();
        $response=$this->post('/projectadd', $project->toArray());
        $response->assertRedirect('/loginform');
    }  
    
    public function test_project_add_using_post_route_by_authenciated_user()
    {
        $user = User::factory()->create();
        $project = Project::factory()->make();
        $response=$this->actingAs($user)->post('/projectadd', $project->toArray());
        $response->assertRedirect('/projectdisplay');
        $this->assertDatabaseHas('projects', $project->toArray());
    }  

    public function test_unauthorized_user_cannot_update_project()
    {     
        $project = Project::factory()->create();

        // make a POST request to the edit-project route
        $response = $this->post('/edit-project', [
            'new_ID' => $project->project_id,
            'note' => 'This is update note',
            'new_project' => 'Updated Nabin project',
            'new_description' => 'This is new updated Nabin project',
        ]);

        // Assert that the project was updated
        $this->assertDatabaseMissing('projects', [
            'project_id' => $project->project_id,
            'project_name' => 'Updated Nabin project',
            'description' => 'This is new updated Nabin project',
        ]);

        // Assert that a new note was created
        $this->assertDatabaseMissing('pnotes', [
            'project_id' => $project->project_id,
            'Description' => 'This is update note',
        ]);

        // Assert the response
        $response->assertRedirect('/loginform');
    }

    public function test_authorized_user_can_only_update_project()
    {     
       
        $user = User::factory()->create();
        $project = Project::factory()->create();

        // Act as the user and make a POST request to the edit-project route
        $response = $this->actingAs($user)->post('/edit-project', [
            'new_ID' => $project->project_id,
            'note' => 'This is update note',
            'new_project' => 'Updated Nabin project',
            'new_description' => 'This is new updated Nabin project',
        ]);

        // Assert that the project was updated
        $this->assertDatabaseHas('projects', [
            'project_id' => $project->project_id,
            'project_name' => 'Updated Nabin project',
            'description' => 'This is new updated Nabin project',
        ]);

        // Assert that a new note was created
        $this->assertDatabaseHas('pnotes', [
            'project_id' => $project->project_id,
            'Description' => 'This is update note',
        ]);

        // Assert the response
        $response->assertRedirect('/projectdisplay');
    }

    public function test_authorized_user_can_only_delete_project()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $response = $this->actingAs($user)->get("/delete-project?project_id={$project->project_id}");
        $response->assertRedirect('/projectdisplay');
    }

    public function test_unauthorized_user_cannot_delete_project()
    {
        $project = Project::factory()->create();
        $response = $this->get("/delete-project?project_id={$project->project_id}");
        $response->assertRedirect('/loginform');
    }


}

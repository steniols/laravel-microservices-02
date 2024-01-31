<?php

namespace Tests\Feature\Api;

use App\Models\Evaluation;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EvaluatioTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function test_get_evaluations_empty(): void
    {
        $response = $this->getJson('/evaluations/fake-company');

        $response->assertStatus(200)
                    ->assertJsonCount(0, 'data');
    }

    public function test_get_evaluations_company(): void
    {
        $company = (string) Str::uuid();
        $evaluations = Evaluation::factory()->count(6)->create([
            'company' => $company
        ]);

        $response = $this->getJson("/evaluations/{$company}");

        $response->assertStatus(200)
                    ->assertJsonCount(6, 'data');
    }

    public function test_error_store_evaluation(): void
    {
        $company = 'fake-company';

        $response = $this->postJson("/evaluations/{$company}", []);

        $response->assertStatus(422);
    }

    public function test_store_evaluation(): void
    {
        $company = 'fake-company';

        $response = $this->postJson("/evaluations/{$company}", [
            'company' => (string) Str::uuid(),
            'comment' => 'New comment',
            'stars' => 5
        ]);

        if($response->getStatusCode() == 404) {
            $response->assertStatus(404);
        } else {
            $response->assertStatus(500);
        }
    }
}

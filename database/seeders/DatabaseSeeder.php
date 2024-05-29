<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\PipelineStage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $this->call([
            LeadSeeder::class,
            TagSeeder::class,
            PipelineStagesSeeder::class,
        ]);

        $defaultPipelineStage = PipelineStage::where('is_default', true)->first()->id;

        Customer::factory()->count(10)->create([
            'pipeline_stage_id' => $defaultPipelineStage,
        ]);
    }
}

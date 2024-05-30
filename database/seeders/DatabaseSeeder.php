<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\PipelineStage;
use App\Models\Role;
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
        $this->call([
            LeadSeeder::class,
            TagSeeder::class,
            PipelineStagesSeeder::class,
            CustomFieldSeeder::class,
            RoleSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => Role::where('name', 'Admin')->first()->id,
        ]);

        User::factory()->count(10)->create([
            'role_id' => Role::where('name', 'Employee')->first()->id,
        ]);

        $defaultPipelineStage = PipelineStage::where('is_default', true)->first()->id;

        Customer::factory()->count(10)->create([
            'pipeline_stage_id' => $defaultPipelineStage,
        ]);
    }
}

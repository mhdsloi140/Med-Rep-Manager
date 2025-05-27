<?php

namespace Database\Factories;

use App\Models\SuperAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SuperAdminFatoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>'super admin',
            'email'=>'superadmin@gimal.com',
            'password'=>bcrypt('password'),
            'userable_type'=>'App\Models\SuperAdmin'
        ];
    }
}

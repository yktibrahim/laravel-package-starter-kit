<?php

namespace LaravelPackageStarterKit\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelPackageStarterKit\Models\LaravelPackageStarterKitModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\LaravelPackageStarterKit\Models\LaravelPackageStarterKitModel>
 */
class LaravelPackageStarterKitModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LaravelPackageStarterKitModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
} 
<?php

namespace Database\Factories;

use App\Models\Execution;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExecutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Execution::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'command_id' => $this->faker->randomDigitNotNull,
        'command' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'user_id' => $this->faker->randomDigitNotNull,
        'success' => $this->faker->word,
        'output' => $this->faker->text,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}

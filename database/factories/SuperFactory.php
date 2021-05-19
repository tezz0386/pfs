<?php

namespace Database\Factories;

use App\Models\Super;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Super::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>'Tejendra Dangaura',
            'email' => 'dangaura.tejendra.123@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('tezz0386'),
            'remember_token' => Str::random(10),
            'ph_no'=>'9805777500',
            'address'=>'Sukhad Kailali',
        ];
    }
}

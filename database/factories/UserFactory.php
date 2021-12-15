<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => 'Admin',
            'telepon' => '0855886644',
            'email' => 'makanbakcang@gmail.com',
            'tipe_pengguna' => 'Super_Admin', // password
            'username' => 'Admin',
            'password' => '$2a$12$p4rNuvf5.mpF8PxOvZezQ.ebhxJ526J9nbw/HPG2wmNBV880PaeQC',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

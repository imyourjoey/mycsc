<?php


namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;




/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    protected $model = User::class;


    public function definition()
    {


        return [
            'name' => 'Joey Lim Jun Yi',
            'email' => 'joey@gmail.com',
            'icNum' => '000119050057',
            'phoneNo' => '019-9929292',
            'password' => bcrypt('88888888'), 
            'userTag' =>'AD001',
            'role' => 'admin',
            'emailVerified' => 1, 

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

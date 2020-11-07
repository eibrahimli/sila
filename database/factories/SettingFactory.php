<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Sila Expresss',
            'desc' => 'sila,express,sila express',
            'keyw' => 'sila,express,sila express',
            'email' => 'ibrahimlielvir@gmail.com',
            'adress' => 'Ashiq Molla Cume, 22',
            'number' => '(99451)-629-18-68',
            'social' => 'https://fb.com/sila|||https://instagram.com|||https://twitter.com|||https://google.com',
            'logo' => 'uploads/RYk3aSc39KEu0a0ENxRnI7tWu8w2JjdziF9swJ28.svg',            
        ];
    }
}

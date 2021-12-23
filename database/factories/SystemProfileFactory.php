<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SystemProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'church_name'=>'St. Paul The Apostle',
            'church_address'=>'Buhi, Camarines Sur',
            'church_logo'=>'',
            
        ];
    }
}

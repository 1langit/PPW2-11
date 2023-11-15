<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Buku;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Buku::class;
    
    public function definition()
    {
        return [
            'judul' => $this->faker->text($maxNbChars = 12),
            'penulis' => $this->faker->name(),
            'tgl_terbit' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'harga' => $this->faker->randomNumber($nbDigits = null, $strict = false)
        ];
    }
}

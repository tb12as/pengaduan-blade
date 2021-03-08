<?php

namespace Database\Factories;

use App\Models\Pengaduan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PengaduanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pengaduan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 2,
            'isi_laporan' => $this->faker->sentence(40),
            'slug' => 'laporan-masyarakat-'.Str::random(20)
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Produto;
use App\Models\Subcategoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->words(3,true),
            'valor' => $this->faker->randomFloat(2),
            'descricao' => $this->faker->paragraph,
            'imagem' => $this->faker->imageUrl(320,240),
            'subcategoria_id' => rand(1,2),
            'is_active' => rand(0,1),
            'subcategoria_id' => Subcategoria::inRandomOrder()->first()->id,
        ];
    }
}

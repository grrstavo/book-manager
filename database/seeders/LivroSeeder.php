<?php

namespace Database\Seeders;

use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Livro::factory()->count(10)->create()->each(function ($livro) {
            $livro->assuntos()->attach(Assunto::all()->random(rand(1,5))->pluck('codAs'));
            $livro->autores()->attach(Autor::all()->random(rand(1,3))->pluck('CodAu'));
        });
    }
}

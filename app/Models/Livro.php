<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'Livro';

    public $timestamps = false;

    protected $primaryKey = 'Codl';

    protected $fillable = [
        'Titulo',
        'Editora',
        'Edicao',
        'AnoPublicacao',
        'Valor'
    ];

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'Livro_Codl', 'Assunto_codAs');
    }

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'Livro_Autor', 'Livro_Codl', 'Autor_CodAu');
    }
}

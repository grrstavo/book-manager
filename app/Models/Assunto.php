<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    protected $table = 'Assunto';

    public $timestamps = false;

    protected $primaryKey = 'codAs';

    protected $fillable = [
        'Descricao',
    ];

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'Livro_Assunto', 'Assunto_codAs', 'Livro_Codl');
    }
}

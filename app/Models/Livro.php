<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Livro
 *
 * Represents a book in the system with its associated metadata.
 * This model handles relationships with authors and subjects through pivot tables.
 *
 * @package App\Models
 */
class Livro extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Livro';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'Codl';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'Titulo',
        'Editora',
        'Edicao',
        'AnoPublicacao',
        'Valor'
    ];

    /**
     * Get the subjects associated with this book.
     *
     * This method defines a many-to-many relationship between books and subjects
     * through the 'Livro_Assunto' pivot table.
     *
     * @return BelongsToMany<Assunto>
     */
    public function assuntos(): BelongsToMany
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'Livro_Codl', 'Assunto_codAs');
    }

    /**
     * Get the authors associated with this book.
     *
     * This method defines a many-to-many relationship between books and authors
     * through the 'Livro_Autor' pivot table.
     *
     * @return BelongsToMany<Autor>
     */
    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'Livro_Autor', 'Livro_Codl', 'Autor_CodAu');
    }
}

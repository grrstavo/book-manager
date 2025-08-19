<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Autor
 *
 * Represents an author that can be associated with books.
 * This model handles the relationship between authors and books through a pivot table.
 *
 * @package App\Models
 */
class Autor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Autor';

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
    protected $primaryKey = 'CodAu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'Nome',
    ];

    /**
     * Get the books associated with this author.
     *
     * This method defines a many-to-many relationship between authors and books
     * through the 'Livro_Autor' pivot table.
     *
     * @return BelongsToMany<Livro>
     */
    public function livros(): BelongsToMany
    {
        return $this->belongsToMany(Livro::class, 'Livro_Autor', 'Autor_CodAu', 'Livro_Codl');
    }
}

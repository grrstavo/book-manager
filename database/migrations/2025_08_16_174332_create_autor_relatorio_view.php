<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            'CREATE OR REPLACE VIEW vw_relatorio_autor AS
            SELECT 
                a.CodAu AS autor_id,
                a.Nome AS autor_nome,
                COUNT(DISTINCT l.Codl) AS total_livros,
                SUM(l.Valor) AS total_valor,
                COUNT(DISTINCT las.Assunto_codAs) AS total_assuntos
            FROM Autor a
            JOIN Livro_Autor la ON a.CodAu = la.Autor_CodAu
            JOIN Livro l ON la.Livro_Codl = l.Codl
            LEFT JOIN Livro_Assunto las ON l.Codl = las.Livro_Codl
            GROUP BY a.CodAu, a.Nome;'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW vw_relatorio_autor');
    }
};

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DBConnTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_db_conn_is_working(): void
    {
        $response = DB::select('Select 1');

        $this->assertNotEmpty($response, 'Falló conexión a la base de datos');
    }

    public function test_if_record_exists(): void {
        $this->assertDatabaseHas('usuarios', [
            'idUsuario' => 1,
            'email' => 'fer@gmail.com' 
        ]);
    }
}

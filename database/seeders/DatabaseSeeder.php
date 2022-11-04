<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cuenta;
use App\Models\TipoMon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cuenta::create([
            'Nombre' => 'Billetera',
            'Saldo'=>'0'
        ]);

        TipoMon::create([
            'Nombre' => 'Ingreso',
            'Simbolo' => '+'
        ]);
        TipoMon::create([
            'Nombre' => 'Salida',
            'Simbolo' => '-'
        ]);
        TipoMon::create([
            'Nombre' => 'Trasferencias',
            'Simbolo' => '<=>'
        ]);
    }
}

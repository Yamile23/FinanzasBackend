<?php

namespace Laraveltip\Domain\Factories;


use App\Models\Cuenta;
use Illuminate\Http\Request;

class CuentasFactory
{
    public function create(Request $request): Cuenta
    {
        $nombre = $request->get("Nombre");
        $saldo = $request->get("Saldo");

        return new Cuenta([$nombre, $saldo]);
    }

}

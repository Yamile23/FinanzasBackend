<?php

namespace Laraveltip\Domain\Repository;

use App\Models\Cuenta;

interface ICuentaRepository
{
    public function create(Cuenta $cuenta);

}

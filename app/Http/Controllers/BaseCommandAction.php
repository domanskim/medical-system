<?php

namespace App\Http\Controllers;

use Ecotone\Modelling\CommandBus;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;

class BaseCommandAction extends Controller
{
    protected CommandBus $commandBus;

    public function __construct() {
        $this->commandBus = app(CommandBus::class);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Users\Producer;

use App\Models\RegisteredUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\ProducerResource;


class ProducerController extends Controller
{
    public function prueba(Request $request)
    {
        return "Producer OK";
    }
}

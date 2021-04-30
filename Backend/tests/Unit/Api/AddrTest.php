<?php

namespace Tests\Unit\Api;

use App\Models\RegisteredUser;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class AddrTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_StoreAddr()
    {
        Sanctum::actingAs(
            RegisteredUser::find(1)            
        );           
        
        $response = $this->post('http://localhost:8000/api/v1/addrs',
                     [
                        "data" => [
                            "type" => "Address",
                            "attributes" => [                            
                                "registered_user_id" => 2,
                                "country" => "Colombia",
                                "province" => "Caldas",
                                "city"=> "Salamina",
                                "street" => "Av 55",
                                "location" => "# 10",
                                "etiqueta" => "Casa"
                            ]                        
                        ]
                    ]);                     

        $response->assertStatus(201);
        
    }
}

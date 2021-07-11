<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class ProductControllerTests extends TestCase {
    public function test_ProductIsCreatedSuccessfully() {

        $payload = [
            'code' => 'code1122',
            'name'  => 'name1122',
            'composition' => '100% linho',
            'size' => 'GG'
        ];
        $this->json('post', 'api/products', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'code',
                        'name',
                        'composition',
                        'size'
                    ]
                ]
            );
        $this->assertDatabaseHas('products', $payload);
    }
}

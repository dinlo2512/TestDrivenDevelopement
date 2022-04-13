<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetListProductTest extends TestCase
{
    /** @test */
    public function user_can_get_list_product()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('products.index');
        $response->assertSee($product->name);
    }
}

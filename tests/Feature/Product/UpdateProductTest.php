<?php

namespace Tests\Feature\Product;


use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_view_update_from()
    {
        $this->actingAs(User::factory()->create());
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product->id));
        $response->assertViewIs('products.edit');
    }

    /** @test */
    public function authenticated_user_can_update_from()
    {
        $this->actingAs(User::factory()->create());
        $product = Product::factory()->create();
        $dataProduct = Product::factory()->make()->toArray();

        $response = $this->post(route('products.update', $product->id), $dataProduct);
        $this->assertDatabaseHas('products',$dataProduct);
        $response->assertRedirect(route('products.index'));
    }

}

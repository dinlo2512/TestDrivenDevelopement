<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_view_form_create_new_product()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('products.create'));
        $response->assertViewIs('products.create');
    }

    /** @test */
    public function authenticated_user_can_create_new_product()
    {
        $this->actingAs(User::factory()->create());
        $product = Product::factory()->make()->toArray();

        $response = $this->post(route('products.store'), $product);
        $this->assertDatabaseHas('products', $product);
        $response->assertRedirect(route('products.index'));
    }

    /** @test */
    public function authenticated_user_can_not_create_new_product_if_data_null()
    {
        $this->actingAs(User::factory()->create());
        $product = Product::factory()->make(['name' => null])->toArray();

        $response = $this->post(route('products.create'), $product);
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function unauthenticated_user_can_not_create_new_product()
    {
        $product = Product::factory()->make()->toArray();

        $response = $this->post(route('products.store'), $product);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function unauthenticated_user_can_not_view_form_new_product()
    {
        $product = Product::factory()->make()->toArray();

        $response = $this->get(route('products.create'));
        $response->assertRedirect('/login');
    }

}

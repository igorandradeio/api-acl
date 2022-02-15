<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = Resource::create(['name' => 'Posts']);
        $post->permissions()->create(['name' => 'view_posts']);
        $post->permissions()->create(['name' => 'view_post']);
        $post->permissions()->create(['name' => 'edit_post']);
        $post->permissions()->create(['name' => 'delete_post']);

        $product = Resource::create(['name' => 'Products']);
        $product->permissions()->create(['name' => 'view_products']);
        $product->permissions()->create(['name' => 'view_product']);
        $product->permissions()->create(['name' => 'edit_product']);
        $product->permissions()->create(['name' => 'delete_product']);

        $admins = Resource::create(['name' => 'Admins']);
        $admins->permissions()->create(['name' => 'users']);
        $admins->permissions()->create(['name' => 'add_permissions_user']);
    }
}

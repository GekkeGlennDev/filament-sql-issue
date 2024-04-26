<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory(50)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        User::factory(10)
            ->create()
            ->each(function ($user) {
                // create some order
                $order = Order::factory()->create([
                    'user_id' => $user->id,
                ]);

                // Assign some products to the order
                Product::query()
                    ->inRandomOrder()
                    ->take(rand(1, 5))
                    ->get()
                    ->each(function ($product) use ($order) {
                        $quantity = rand(1, 2);

                        $product
                            ->orders()
                            ->attach($order->id, [
                                'quantity' => $quantity,
                                'price' => $product->price * $quantity,
                            ]);
                    });
            });

    }
}

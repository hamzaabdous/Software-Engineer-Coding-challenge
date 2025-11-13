<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Modules\CartItems\Models\CartItems;
use App\Models\User;
use App\Modules\CartReminderLogs\Models\CartReminderLogs;
use App\Modules\Products\Models\Products;
use App\Modules\Carts\Models\Carts;
use Carbon\Carbon;

class CartReminderTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create or get a test user
        $user = User::firstOrCreate(
            ['email' => 'testuser@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        // Create or get a test product
        $product = Products::firstOrCreate(
            ['name' => 'Test Product'],
            ['description' => 'Seeded test product', 'price' => 29.99, 'stock' => 10]
        );

        // Create a cart that is not finalized
        $cart = Carts::create([
            'user_id' => $user->id,
            'is_finalized' => false,
        ]);

        // Backdate the cart creation time (3 hours ago)
        $cart->update(['created_at' => Carbon::now()->subHours(3)]);

        // Add an item to the cart
        CartItems::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        echo "✅ Seeded cart ID: {$cart->id} for user: {$user->email}\n";
    }
}

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
        $user = User::firstOrCreate(
            ['email' => 'three-stage@example.com'],
            ['name' => 'Three Stage User', 'password' => bcrypt('password')]
        );

        $product = Products::firstOrCreate(
            ['name' => 'Reminder Test Product'],
            ['description' => 'Used for reminder stage testing', 'price' => 49.99, 'stock' => 50]
        );

        $cart = Carts::create([
            'user_id' => $user->id,
            'is_finalized' => false,
        ]);

        \DB::table('carts')->where('id', $cart->id)->update([
            'created_at' => Carbon::now()->subDays(4)->toDateTimeString(),
        ]);

        CartItems::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        CartReminderLogs::create([
            'cart_id' => $cart->id,
            'reminder_number' => 1,
            'sent_at' => Carbon::now()->subDays(3), 
        ]);

        CartReminderLogs::create([
            'cart_id' => $cart->id,
            'reminder_number' => 2,
            'sent_at' => Carbon::now()->subDays(1), 
        ]);

        echo "🛒 Cart ID {$cart->id} with 2 reminder logs created for 3rd reminder test.\n";
    }
}

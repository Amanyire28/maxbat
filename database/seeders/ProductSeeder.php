<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Premium Engine Lubricants',
                'category'    => 'Engine Care',
                'description' => 'Full synthetic, semi-synthetic and mineral engine oils in all viscosity grades. Suitable for petrol, diesel and turbocharged engines. Brands include Castrol, Mobil 1, Shell Helix and more.',
                'price'       => 'From UGX 45,000',
                'badge'       => 'In Stock',
                'image'       => null,
                'active'      => true,
            ],
            [
                'name'        => 'Differential & Gearbox Fluid',
                'category'    => 'Drivetrain Fluids',
                'description' => 'High-performance differential and transmission fluids for manual gearboxes, automatic transmissions, transfer cases and axle differentials. Reduces wear and improves shift quality.',
                'price'       => 'From UGX 38,000',
                'badge'       => 'In Stock',
                'image'       => null,
                'active'      => true,
            ],
            [
                'name'        => 'Android Car Screens',
                'category'    => 'Car Electronics',
                'description' => '7" to 12" Android head units with GPS navigation, Bluetooth, Wi-Fi, Apple CarPlay and Android Auto. Vehicle-specific fitment available for all major car brands. Includes reverse camera input.',
                'price'       => 'From UGX 320,000',
                'badge'       => 'Best Seller',
                'image'       => null,
                'active'      => true,
            ],
            [
                'name'        => 'Car Speakers',
                'category'    => 'Car Audio',
                'description' => 'Component and coaxial speakers in 4", 5.25", 6.5" and 6x9" sizes. Brands include Pioneer, JBL, Kenwood and Focal. From everyday replacements to full audiophile setups — we stock and install them all.',
                'price'       => 'From UGX 85,000',
                'badge'       => 'New Arrivals',
                'image'       => null,
                'active'      => true,
            ],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(['name' => $p['name']], $p);
        }

        $this->command->info('Products seeded: ' . count($products) . ' products.');
    }
}

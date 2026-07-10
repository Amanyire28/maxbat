<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name'=>'Key Programming',           'icon'=>'fa-key',        'description'=>'Key cutting, transponder programming, key cloning, immobiliser bypass and all-keys-lost solutions for all vehicle makes.','sort_order'=>1],
            ['name'=>'ECU Programming',           'icon'=>'fa-microchip',  'description'=>'Full ECU read/write, virgin ECU programming, module coding and software updates across all major platforms.','sort_order'=>2],
            ['name'=>'Gearbox / TCU Programming', 'icon'=>'fa-cogs',       'description'=>'Transmission control unit programming, gearbox adaptation, DSG/DCT tuning and automatic gearbox resets.','sort_order'=>3],
            ['name'=>'ECU Tuning',                'icon'=>'fa-sliders-h',  'description'=>'Custom engine management calibration for maximum power, torque and efficiency. Stage 1, 2 & 3 maps available.','sort_order'=>4],
            ['name'=>'Vehicle Diagnostics',       'icon'=>'fa-stethoscope','description'=>'Full OBD-II diagnostics, live data analysis, fault code clearing and comprehensive vehicle health reports.','sort_order'=>5],
            ['name'=>'Performance Upgrades',      'icon'=>'fa-bolt',       'description'=>'Intake systems, intercoolers, upgraded injectors, forged internals — full performance build packages.','sort_order'=>6],
            ['name'=>'Turbo Systems',             'icon'=>'fa-wind',       'description'=>'Turbocharger upgrades, hybrid turbos, full turbo kits, wastegate tuning and blow-off valve installations.','sort_order'=>7],
            ['name'=>'Exhaust Systems',           'icon'=>'fa-fire',       'description'=>'Cat-back, downpipes, sports catalysts, Akrapovič and custom stainless systems for sound and performance.','sort_order'=>8],
            ['name'=>'Auto Electronics',          'icon'=>'fa-plug',       'description'=>'Audio upgrades, Android head units, reverse cameras, dashcams, parking sensors and custom wiring.','sort_order'=>9],
            ['name'=>'Maintenance Services',      'icon'=>'fa-tools',      'description'=>'Oil changes, brake service, timing belt and chain, suspension, full major and minor vehicle servicing.','sort_order'=>10],
            ['name'=>'Fleet Solutions',           'icon'=>'fa-truck',      'description'=>'Fleet diagnostics, maintenance contracts, bulk ECU optimisation and solutions for commercial fleets.','sort_order'=>11],
        ];

        foreach ($services as $s) {
            Service::firstOrCreate(
                ['name' => $s['name']],
                array_merge($s, ['active' => true])
            );
        }

        $this->command->info('Services seeded: ' . count($services) . ' services.');
    }
}

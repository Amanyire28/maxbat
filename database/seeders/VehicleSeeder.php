<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;
use App\Models\VehicleBrand;
use App\Models\VehicleSeries;
use App\Models\VehicleModel;
use App\Models\VehicleEngine;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // ── DATA STRUCTURE ──────────────────────────────────────────────
        // type → brands → series → models → engines
        $data = [
            'Car' => [
                'BMW' => [
                    '3 Series' => [
                        ['name' => '318i', 'year_range' => '2015-2023', 'engines' => [
                            ['name' => '1.5T 136hp', 'displacement' => '1.5L', 'power' => '136hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => '320i', 'year_range' => '2012-2023', 'engines' => [
                            ['name' => '2.0T 184hp', 'displacement' => '2.0L', 'power' => '184hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => '320d', 'year_range' => '2012-2023', 'engines' => [
                            ['name' => '2.0d 150hp', 'displacement' => '2.0L', 'power' => '150hp', 'fuel_type' => 'Diesel'],
                            ['name' => '2.0d 190hp', 'displacement' => '2.0L', 'power' => '190hp', 'fuel_type' => 'Diesel'],
                        ]],
                        ['name' => '330i', 'year_range' => '2016-2023', 'engines' => [
                            ['name' => '2.0T 258hp', 'displacement' => '2.0L', 'power' => '258hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'M3', 'year_range' => '2014-2023', 'engines' => [
                            ['name' => '3.0 BiTurbo 431hp', 'displacement' => '3.0L', 'power' => '431hp', 'fuel_type' => 'Petrol'],
                            ['name' => '3.0 BiTurbo 503hp (Competition)', 'displacement' => '3.0L', 'power' => '503hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                    '5 Series' => [
                        ['name' => '520i', 'year_range' => '2010-2024', 'engines' => [
                            ['name' => '2.0T 184hp', 'displacement' => '2.0L', 'power' => '184hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => '530d', 'year_range' => '2010-2024', 'engines' => [
                            ['name' => '3.0d 258hp', 'displacement' => '3.0L', 'power' => '258hp', 'fuel_type' => 'Diesel'],
                            ['name' => '3.0d 286hp', 'displacement' => '3.0L', 'power' => '286hp', 'fuel_type' => 'Diesel'],
                        ]],
                        ['name' => '540i', 'year_range' => '2016-2024', 'engines' => [
                            ['name' => '3.0T 340hp', 'displacement' => '3.0L', 'power' => '340hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'M5', 'year_range' => '2011-2024', 'engines' => [
                            ['name' => '4.4 V8 BiTurbo 560hp', 'displacement' => '4.4L', 'power' => '560hp', 'fuel_type' => 'Petrol'],
                            ['name' => '4.4 V8 BiTurbo 600hp (Competition)', 'displacement' => '4.4L', 'power' => '600hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                    'M Series' => [
                        ['name' => 'M2', 'year_range' => '2016-2024', 'engines' => [
                            ['name' => '3.0 BiTurbo 370hp', 'displacement' => '3.0L', 'power' => '370hp', 'fuel_type' => 'Petrol'],
                            ['name' => '3.0 BiTurbo 460hp (Competition)', 'displacement' => '3.0L', 'power' => '460hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'M4', 'year_range' => '2014-2024', 'engines' => [
                            ['name' => '3.0 BiTurbo 431hp', 'displacement' => '3.0L', 'power' => '431hp', 'fuel_type' => 'Petrol'],
                            ['name' => '3.0 BiTurbo 503hp (Competition)', 'displacement' => '3.0L', 'power' => '503hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                ],
                'Mercedes-Benz' => [
                    'C-Class' => [
                        ['name' => 'C180', 'year_range' => '2011-2023', 'engines' => [
                            ['name' => '1.6T 156hp', 'displacement' => '1.6L', 'power' => '156hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'C200', 'year_range' => '2011-2023', 'engines' => [
                            ['name' => '1.5T 184hp', 'displacement' => '1.5L', 'power' => '184hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0T 204hp', 'displacement' => '2.0L', 'power' => '204hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'C220d', 'year_range' => '2011-2023', 'engines' => [
                            ['name' => '2.0d 194hp', 'displacement' => '2.0L', 'power' => '194hp', 'fuel_type' => 'Diesel'],
                        ]],
                        ['name' => 'C63 AMG', 'year_range' => '2011-2023', 'engines' => [
                            ['name' => '4.0 V8 BiTurbo 476hp', 'displacement' => '4.0L', 'power' => '476hp', 'fuel_type' => 'Petrol'],
                            ['name' => '4.0 V8 BiTurbo 510hp (S)', 'displacement' => '4.0L', 'power' => '510hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                    'E-Class' => [
                        ['name' => 'E200', 'year_range' => '2009-2024', 'engines' => [
                            ['name' => '2.0T 184hp', 'displacement' => '2.0L', 'power' => '184hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'E220d', 'year_range' => '2009-2024', 'engines' => [
                            ['name' => '2.0d 194hp', 'displacement' => '2.0L', 'power' => '194hp', 'fuel_type' => 'Diesel'],
                        ]],
                        ['name' => 'E63 AMG', 'year_range' => '2009-2024', 'engines' => [
                            ['name' => '4.0 V8 BiTurbo 571hp', 'displacement' => '4.0L', 'power' => '571hp', 'fuel_type' => 'Petrol'],
                            ['name' => '4.0 V8 BiTurbo 612hp (S)', 'displacement' => '4.0L', 'power' => '612hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                ],
                'Volkswagen' => [
                    'Golf' => [
                        ['name' => 'Golf 7', 'year_range' => '2012-2019', 'engines' => [
                            ['name' => '1.0 TSI 85hp', 'displacement' => '1.0L', 'power' => '85hp', 'fuel_type' => 'Petrol'],
                            ['name' => '1.4 TSI 125hp', 'displacement' => '1.4L', 'power' => '125hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0 TSI GTI 230hp', 'displacement' => '2.0L', 'power' => '230hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0 TDI 150hp', 'displacement' => '2.0L', 'power' => '150hp', 'fuel_type' => 'Diesel'],
                        ]],
                        ['name' => 'Golf 8', 'year_range' => '2019-2024', 'engines' => [
                            ['name' => '1.0 eTSI 110hp', 'displacement' => '1.0L', 'power' => '110hp', 'fuel_type' => 'Petrol'],
                            ['name' => '1.5 TSI 150hp', 'displacement' => '1.5L', 'power' => '150hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0 TSI GTI 245hp', 'displacement' => '2.0L', 'power' => '245hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0 TDI 150hp', 'displacement' => '2.0L', 'power' => '150hp', 'fuel_type' => 'Diesel'],
                        ]],
                        ['name' => 'Golf R', 'year_range' => '2013-2024', 'engines' => [
                            ['name' => '2.0 TSI 310hp', 'displacement' => '2.0L', 'power' => '310hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0 TSI 333hp', 'displacement' => '2.0L', 'power' => '333hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                    'Passat' => [
                        ['name' => 'Passat B8', 'year_range' => '2015-2023', 'engines' => [
                            ['name' => '1.5 TSI 150hp', 'displacement' => '1.5L', 'power' => '150hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0 TDI 150hp', 'displacement' => '2.0L', 'power' => '150hp', 'fuel_type' => 'Diesel'],
                            ['name' => '2.0 TDI 190hp', 'displacement' => '2.0L', 'power' => '190hp', 'fuel_type' => 'Diesel'],
                        ]],
                    ],
                ],
                'Audi' => [
                    'A4' => [
                        ['name' => 'A4 B8', 'year_range' => '2007-2015', 'engines' => [
                            ['name' => '1.8 TFSI 120hp', 'displacement' => '1.8L', 'power' => '120hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0 TFSI 180hp', 'displacement' => '2.0L', 'power' => '180hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0 TDI 143hp', 'displacement' => '2.0L', 'power' => '143hp', 'fuel_type' => 'Diesel'],
                        ]],
                        ['name' => 'A4 B9', 'year_range' => '2015-2024', 'engines' => [
                            ['name' => '2.0 TFSI 190hp', 'displacement' => '2.0L', 'power' => '190hp', 'fuel_type' => 'Petrol'],
                            ['name' => '2.0 TDI 150hp', 'displacement' => '2.0L', 'power' => '150hp', 'fuel_type' => 'Diesel'],
                            ['name' => '2.0 TDI 190hp', 'displacement' => '2.0L', 'power' => '190hp', 'fuel_type' => 'Diesel'],
                        ]],
                    ],
                    'RS' => [
                        ['name' => 'RS3', 'year_range' => '2015-2024', 'engines' => [
                            ['name' => '2.5 TFSI 400hp', 'displacement' => '2.5L', 'power' => '400hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'RS4', 'year_range' => '2012-2024', 'engines' => [
                            ['name' => '2.9 BiTurbo V6 450hp', 'displacement' => '2.9L', 'power' => '450hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'RS6', 'year_range' => '2013-2024', 'engines' => [
                            ['name' => '4.0 TFSI V8 560hp', 'displacement' => '4.0L', 'power' => '560hp', 'fuel_type' => 'Petrol'],
                            ['name' => '4.0 TFSI V8 630hp (Performance)', 'displacement' => '4.0L', 'power' => '630hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                ],
            ],
            'SUV' => [
                'Toyota' => [
                    'Land Cruiser' => [
                        ['name' => 'LC 200', 'year_range' => '2007-2021', 'engines' => [
                            ['name' => '4.5 V8 TD 235hp', 'displacement' => '4.5L', 'power' => '235hp', 'fuel_type' => 'Diesel'],
                            ['name' => '4.7 V8 288hp', 'displacement' => '4.7L', 'power' => '288hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'LC 300', 'year_range' => '2021-2024', 'engines' => [
                            ['name' => '3.5 V6 Twin Turbo 415hp', 'displacement' => '3.5L', 'power' => '415hp', 'fuel_type' => 'Petrol'],
                            ['name' => '3.3 V6 TD 309hp', 'displacement' => '3.3L', 'power' => '309hp', 'fuel_type' => 'Diesel'],
                        ]],
                    ],
                    'Prado' => [
                        ['name' => 'Prado 150', 'year_range' => '2009-2024', 'engines' => [
                            ['name' => '2.7 VVT-i 163hp', 'displacement' => '2.7L', 'power' => '163hp', 'fuel_type' => 'Petrol'],
                            ['name' => '3.0 D4D 163hp', 'displacement' => '3.0L', 'power' => '163hp', 'fuel_type' => 'Diesel'],
                            ['name' => '2.8 D4D 204hp', 'displacement' => '2.8L', 'power' => '204hp', 'fuel_type' => 'Diesel'],
                        ]],
                    ],
                ],
                'BMW' => [
                    'X5' => [
                        ['name' => 'X5 E70', 'year_range' => '2006-2013', 'engines' => [
                            ['name' => '3.0d 235hp', 'displacement' => '3.0L', 'power' => '235hp', 'fuel_type' => 'Diesel'],
                            ['name' => '4.8i 355hp', 'displacement' => '4.8L', 'power' => '355hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'X5 F15', 'year_range' => '2013-2018', 'engines' => [
                            ['name' => '3.0d 258hp', 'displacement' => '3.0L', 'power' => '258hp', 'fuel_type' => 'Diesel'],
                            ['name' => '4.4 V8 450hp (M50d)', 'displacement' => '4.4L', 'power' => '450hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'X5 G05', 'year_range' => '2018-2024', 'engines' => [
                            ['name' => '3.0 xDrive40i 340hp', 'displacement' => '3.0L', 'power' => '340hp', 'fuel_type' => 'Petrol'],
                            ['name' => '3.0d xDrive30d 286hp', 'displacement' => '3.0L', 'power' => '286hp', 'fuel_type' => 'Diesel'],
                            ['name' => '4.4 V8 M60i 530hp', 'displacement' => '4.4L', 'power' => '530hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                    'X6' => [
                        ['name' => 'X6 F16', 'year_range' => '2014-2019', 'engines' => [
                            ['name' => '3.0d 258hp', 'displacement' => '3.0L', 'power' => '258hp', 'fuel_type' => 'Diesel'],
                            ['name' => '4.4 V8 450hp', 'displacement' => '4.4L', 'power' => '450hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'X6 G06', 'year_range' => '2019-2024', 'engines' => [
                            ['name' => '3.0 xDrive40i 340hp', 'displacement' => '3.0L', 'power' => '340hp', 'fuel_type' => 'Petrol'],
                            ['name' => '4.4 V8 M60i 530hp', 'displacement' => '4.4L', 'power' => '530hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                ],
                'Mercedes-Benz' => [
                    'GLE' => [
                        ['name' => 'GLE W166', 'year_range' => '2015-2019', 'engines' => [
                            ['name' => 'GLE 300d 258hp', 'displacement' => '3.0L', 'power' => '258hp', 'fuel_type' => 'Diesel'],
                            ['name' => 'GLE 400 333hp', 'displacement' => '3.0L', 'power' => '333hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'GLE W167', 'year_range' => '2019-2024', 'engines' => [
                            ['name' => 'GLE 350d 272hp', 'displacement' => '3.0L', 'power' => '272hp', 'fuel_type' => 'Diesel'],
                            ['name' => 'AMG GLE 53 435hp', 'displacement' => '3.0L', 'power' => '435hp', 'fuel_type' => 'Petrol'],
                            ['name' => 'AMG GLE 63 S 612hp', 'displacement' => '4.0L', 'power' => '612hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                    'G-Class' => [
                        ['name' => 'G63 AMG W463', 'year_range' => '2012-2024', 'engines' => [
                            ['name' => '5.5 V8 BiTurbo 544hp', 'displacement' => '5.5L', 'power' => '544hp', 'fuel_type' => 'Petrol'],
                            ['name' => '4.0 V8 BiTurbo 585hp', 'displacement' => '4.0L', 'power' => '585hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                ],
                'Range Rover' => [
                    'Range Rover' => [
                        ['name' => 'Range Rover L405', 'year_range' => '2012-2021', 'engines' => [
                            ['name' => '3.0 TDV6 258hp', 'displacement' => '3.0L', 'power' => '258hp', 'fuel_type' => 'Diesel'],
                            ['name' => '4.4 SDV8 340hp', 'displacement' => '4.4L', 'power' => '340hp', 'fuel_type' => 'Diesel'],
                            ['name' => '5.0 V8 SC 510hp', 'displacement' => '5.0L', 'power' => '510hp', 'fuel_type' => 'Petrol'],
                        ]],
                        ['name' => 'Range Rover L460', 'year_range' => '2021-2024', 'engines' => [
                            ['name' => '3.0 D300 300hp', 'displacement' => '3.0L', 'power' => '300hp', 'fuel_type' => 'Diesel'],
                            ['name' => '4.4 P530 530hp', 'displacement' => '4.4L', 'power' => '530hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                    'Sport' => [
                        ['name' => 'Range Rover Sport L494', 'year_range' => '2013-2022', 'engines' => [
                            ['name' => '3.0 SDV6 306hp', 'displacement' => '3.0L', 'power' => '306hp', 'fuel_type' => 'Diesel'],
                            ['name' => '5.0 V8 SC SVR 575hp', 'displacement' => '5.0L', 'power' => '575hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                ],
            ],
            'Truck' => [
                'Toyota' => [
                    'Hilux' => [
                        ['name' => 'Hilux Revo (AN120)', 'year_range' => '2015-2024', 'engines' => [
                            ['name' => '2.4 GD-6 150hp', 'displacement' => '2.4L', 'power' => '150hp', 'fuel_type' => 'Diesel'],
                            ['name' => '2.8 GD-6 204hp', 'displacement' => '2.8L', 'power' => '204hp', 'fuel_type' => 'Diesel'],
                        ]],
                    ],
                ],
                'Ford' => [
                    'Ranger' => [
                        ['name' => 'Ranger T6', 'year_range' => '2011-2022', 'engines' => [
                            ['name' => '2.2 TDCi 150hp', 'displacement' => '2.2L', 'power' => '150hp', 'fuel_type' => 'Diesel'],
                            ['name' => '3.2 TDCi 200hp', 'displacement' => '3.2L', 'power' => '200hp', 'fuel_type' => 'Diesel'],
                        ]],
                        ['name' => 'Ranger T7', 'year_range' => '2022-2024', 'engines' => [
                            ['name' => '2.0 TDCi 170hp', 'displacement' => '2.0L', 'power' => '170hp', 'fuel_type' => 'Diesel'],
                            ['name' => '3.0 V6 Raptor 288hp', 'displacement' => '3.0L', 'power' => '288hp', 'fuel_type' => 'Petrol'],
                        ]],
                    ],
                ],
            ],
        ];

        $typeOrder = 0;
        foreach ($data as $typeName => $brands) {
            $type = VehicleType::create(['name' => $typeName, 'sort_order' => ++$typeOrder]);
            $brandOrder = 0;
            foreach ($brands as $brandName => $seriesList) {
                $brand = VehicleBrand::create([
                    'vehicle_type_id' => $type->id,
                    'name'            => $brandName,
                    'sort_order'      => ++$brandOrder,
                ]);
                $seriesOrder = 0;
                foreach ($seriesList as $seriesName => $models) {
                    $series = VehicleSeries::create([
                        'vehicle_brand_id' => $brand->id,
                        'name'             => $seriesName,
                        'sort_order'       => ++$seriesOrder,
                    ]);
                    $modelOrder = 0;
                    foreach ($models as $modelData) {
                        $model = VehicleModel::create([
                            'vehicle_series_id' => $series->id,
                            'name'              => $modelData['name'],
                            'year_range'        => $modelData['year_range'] ?? null,
                            'sort_order'        => ++$modelOrder,
                        ]);
                        $engineOrder = 0;
                        foreach ($modelData['engines'] as $eng) {
                            VehicleEngine::create([
                                'vehicle_model_id' => $model->id,
                                'name'             => $eng['name'],
                                'displacement'     => $eng['displacement'] ?? null,
                                'power'            => $eng['power'] ?? null,
                                'fuel_type'        => $eng['fuel_type'] ?? null,
                                'sort_order'       => ++$engineOrder,
                            ]);
                        }
                    }
                }
            }
        }
    }
}

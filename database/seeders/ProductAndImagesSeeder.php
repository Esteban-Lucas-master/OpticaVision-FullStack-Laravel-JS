<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAndImagesSeeder extends Seeder
{
    public function run()
    {
        // Insertar productos
        DB::table('products')->insert([
            [
                'id' => 10,
                'name' => 'gafas arnette',
                'description' => 'Estilo urbano y moderno, diseñadas para ofrecer comodidad y resistencia.',
                'price' => 15000.00,
                'seller_id' => 2,
                'on_offer' => 0,
            ],
            [
                'id' => 12,
                'name' => 'gafas redondas negras',
                'description' => 'Clásicas y sofisticadas, estas gafas redondas negras son ideales para cualquier ocasión.',
                'price' => 30000.00,
                'seller_id' => 2,
                'on_offer' => 1,
            ],
            [
                'id' => 14,
                'name' => 'gafas-premiun',
                'description' => 'Elegancia atemporal y estilo versátil para cualquier look.',
                'price' => 40000.00,
                'seller_id' => 3,
                'on_offer' => 1,
            ],
            [
                'id' => 15,
                'name' => 'gafas de sol-premiun',
                'description' => 'Estilo exclusivo con máxima protección y acabado de lujo.',
                'price' => 40000.00,
                'seller_id' => 3,
                'on_offer' => 0,
            ],
            [
                'id' => 16,
                'name' => 'gafas urbanas',
                'description' => 'Estilo moderno y desenfadado, perfectas para un look casual.',
                'price' => 15000.00,
                'seller_id' => 2,
                'on_offer' => 0,
            ],
            [
                'id' => 17,
                'name' => 'gafas modernas',
                'description' => 'Diseño contemporáneo que combina estilo y comodidad.',
                'price' => 80000.00,
                'seller_id' => 2,
                'on_offer' => 1,
            ],
            [
                'id' => 18,
                'name' => 'Lentes Planos Unisex',
                'description' => 'Estilo moderno y cómodo, para cualquier ocasión.',
                'price' => 20000.00,
                'seller_id' => 2,
                'on_offer' => 1,
            ],
            [
                'id' => 19,
                'name' => 'gafas marco premiun',
                'description' => 'Diseño elegante y exclusivo, con acabados de alta calidad.',
                'price' => 50000.00,
                'seller_id' => 3,
                'on_offer' => 0,
            ],
            [
                'id' => 20,
                'name' => 'gafas anti-luz',
                'description' => 'Protección eficaz contra la luz azul, cuidando tus ojos frente a pantallas.',
                'price' => 100000.00,
                'seller_id' => 3,
                'on_offer' => 0,
            ],
        ]);

        // Insertar imágenes
        DB::table('product_images')->insert([
            // Product 10
            ['product_id' => 10, 'image' => 'products/zlCS4DliMi1ev7kUxpe3JXOPcVNJ30W89UwAb3ah.jpg'],
            ['product_id' => 10, 'image' => 'products/qioPsX4LS9oUfN6KgPc1Gj5Jse8PZfhzAkJrLlfy.jpg'],
            ['product_id' => 10, 'image' => 'products/oYE8vBPSA2Nzf4DwMiCb1alEMNsXMypuAUZyDq1j.jpg'],
            ['product_id' => 10, 'image' => 'products/luFzv1zQAylEksvtgOdUBI4LCg3KAnDersIZ63JV.jpg'],

            // Product 12
            ['product_id' => 12, 'image' => 'products/HTahoTkF4SLP4vGL8zZ2p6WWoIJaRfcwvNYF0reQ.png'],

            // Product 14
            ['product_id' => 14, 'image' => 'products/LRedDGJVNWZfTHITHdeRb4MDBqFcMz4PQ3OPkEmr.webp'],

            // Product 15
            ['product_id' => 15, 'image' => 'products/aIhe3LJhfyMqUidV7KhwXr5TOqkPef3TwDpN1Tfy.webp'],
            ['product_id' => 15, 'image' => 'products/RYxNAYygGwnNxYCtDJUjqkAlUj1TDKahXsNuahTR.webp'],

            // Product 16
            ['product_id' => 16, 'image' => 'products/mXcmD41QqMFv542YQGZ222n5b5EwaI3tqtfZ5CQW.webp'],
            ['product_id' => 16, 'image' => 'products/wkKgM2mIS3RIcNeCQRziT17yvSL3Drc1uxiRSOJK.webp'],
            ['product_id' => 16, 'image' => 'products/jppY790Yd8QF4gYC9etL3jWssyhkdT6EcbB0OXi0.webp'],

            // Product 17
            ['product_id' => 17, 'image' => 'products/RyMqPp6YqNngeBH8NwdJdMw2wgmpTw6psIYgfSea.webp'],
            ['product_id' => 17, 'image' => 'products/HAHOahgTOEASIBpgnQWvVljyBby06DwzZKtpxSqv.webp'],
            ['product_id' => 17, 'image' => 'products/6zNnoUSFrw07DXWexLJ3GcbOJQI7UlOdfofL9inL.webp'],

            // Product 18
            ['product_id' => 18, 'image' => 'products/4Tqn0nUe6XiNoIlA8uHWdAGu0VCn3X8h8ysCuq8e.webp'],
            ['product_id' => 18, 'image' => 'products/ltgvNfZcAO5GsYLDKwFFXymIfy5R39EZK9WDXmGP.webp'],
            ['product_id' => 18, 'image' => 'products/rdJ8ICnl5k6Rj92cLtXldjkmz9ZXwBTQYPIxRdyR.webp'],

            // Product 19
            ['product_id' => 19, 'image' => 'products/8aXjOQBNX1q3S6IDtMxanwKRxAjAnlJCXFwLJ2KA.webp'],
            ['product_id' => 19, 'image' => 'products/GHzefr7llzE0tdMPMm1ruf8ZqtCA1i92bKv5lZBz.webp'],
            ['product_id' => 19, 'image' => 'products/vzT38V0mYQdkiVNIxYvgBp6xAKjD5c6cxYtCA7B6.webp'],

            // Product 20
            ['product_id' => 20, 'image' => 'products/Df0SezH6gg98to0rTmIRkB7aPiiRgeMB7IvaUJZv.webp'],
            ['product_id' => 20, 'image' => 'products/vYmLXtePEhiVhketVgkqxYlO7N7WggeNWx4mTRMd.webp'],
            ['product_id' => 20, 'image' => 'products/yoh0sjI9nqeh3EAPB9LMiyLQWhZsTp1tOsohiUNP.webp'],
        ]);
    }
}
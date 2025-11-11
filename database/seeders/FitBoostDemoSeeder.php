<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class FitBoostDemoSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $tables = [
            'supplement_test',
            'items',
            'orders',
            'reviews',
            'tests',
            'category_supplement',
            'supplements',
            'categories',
            'model_has_roles',
            'users',
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $users = [
            [
                'id' => 1,
                'name' => 'Juan Perez',
                'email' => 'juan.perez@email.com',
                'email_verified_at' => Carbon::parse('2024-01-15 10:30:00'),
                'password' => Hash::make('prueba1234'),
                'remember_token' => 'abc123token',
                'created_at' => Carbon::parse('2024-01-15 10:30:00'),
                'updated_at' => Carbon::parse('2024-01-15 10:30:00'),
                'address' => 'Calle 123 #45-67, Medellin',
                'cardData' => '************1234',
            ],
            [
                'id' => 2,
                'name' => 'Maria Gonzalez',
                'email' => 'maria.gonzalez@email.com',
                'email_verified_at' => Carbon::parse('2024-01-20 14:15:00'),
                'password' => Hash::make('prueba1234'),
                'remember_token' => 'def456token',
                'created_at' => Carbon::parse('2024-01-20 14:15:00'),
                'updated_at' => Carbon::parse('2024-01-20 14:15:00'),
                'address' => 'Carrera 50 #80-12, Medellin',
                'cardData' => '************3631',
            ],
            [
                'id' => 3,
                'name' => 'Carlos Rodriguez',
                'email' => 'carlos.rodriguez@email.com',
                'email_verified_at' => Carbon::parse('2024-02-01 09:45:00'),
                'password' => Hash::make('prueba1234'),
                'remember_token' => 'ghi789token',
                'created_at' => Carbon::parse('2024-02-01 09:45:00'),
                'updated_at' => Carbon::parse('2024-02-01 09:45:00'),
                'address' => 'Avenida El Poblado #30-45, Medellin',
                'cardData' => '************9745',
            ],
            [
                'id' => 4,
                'name' => 'Ana Martinez',
                'email' => 'ana.martinez@email.com',
                'email_verified_at' => Carbon::parse('2024-02-10 16:20:00'),
                'password' => Hash::make('prueba1234'),
                'remember_token' => 'jkl012token',
                'created_at' => Carbon::parse('2024-02-10 16:20:00'),
                'updated_at' => Carbon::parse('2024-02-10 16:20:00'),
                'address' => 'Calle 70 #52-18, Medellin',
                'cardData' => '************4821',
            ],
            [
                'id' => 5,
                'name' => 'David Silva',
                'email' => 'david.silva@email.com',
                'email_verified_at' => null,
                'password' => Hash::make('prueba1234'),
                'remember_token' => null,
                'created_at' => Carbon::parse('2024-03-01 11:00:00'),
                'updated_at' => Carbon::parse('2024-03-01 11:00:00'),
                'address' => 'Transversal 25 #40-33, Medellin',
                'cardData' => null,
            ],
            [
                'id' => 6,
                'name' => 'Julian Valencia',
                'email' => 'valenciajuliann@hotmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('prueba1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'address' => 'Medellin, Colombia',
                'cardData' => null,
            ],
        ];

        DB::table('users')->insert($users);

        $categories = [
            ['id' => 1, 'name' => 'Proteinas', 'description' => 'Suplementos para el desarrollo muscular'],
            ['id' => 2, 'name' => 'Vitaminas', 'description' => 'Vitaminas y minerales esenciales'],
            ['id' => 3, 'name' => 'Pre-Entreno', 'description' => 'Suplementos para energia antes del entrenamiento'],
            ['id' => 4, 'name' => 'Quemadores de Grasa', 'description' => 'Suplementos para perdida de peso'],
            ['id' => 5, 'name' => 'Creatina', 'description' => 'Suplementos de creatina para fuerza'],
        ];
        DB::table('categories')->insert($categories);

        $supplements = [
            [
                'id' => 1,
                'name' => 'Whey Protein Gold Standard',
                'description' => 'Proteina de suero de alta calidad con aminoacidos esenciales',
                'laboratory' => 'Optimum Nutrition',
                'price' => 89900,
                'stock' => 25,
                'flavour' => 'Chocolate',
                'expiration_date' => '2025-12-31',
                'ingredients' => 'Aislado de proteina de suero, saborizantes naturales, stevia',
                'created_at' => Carbon::parse('2024-01-10 08:00:00'),
                'updated_at' => Carbon::parse('2024-01-10 08:00:00'),
                'image_path' => null,
            ],
            [
                'id' => 2,
                'name' => 'Multivitaminico Complete',
                'description' => 'Complejo vitaminico completo con 26 nutrientes esenciales',
                'laboratory' => 'Nature Made',
                'price' => 45000,
                'stock' => 50,
                'flavour' => 'Sin sabor',
                'expiration_date' => '2026-06-30',
                'ingredients' => 'Vitamina A, C, D, E, complejo B, zinc, magnesio, hierro',
                'created_at' => Carbon::parse('2024-01-10 08:30:00'),
                'updated_at' => Carbon::parse('2024-01-10 08:30:00'),
                'image_path' => null,
            ],
            [
                'id' => 3,
                'name' => 'C4 Original Pre-Workout',
                'description' => 'Pre-entreno con cafeina y beta-alanina para maximo rendimiento',
                'laboratory' => 'Cellucor',
                'price' => 65000,
                'stock' => 15,
                'flavour' => 'Frutas del Bosque',
                'expiration_date' => '2025-09-15',
                'ingredients' => 'Cafeina, beta-alanina, creatina nitrato, arginina',
                'created_at' => Carbon::parse('2024-01-11 09:00:00'),
                'updated_at' => Carbon::parse('2024-01-11 09:00:00'),
                'image_path' => null,
            ],
            [
                'id' => 4,
                'name' => 'L-Carnitina 3000',
                'description' => 'Quemador de grasa natural que ayuda en el metabolismo',
                'laboratory' => 'Biotech USA',
                'price' => 52000,
                'stock' => 30,
                'flavour' => 'Limon',
                'expiration_date' => '2025-11-20',
                'ingredients' => 'L-Carnitina, agua purificada, saborizante natural de limon',
                'created_at' => Carbon::parse('2024-01-12 10:15:00'),
                'updated_at' => Carbon::parse('2024-01-12 10:15:00'),
                'image_path' => null,
            ],
            [
                'id' => 5,
                'name' => 'Creatina Monohidrato',
                'description' => 'Creatina pura para aumento de fuerza y potencia',
                'laboratory' => 'MuscleTech',
                'price' => 38000,
                'stock' => 40,
                'flavour' => 'Sin sabor',
                'expiration_date' => '2026-03-10',
                'ingredients' => '100% Creatina monohidrato micronizada',
                'created_at' => Carbon::parse('2024-01-12 11:00:00'),
                'updated_at' => Carbon::parse('2024-01-12 11:00:00'),
                'image_path' => null,
            ],
            [
                'id' => 6,
                'name' => 'BCAA 2:1:1',
                'description' => 'Aminoacidos ramificados para recuperacion muscular',
                'laboratory' => 'Scivation',
                'price' => 58000,
                'stock' => 20,
                'flavour' => 'Sandia',
                'expiration_date' => '2025-08-25',
                'ingredients' => 'L-Leucina, L-Isoleucina, L-Valina, saborizantes naturales',
                'created_at' => Carbon::parse('2024-01-13 12:30:00'),
                'updated_at' => Carbon::parse('2024-01-13 12:30:00'),
                'image_path' => null,
            ],
            [
                'id' => 7,
                'name' => 'Omega 3 Fish Oil',
                'description' => 'Acidos grasos esenciales para salud cardiovascular',
                'laboratory' => 'Nordic Naturals',
                'price' => 42000,
                'stock' => 35,
                'flavour' => 'Sin sabor',
                'expiration_date' => '2025-10-12',
                'ingredients' => 'Aceite de pescado, EPA, DHA, vitamina E',
                'created_at' => Carbon::parse('2024-01-14 13:45:00'),
                'updated_at' => Carbon::parse('2024-01-14 13:45:00'),
                'image_path' => null,
            ],
            [
                'id' => 8,
                'name' => 'Glutamina Powder',
                'description' => 'L-Glutamina para recuperacion y sistema inmune',
                'laboratory' => 'Dymatize',
                'price' => 48000,
                'stock' => 28,
                'flavour' => 'Sin sabor',
                'expiration_date' => '2025-07-18',
                'ingredients' => '100% L-Glutamina en polvo',
                'created_at' => Carbon::parse('2024-01-15 14:20:00'),
                'updated_at' => Carbon::parse('2024-01-15 14:20:00'),
                'image_path' => null,
            ],
        ];
        DB::table('supplements')->insert($supplements);

        $categorySupplement = [
            ['id' => 1, 'category_id' => 1, 'supplement_id' => 1, 'created_at' => Carbon::parse('2024-01-10 08:00:00'), 'updated_at' => Carbon::parse('2024-01-10 08:00:00')],
            ['id' => 2, 'category_id' => 2, 'supplement_id' => 2, 'created_at' => Carbon::parse('2024-01-10 08:30:00'), 'updated_at' => Carbon::parse('2024-01-10 08:30:00')],
            ['id' => 3, 'category_id' => 3, 'supplement_id' => 3, 'created_at' => Carbon::parse('2024-01-11 09:00:00'), 'updated_at' => Carbon::parse('2024-01-11 09:00:00')],
            ['id' => 4, 'category_id' => 4, 'supplement_id' => 4, 'created_at' => Carbon::parse('2024-01-12 10:15:00'), 'updated_at' => Carbon::parse('2024-01-12 10:15:00')],
            ['id' => 5, 'category_id' => 5, 'supplement_id' => 5, 'created_at' => Carbon::parse('2024-01-12 11:00:00'), 'updated_at' => Carbon::parse('2024-01-12 11:00:00')],
            ['id' => 6, 'category_id' => 1, 'supplement_id' => 6, 'created_at' => Carbon::parse('2024-01-13 12:30:00'), 'updated_at' => Carbon::parse('2024-01-13 12:30:00')],
            ['id' => 7, 'category_id' => 2, 'supplement_id' => 7, 'created_at' => Carbon::parse('2024-01-14 13:45:00'), 'updated_at' => Carbon::parse('2024-01-14 13:45:00')],
            ['id' => 8, 'category_id' => 1, 'supplement_id' => 8, 'created_at' => Carbon::parse('2024-01-15 14:20:00'), 'updated_at' => Carbon::parse('2024-01-15 14:20:00')],
            ['id' => 9, 'category_id' => 3, 'supplement_id' => 5, 'created_at' => Carbon::parse('2024-01-16 15:00:00'), 'updated_at' => Carbon::parse('2024-01-16 15:00:00')],
        ];
        DB::table('category_supplement')->insert($categorySupplement);

        $tests = [
            [
                'id' => 1,
                'user_id' => 1,
                'context' => 'Entrenamiento de fuerza',
                'routine' => 'Push/Pull/Legs 6 dias',
                'diet' => 'Dieta alta en proteinas',
                'weight' => 75,
                'height' => 178,
                'goals' => 'Ganar masa muscular magra',
                'responses' => 'Busco aumentar 5kg de musculo en 6 meses',
                'status' => 'completed',
                'created_at' => Carbon::parse('2024-01-16 10:00:00'),
                'updated_at' => Carbon::parse('2024-01-20 15:30:00'),
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'context' => 'Perdida de peso',
                'routine' => 'Cardio y pesas 4 dias',
                'diet' => 'Deficit calorico controlado',
                'weight' => 68,
                'height' => 165,
                'goals' => 'Perder 8kg de grasa',
                'responses' => 'Quiero definir y mantener musculo',
                'status' => 'completed',
                'created_at' => Carbon::parse('2024-01-25 11:15:00'),
                'updated_at' => Carbon::parse('2024-01-28 16:45:00'),
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'context' => 'Rendimiento deportivo',
                'routine' => 'Entrenamiento funcional',
                'diet' => 'Dieta balanceada',
                'weight' => 80,
                'height' => 182,
                'goals' => 'Mejorar rendimiento',
                'responses' => 'Practico crossfit y busco mas energia',
                'status' => 'completed',
                'created_at' => Carbon::parse('2024-02-05 09:30:00'),
                'updated_at' => Carbon::parse('2024-02-08 14:20:00'),
            ],
            [
                'id' => 4,
                'user_id' => 4,
                'context' => 'Mantenimiento',
                'routine' => 'Yoga y caminata',
                'diet' => 'Dieta vegetariana',
                'weight' => 60,
                'height' => 162,
                'goals' => 'Mantener peso y salud',
                'responses' => 'Busco suplementos naturales',
                'status' => 'in_progress',
                'created_at' => Carbon::parse('2024-02-15 08:45:00'),
                'updated_at' => Carbon::parse('2024-02-15 08:45:00'),
            ],
        ];
        DB::table('tests')->insert($tests);

        $supplementTest = [
            ['id' => 1, 'supplement_id' => 1, 'test_id' => 1, 'created_at' => Carbon::parse('2024-01-20 15:30:00'), 'updated_at' => Carbon::parse('2024-01-20 15:30:00')],
            ['id' => 2, 'supplement_id' => 5, 'test_id' => 1, 'created_at' => Carbon::parse('2024-01-20 15:30:00'), 'updated_at' => Carbon::parse('2024-01-20 15:30:00')],
            ['id' => 3, 'supplement_id' => 4, 'test_id' => 2, 'created_at' => Carbon::parse('2024-01-28 16:45:00'), 'updated_at' => Carbon::parse('2024-01-28 16:45:00')],
            ['id' => 4, 'supplement_id' => 2, 'test_id' => 2, 'created_at' => Carbon::parse('2024-01-28 16:45:00'), 'updated_at' => Carbon::parse('2024-01-28 16:45:00')],
            ['id' => 5, 'supplement_id' => 3, 'test_id' => 3, 'created_at' => Carbon::parse('2024-02-08 14:20:00'), 'updated_at' => Carbon::parse('2024-02-08 14:20:00')],
            ['id' => 6, 'supplement_id' => 6, 'test_id' => 3, 'created_at' => Carbon::parse('2024-02-08 14:20:00'), 'updated_at' => Carbon::parse('2024-02-08 14:20:00')],
            ['id' => 7, 'supplement_id' => 2, 'test_id' => 4, 'created_at' => Carbon::parse('2024-02-15 08:45:00'), 'updated_at' => Carbon::parse('2024-02-15 08:45:00')],
            ['id' => 8, 'supplement_id' => 7, 'test_id' => 4, 'created_at' => Carbon::parse('2024-02-15 08:45:00'), 'updated_at' => Carbon::parse('2024-02-15 08:45:00')],
        ];
        DB::table('supplement_test')->insert($supplementTest);

        $orders = [
            [
                'id' => 1,
                'user_id' => 1,
                'status' => 'completed',
                'totalAmount' => 127900,
                'created_at' => Carbon::parse('2024-01-22 14:30:00'),
                'updated_at' => Carbon::parse('2024-01-25 10:15:00'),
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'status' => 'completed',
                'totalAmount' => 65000,
                'created_at' => Carbon::parse('2024-02-15 16:20:00'),
                'updated_at' => Carbon::parse('2024-02-18 11:30:00'),
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'status' => 'shipped',
                'totalAmount' => 97000,
                'created_at' => Carbon::parse('2024-02-01 10:45:00'),
                'updated_at' => Carbon::parse('2024-02-05 09:20:00'),
            ],
            [
                'id' => 4,
                'user_id' => 3,
                'status' => 'completed',
                'totalAmount' => 123000,
                'created_at' => Carbon::parse('2024-02-10 12:15:00'),
                'updated_at' => Carbon::parse('2024-02-13 15:45:00'),
            ],
            [
                'id' => 5,
                'user_id' => 4,
                'status' => 'processing',
                'totalAmount' => 87000,
                'created_at' => Carbon::parse('2024-03-01 09:30:00'),
                'updated_at' => Carbon::parse('2024-03-01 09:30:00'),
            ],
        ];
        DB::table('orders')->insert($orders);

        $items = [
            ['id' => 1, 'order_id' => 1, 'supplement_id' => 1, 'quantity' => 1, 'totalPrice' => 89900, 'created_at' => Carbon::parse('2024-01-22 14:30:00'), 'updated_at' => Carbon::parse('2024-01-22 14:30:00')],
            ['id' => 2, 'order_id' => 1, 'supplement_id' => 5, 'quantity' => 1, 'totalPrice' => 38000, 'created_at' => Carbon::parse('2024-01-22 14:30:00'), 'updated_at' => Carbon::parse('2024-01-22 14:30:00')],
            ['id' => 3, 'order_id' => 2, 'supplement_id' => 3, 'quantity' => 1, 'totalPrice' => 65000, 'created_at' => Carbon::parse('2024-02-15 16:20:00'), 'updated_at' => Carbon::parse('2024-02-15 16:20:00')],
            ['id' => 4, 'order_id' => 3, 'supplement_id' => 4, 'quantity' => 1, 'totalPrice' => 52000, 'created_at' => Carbon::parse('2024-02-01 10:45:00'), 'updated_at' => Carbon::parse('2024-02-01 10:45:00')],
            ['id' => 5, 'order_id' => 3, 'supplement_id' => 2, 'quantity' => 1, 'totalPrice' => 45000, 'created_at' => Carbon::parse('2024-02-01 10:45:00'), 'updated_at' => Carbon::parse('2024-02-01 10:45:00')],
            ['id' => 6, 'order_id' => 4, 'supplement_id' => 3, 'quantity' => 1, 'totalPrice' => 65000, 'created_at' => Carbon::parse('2024-02-10 12:15:00'), 'updated_at' => Carbon::parse('2024-02-10 12:15:00')],
            ['id' => 7, 'order_id' => 4, 'supplement_id' => 6, 'quantity' => 1, 'totalPrice' => 58000, 'created_at' => Carbon::parse('2024-02-10 12:15:00'), 'updated_at' => Carbon::parse('2024-02-10 12:15:00')],
            ['id' => 8, 'order_id' => 5, 'supplement_id' => 7, 'quantity' => 1, 'totalPrice' => 42000, 'created_at' => Carbon::parse('2024-03-01 09:30:00'), 'updated_at' => Carbon::parse('2024-03-01 09:30:00')],
            ['id' => 9, 'order_id' => 5, 'supplement_id' => 2, 'quantity' => 1, 'totalPrice' => 45000, 'created_at' => Carbon::parse('2024-03-01 09:30:00'), 'updated_at' => Carbon::parse('2024-03-01 09:30:00')],
        ];
        DB::table('items')->insert($items);

        $reviews = [
            [
                'id' => 1,
                'user_id' => 1,
                'supplement_id' => 1,
                'rating' => 5,
                'comment' => 'Excelente proteina, buen sabor y se disuelve muy bien. La recomiendo totalmente.',
                'status' => 1,
                'created_at' => Carbon::parse('2024-01-30 10:00:00'),
                'updated_at' => Carbon::parse('2024-01-30 10:00:00'),
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'supplement_id' => 5,
                'rating' => 4,
                'comment' => 'Buena creatina, he notado mejoras en fuerza. Sin sabor como debe ser.',
                'status' => 1,
                'created_at' => Carbon::parse('2024-02-01 11:30:00'),
                'updated_at' => Carbon::parse('2024-02-01 11:30:00'),
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'supplement_id' => 3,
                'rating' => 5,
                'comment' => 'El mejor pre-entreno que he probado. Energia increible sin crash.',
                'status' => 1,
                'created_at' => Carbon::parse('2024-02-22 15:45:00'),
                'updated_at' => Carbon::parse('2024-02-22 15:45:00'),
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'supplement_id' => 4,
                'rating' => 4,
                'comment' => 'Buen producto para definicion, se nota la diferencia combinado con ejercicio.',
                'status' => 1,
                'created_at' => Carbon::parse('2024-02-08 14:20:00'),
                'updated_at' => Carbon::parse('2024-02-08 14:20:00'),
            ],
            [
                'id' => 5,
                'user_id' => 2,
                'supplement_id' => 2,
                'rating' => 5,
                'comment' => 'Completo multivitaminico, me siento con mas energia durante el dia.',
                'status' => 1,
                'created_at' => Carbon::parse('2024-02-10 16:15:00'),
                'updated_at' => Carbon::parse('2024-02-10 16:15:00'),
            ],
            [
                'id' => 6,
                'user_id' => 3,
                'supplement_id' => 3,
                'rating' => 5,
                'comment' => 'Increible boost de energia para mis entrenamientos de crossfit.',
                'status' => 1,
                'created_at' => Carbon::parse('2024-02-18 12:30:00'),
                'updated_at' => Carbon::parse('2024-02-18 12:30:00'),
            ],
            [
                'id' => 7,
                'user_id' => 3,
                'supplement_id' => 6,
                'rating' => 4,
                'comment' => 'Buenos BCAA, ayudan mucho en la recuperacion post-entreno.',
                'status' => 1,
                'created_at' => Carbon::parse('2024-02-20 09:45:00'),
                'updated_at' => Carbon::parse('2024-02-20 09:45:00'),
            ],
        ];
        DB::table('reviews')->insert($reviews);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        foreach ([1, 2, 3, 4, 5] as $userId) {
            $user = User::find($userId);
            if ($user) {
                $user->assignRole($userRole);
            }
        }

        $admin = User::find(6);
        if ($admin) {
            $admin->assignRole($adminRole);
        }
    }
}

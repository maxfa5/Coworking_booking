<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->truncate();

        // 1. Вставка городов
        DB::table('cities')->insert([
            ['name' => 'Москва', 'timezone' => 'Europe/Moscow', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Санкт-Петербург', 'timezone' => 'Europe/Moscow', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Новосибирск', 'timezone' => 'Asia/Novosibirsk', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Екатеринбург', 'timezone' => 'Asia/Yekaterinburg', 'created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('objects_types')->truncate();

        // 2. Вставка типов объектов
        DB::table('objects_types')->insert([
            ['name' => 'Переговорная комната', 'min_slot' => 1, 'max_slot' => 10, 'slot_step' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Рабочее место', 'min_slot' => 1, 'max_slot' => 1, 'slot_step' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Офисный кабинет', 'min_slot' => 1, 'max_slot' => 5, 'slot_step' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Коворкинг зона', 'min_slot' => 1, 'max_slot' => 20, 'slot_step' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Конференц-зал', 'min_slot' => 5, 'max_slot' => 50, 'slot_step' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('users')->truncate();

        // 5. Вставка пользователей
        DB::table('users')->insert([
            [
                'first_name' => 'Иван',
                'name' => 'Иван',
                'email' => 'ivan.petrov@example.com',
                'password' => bcrypt('password'), // замените на хеш
                'created_at' => now(),
                'last_name' =>'Петров',
                'updated_at' => now(),
                'is_super' => 1
            ],
            [
                'name' => 'Иван',
                'first_name' => 'Мария',
                'email' => 'maria.sidorova@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'last_name' =>'Сидорова',
                'updated_at' => now(),
                'is_super' => 0
            ],
            [
                'name' => 'Иван',
                'first_name' => 'Алексей',
                'email' => 'alexey.kozlov@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'last_name' =>'Козлов',
                'updated_at' => now(),
                'is_super' => 0
            ],
            [
                'name' => 'Иван',
                'first_name' => 'Екатерина',
                'last_name' =>'Новикова',
                'email' => 'ekaterina.novikova@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'is_super' => 0
            ],
        ]);
        DB::table('buildings')->truncate();

        // 3. Вставка зданий
        DB::table('buildings')->insert([
            [
                'name' => 'Бизнес-центр "Москва-Сити"',
                'count_floor' => 25,
                'open_at' => '08:00:00',
                'close_at' => '22:00:00',
                'address' => 'Пресненская наб., 8, стр. 1',
                'city_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Коворкинг "Красный Октябрь"',
                'count_floor' => 3,
                'open_at' => '09:00:00',
                'close_at' => '21:00:00',
                'address' => 'Берсеневская наб., 6',
                'city_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'БЦ "Лиговский"',
                'count_floor' => 15,
                'open_at' => '07:30:00',
                'close_at' => '23:00:00',
                'address' => 'Лиговский пр-т, 153',
                'city_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Коворкинг "Loft Project"',
                'count_floor' => 2,
                'open_at' => '08:00:00',
                'close_at' => '20:00:00',
                'address' => 'Лиговский пр-т, 74',
                'city_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Бизнес-центр "Сибирский"',
                'count_floor' => 10,
                'open_at' => '08:00:00',
                'close_at' => '20:00:00',
                'address' => 'ул. Ленина, 12',
                'city_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        DB::table('kovorkings')->truncate();

        // 4. Вставка коворкингов
        DB::table('kovorkings')->insert([
            [
                'name' => 'Переговорная "Альфа"',
                'type_id' => 1,
                'from_at' => '09:00:00',
                'to_at' => '21:00:00',
                'floor_number' => 5,
                'metadata' => json_encode(['projector' => true, 'whiteboard' => true]),
                'capacity' => 8,
                'building_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Рабочее место №101',
                'type_id' => 2,
                'from_at' => '08:00:00',
                'to_at' => '22:00:00',
                'floor_number' => 10,
                'metadata' => json_encode(['monitor' => true, 'dock_station' => true]),
                'capacity' => 1,
                'building_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Офис "Бета"',
                'type_id' => 3,
                'from_at' => '08:00:00',
                'to_at' => '20:00:00',
                'floor_number' => 7,
                'metadata' => json_encode(['printer' => true, 'coffee_machine' => true]),
                'capacity' => 4,
                'building_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Конференц-зал "Гамма"',
                'type_id' => 5,
                'from_at' => '10:00:00',
                'to_at' => '19:00:00',
                'floor_number' => 3,
                'metadata' => json_encode(['video_conference' => true, 'capacity' => 20]),
                'capacity' => 20,
                'building_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Коворкинг зона "Дельта"',
                'type_id' => 4,
                'from_at' => '09:00:00',
                'to_at' => '21:00:00',
                'floor_number' => 1,
                'metadata' => json_encode(['comfortable_chairs' => true, 'fast_wifi' => true]),
                'capacity' => 15,
                'building_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Переговорная "Эпсилон"',
                'type_id' => 1,
                'from_at' => '08:00:00',
                'to_at' => '20:00:00',
                'floor_number' => 2,
                'metadata' => json_encode(['soundproof' => true]),
                'capacity' => 6,
                'building_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Рабочее место №201',
                'type_id' => 2,
                'from_at' => '07:30:00',
                'to_at' => '23:00:00',
                'floor_number' => 8,
                'metadata' => json_encode(['dual_monitor' => true]),
                'capacity' => 1,
                'building_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('bookings')->truncate();

        // 6. Вставка бронирований
        DB::table('bookings')->insert([
            // Разовые бронирования
            [
                'start_time' => '2024-01-15 10:00:00',
                'end_time' => '2024-01-15 12:00:00',
                'period_start_at' => null,
                'day_of_week' => null,
                'period_end_at' => null,
                'type' => 'SINGLE',
                'kovorking_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'start_time' => '2024-01-15 14:00:00',
                'end_time' => '2024-01-15 16:00:00',
                'period_start_at' => null,
                'day_of_week' => null,
                'period_end_at' => null,
                'type' => 'SINGLE',
                'kovorking_id' => 2,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'start_time' => '2024-01-16 09:00:00',
                'end_time' => '2024-01-16 11:00:00',
                'period_start_at' => null,
                'day_of_week' => null,
                'period_end_at' => null,
                'type' => 'SINGLE',
                'kovorking_id' => 3,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Еженедельные бронирования (каждый понедельник в 10:00)
            [
                'start_time' => '2024-01-15 10:00:00',
                'end_time' => '2024-01-15 12:00:00',
                'period_start_at' => '2024-01-15 00:00:00',
                'day_of_week' => 1,
                'period_end_at' => '2024-12-31 23:59:59',
                'type' => 'WEEK',
                'kovorking_id' => 4,
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Постоянные бронирования
            [
                'start_time' => '2024-01-15 09:00:00',
                'end_time' => '2024-01-15 18:00:00',
                'period_start_at' => '2024-01-15 00:00:00',
                'day_of_week' => null,
                'period_end_at' => '2024-12-31 23:59:59',
                'type' => 'PERMANENT',
                'kovorking_id' => 5,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Дополнительные бронирования
            [
                'start_time' => '2024-01-17 13:00:00',
                'end_time' => '2024-01-17 15:00:00',
                'period_start_at' => null,
                'day_of_week' => null,
                'period_end_at' => null,
                'type' => 'SINGLE',
                'kovorking_id' => 6,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'start_time' => '2024-01-18 11:00:00',
                'end_time' => '2024-01-18 13:00:00',
                'period_start_at' => null,
                'day_of_week' => null,
                'period_end_at' => null,
                'type' => 'SINGLE',
                'kovorking_id' => 7,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
-- Таблица городов
CREATE TABLE city (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    timezone VARCHAR(50) NOT NULL DEFAULT 'Europe/Moscow'
);

CREATE TABLE buildings (
    id SERIAL PRIMARY KEY,
    city_id INT NOT NULL REFERENCES city(id) ON DELETE CASCADE,
    name VARCHAR(255) NOT NULL,
    count_floor INT,
    open_at TIME  NOT NULL,
    close_at TIME  NOT NULL,
    address TEXT NOT NULL
);

CREATE TYPE user_role AS ENUM ('SUPER', 'USER');

-- Таблица пользователей
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    is_super BOOLEAN NOT NULL DEFAULT false,
    phone VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL);



-- Таблица типов объектов slot-время на которое можно забронировать объект
-- min-slot минимальное кол-во слотов для бронироания,
-- slot-step-время на которое можно забронировать слот
CREATE TABLE objects_types (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    min_slot INT NOT NULL,
    max_slot INT NOT NULL,
    slot_step INT NOT NULL
);

-- Таблица объектов бронирования
-- from_at и to_at возможное время бронирования объекта, по умолчанию нужно смотреть на время работы оффиса 
CREATE TABLE objects (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type_id INT REFERENCES objects_types(id) ON DELETE SET NULL,
    from_at TIME,
    to_at TIME,
    floor_number INT,
    metadata VARCHAR(255),
    is_hidden BOOLEAN NOT NULL DEFAULT FALSE,
    capacity INT NOT NULL DEFAULT 1,
    building_id INT NOT NULL REFERENCES buildings(id) ON DELETE CASCADE
);


-- Тип перечисления для бронирования
CREATE TYPE booking_type AS ENUM ('SINGLE', 'WEEK', 'PERMANENT');


-- Таблица бронирований (основная информация)
--period поля для бронирования типа WEEK и PERMANENT
CREATE TABLE bookings (
    id SERIAL PRIMARY KEY,
    object_id INT REFERENCES objects(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    start_time TIMESTAMPTZ,
    end_time TIMESTAMPTZ ,
    period_start_at TIMESTAMPTZ , 
    day_of_week INT,
    period_end_at TIMESTAMPTZ ,
    type booking_type,
    created_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
);



CREATE TYPE "user_role" AS ENUM (
	'SUPER',
	'USER'
);

CREATE TYPE "equipment_type" AS ENUM (
	'MONITOR',
	'DESK',
	'PROJECTOR',
	'PHONE'
);

CREATE TYPE "equipment_status" AS ENUM (
	'FREE',
	'BROKEN',
	'OCCUPIED'
);

CREATE TYPE "booking_type" AS ENUM (
	'SINGLE',
	'WEEK',
	'PERMANENT'
);

CREATE TABLE "city" (
	"id" SERIAL,
	"name" VARCHAR(255) NOT NULL,
	"timezone" VARCHAR(50) NOT NULL DEFAULT 'Europe/Moscow',
	PRIMARY KEY("id")
);




CREATE TABLE "offices" (
	"id" SERIAL,
	"city_id" INTEGER NOT NULL,
	"name" VARCHAR(255) NOT NULL,
	"count_floor" INTEGER,
	"open_at" TIME NOT NULL,
	"close_at" TIME NOT NULL,
	"address" TEXT NOT NULL,
	PRIMARY KEY("id")
);




CREATE TABLE "floors" (
	"id" SERIAL,
	"name" VARCHAR(255) NOT NULL,
	"description" VARCHAR(255),
	"is_hidden" BOOLEAN NOT NULL DEFAULT false,
	"office_id" INTEGER NOT NULL,
	PRIMARY KEY("id")
);




CREATE TABLE "user_profiles" (
	"id" SERIAL,
	"phone" VARCHAR(255),
	"password" VARCHAR(255) NOT NULL,
	"first_name" VARCHAR(255) NOT NULL,
	"last_name" VARCHAR(255) NOT NULL,
	"email" VARCHAR(255) NOT NULL UNIQUE,
	PRIMARY KEY("id")
);




CREATE TABLE "users" (
	"id" SERIAL,
	"group_id" INTEGER,
	"user_profile_id" INTEGER UNIQUE,
	"role_id" INTEGER DEFAULT 2,
	PRIMARY KEY("id")
);




CREATE TABLE "user_offices" (
	"user_id" INTEGER NOT NULL,
	"office_id" INTEGER NOT NULL,
	PRIMARY KEY("user_id", "office_id")
);




CREATE TABLE "objects_types" (
	"id" SERIAL,
	"name" VARCHAR(255),
	"min_slot" INTEGER NOT NULL,
	"max_slot" INTEGER NOT NULL,
	"slot_step" INTEGER NOT NULL,
	PRIMARY KEY("id")
);




CREATE TABLE "equipments" (
	"id" SERIAL,
	"name" equipment_type NOT NULL,
	"model" VARCHAR(255) NOT NULL,
	"serial_number" VARCHAR(255) UNIQUE,
	"status" equipment_status NOT NULL DEFAULT 'FREE',
	"purchase_date" DATE,
	"warranty_until" DATE,
	"last_maintenance_date" DATE,
	"updated_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id")
);




CREATE TABLE "locations" (
	"id" SERIAL,
	"room" INTEGER,
	"name" VARCHAR(255),
	PRIMARY KEY("id")
);




CREATE TABLE "objects" (
	"id" SERIAL,
	"name" VARCHAR(255) NOT NULL,
	"location" INTEGER,
	"type_id" INTEGER,
	"from_at" TIME,
	"to_at" TIME,
	"metadata" VARCHAR(255),
	"is_hidden" BOOLEAN NOT NULL DEFAULT false,
	"capacity" INTEGER NOT NULL DEFAULT 1,
	"floor_id" INTEGER NOT NULL,
	PRIMARY KEY("id")
);




CREATE TABLE "object_equipment" (
	"object_id" INTEGER NOT NULL,
	"equipment_id" INTEGER NOT NULL,
	PRIMARY KEY("object_id", "equipment_id")
);




CREATE TABLE "bookings" (
	"id" SERIAL,
	"user_id" INTEGER,
	"start_time" TIMESTAMPTZ,
	"end_time" TIMESTAMPTZ,
	"period_start_at" TIMESTAMPTZ,
	"day_of_week" INTEGER,
	"period_end_at" TIMESTAMPTZ,
	"type" booking_type,
	"status" VARCHAR(50) DEFAULT 'ACTIVE' CHECK("[object Object]" IN ACTIVE AND COMPLETED AND CANCELLED),
	"created_at" TIMESTAMPTZ NOT NULL DEFAULT NOW(),
	PRIMARY KEY("id")
);




CREATE TABLE "booking_objects" (
	"booking_id" INTEGER NOT NULL,
	"object_id" INTEGER NOT NULL,
	PRIMARY KEY("booking_id", "object_id")
);



ALTER TABLE "offices"
ADD FOREIGN KEY("city_id") REFERENCES "city"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "floors"
ADD FOREIGN KEY("office_id") REFERENCES "offices"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "users"
ADD FOREIGN KEY("user_profile_id") REFERENCES "user_profiles"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "user_offices"
ADD FOREIGN KEY("user_id") REFERENCES "users"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "user_offices"
ADD FOREIGN KEY("office_id") REFERENCES "offices"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "booking_objects"
ADD FOREIGN KEY("booking_id") REFERENCES "bookings"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "booking_objects"
ADD FOREIGN KEY("object_id") REFERENCES "objects"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "bookings"
ADD FOREIGN KEY("user_id") REFERENCES "users"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "object_equipment"
ADD FOREIGN KEY("object_id") REFERENCES "objects"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "object_equipment"
ADD FOREIGN KEY("equipment_id") REFERENCES "equipments"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "objects"
ADD FOREIGN KEY("floor_id") REFERENCES "floors"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "objects"
ADD FOREIGN KEY("type_id") REFERENCES "objects_types"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE "objects"
ADD FOREIGN KEY("location") REFERENCES "locations"("id")
ON UPDATE NO ACTION ON DELETE NO ACTION;
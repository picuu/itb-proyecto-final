/*Aqí va la creación de la base de datos*/

-- Data base creation
CREATE DATABASE IF NOT EXISTS `bankTime` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- auth_level_type creation

CREATE TYPE auth_level_type AS ENUM('1', '2');

-- Date type creation

CREATE TYPE date as (
    `day` INT NOT NULL,
    `month` INT NOT NULL,
    `year` INT NOT NULL,
    `hour` INT NOT NULL,
    `minute` INT NOT NULL
);

-- User creation

CREATE TABLE IF NOT EXISTS `User`(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `surname` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `balance` DECIMAL(10,2) NOT NULL,
    `valorations` TEXT NOT NULL,
    `history` TEXT NOT NULL,
    `auth_level` auth_level_type NOT NULL
);

-- Valoration creation

CREATE TABLE IF NOT EXISTS `Valoration`(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `owner_id` INT NOT NULL,
    `valorated_member` INT NOT NULL,
    `punctuation` INT NOT NULL,
    `description` TEXT NOT NULL
);

-- History creation

CREATE TABLE IF NOT EXISTS `History`(
    `publisher_id` INT NOT NULL,
    `enrolled_id` INT NOT NULL,
    `offer` offer_type NOT NULL,
    `booking` booking_type NOT NULL
);

-- Offer creation (Object)

CREATE TYPE offer_type AS (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `owner_id` INT NOT NULL,
    `title` VARCHAR(50) NOT NULL,
    `description` TEXT NOT NULL,
    `category` category NOT NULL,
    `tags` tag_type NOT NULL,
    `time` date NOT NULL,
    `ubication` VARCHAR(50) NOT NULL,
    `availability` date NOT NULL,
    `publish_date` date NOT NULL,
);

-- Tag creation (Object)

CREATE TYPE tag_type AS (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL
);

-- Booking creation (Object)

CREATE TYPE booking_type AS(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `publisher_id` INT NOT NULL,
    `enrolled_id` INT NOT NULL,
    `offer_id` INT NOT NULL,
    `date` date NOT NULL
);

-- Service creation

CREATE TABLE IF NOT EXISTS `Service`(
    `subscriber_id` INT NOT NULL
);

-- Comunity offer creation

CREATE TABLE IF NOT EXISTS `Comunity_offer`(
    `volunteers` INT NOT NULL,
    `subscribed_users` INT NOT NULL,
    `max_subscribers` INT NOT NULL
);
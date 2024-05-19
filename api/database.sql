CREATE DATABASE SistemaOfertas;
USE SistemaOfertas;

-- Tipo AuthLevel
CREATE TYPE AuthLevel AS (
    level SMALLINT,
    name VARCHAR(10)
);

-- Tabla User
CREATE TABLE User (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50),
    surname VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(20),
    balance BIGINT,
    auth_level AuthLevel
);

-- Tabla Valoration
CREATE TABLE Valoration (
    id SERIAL PRIMARY KEY,
    owner_id INT,
    valorated_member_id INT,
    punctuation INT,
    description VARCHAR(255),
    publish_date DateType,
    FOREIGN KEY (owner_id) REFERENCES User(id),
    FOREIGN KEY (valorated_member_id) REFERENCES User(id)
);

-- Tabla Booking
CREATE TABLE Booking (
    id SERIAL PRIMARY KEY,
    publisher_id INT,
    enrolled_id INT,
    offer_id INT,
    date DateType,
    FOREIGN KEY (publisher_id) REFERENCES User(id),
    FOREIGN KEY (enrolled_id) REFERENCES User(id),
    FOREIGN KEY (offer_id) REFERENCES Offer(id)
);

-- Tabla History
CREATE TABLE History (
    id SERIAL PRIMARY KEY,
    publisher_id INT,
    enrolled_id INT,
    offer Offer,
    booking Booking,
    FOREIGN KEY (publisher_id) REFERENCES User(id),
    FOREIGN KEY (enrolled_id) REFERENCES User(id)
);

-- Tabla Tag
CREATE TABLE Tag (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50)
);

-- Tabla Category
CREATE TABLE Category (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50)
);

-- Tipo DateType
CREATE TYPE DateType AS (
    day INT,
    month INT,
    year INT,
    hour INT,
    minute INT
);

-- Tipo TimeType
CREATE TYPE TimeType AS (
    hours INT,
    minutes INT
);

-- Tabla Advert
CREATE TABLE Advert (
    id SERIAL PRIMARY KEY,
    owner_id INT,
    title VARCHAR(100),
    description VARCHAR(255),
    category_id INT,
    time TimeType,
    ubication VARCHAR(100),
    availability TEXT,
    publish_date DateType,
    FOREIGN KEY (owner_id) REFERENCES User(id),
    FOREIGN KEY (category_id) REFERENCES Category(id)
);

-- Tabla Taller
CREATE TABLE Taller (
    id SERIAL PRIMARY KEY,
    volunteers_id INT[],
    subscribed_users_id INT[],
    max_subscribed INT,
    FOREIGN KEY (id) REFERENCES Offer(id)
);

-- Tabla Offer
CREATE TABLE Offer (
    id SERIAL PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Offer(id)
);

-- Tabla Demanda
CREATE TABLE Demanda (
    id SERIAL PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Offer(id)
);

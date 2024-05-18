CREATE DATABASE SistemaOfertas;
USE SistemaOfertas;

-- Tabla AuthLevel
CREATE TABLE AuthLevel (
    level VARCHAR(10) PRIMARY KEY
);

-- Insertar valores en AuthLevel
INSERT INTO AuthLevel (level) VALUES ('USER'), ('ADMIN');

-- Tabla User
CREATE TABLE User (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    surname VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(20),
    balance FLOAT,
    auth_level VARCHAR(10),
    FOREIGN KEY (auth_level) REFERENCES AuthLevel(level)
);

-- Tabla Tag
CREATE TABLE Tag (
    id INT PRIMARY KEY,
    name VARCHAR(50)
);

-- Tabla Category
CREATE TABLE Category (
    id INT PRIMARY KEY,
    name VARCHAR(50)
);

-- Tabla Date
CREATE TABLE Date (
    day INT,
    month INT,
    year INT,
    hour INT,
    minute INT,
    PRIMARY KEY (day, month, year, hour, minute)
);

-- Tabla Offer
CREATE TABLE Offer (
    id INT PRIMARY KEY,
    owner_id INT,
    title VARCHAR(100),
    description VARCHAR(255),
    category INT,
    time FLOAT,
    ubication VARCHAR(100),
    availability TEXT,
    publish_date DATE,
    FOREIGN KEY (owner_id) REFERENCES User(id),
    FOREIGN KEY (category) REFERENCES Category(id)
);

-- Tabla Booking
CREATE TABLE Booking (
    id INT PRIMARY KEY,
    publisher_id INT,
    enrolled_id INT,
    offer_id INT,
    date DATE,
    FOREIGN KEY (publisher_id) REFERENCES User(id),
    FOREIGN KEY (enrolled_id) REFERENCES User(id),
    FOREIGN KEY (offer_id) REFERENCES Offer(id)
);

-- Tabla Valoration
CREATE TABLE Valoration (
    id INT PRIMARY KEY,
    owner_id INT,
    valorated_member INT,
    punctuation INT,
    description VARCHAR(255),
    FOREIGN KEY (owner_id) REFERENCES User(id),
    FOREIGN KEY (valorated_member) REFERENCES User(id)
);

-- Tabla History
CREATE TABLE History (
    id INT PRIMARY KEY,
    publisher_id INT,
    enrolled_id INT,
    offer_id INT,
    booking_id INT,
    FOREIGN KEY (publisher_id) REFERENCES User(id),
    FOREIGN KEY (enrolled_id) REFERENCES User(id),
    FOREIGN KEY (offer_id) REFERENCES Offer(id),
    FOREIGN KEY (booking_id) REFERENCES Booking(id)
);

-- Tabla Service
CREATE TABLE Service (
    id INT PRIMARY KEY,
    volunteers INT[],
    subscribed_users INT[],
    max_subscribed INT,
    FOREIGN KEY (id) REFERENCES Offer(id)
);

-- Tabla Taller
CREATE TABLE Taller (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Offer(id)
);

-- Tabla Demanda
CREATE TABLE Demanda (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Offer(id)
);

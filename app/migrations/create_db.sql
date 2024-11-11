-- Creare baza de date
CREATE DATABASE gym_management;
USE gym_management;

-- Creare tabel roles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Insert role data (client, trainer, owner)
INSERT INTO roles (name) VALUES ('client'), ('trainer'), ('owner');

-- Creare tabel users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT,
    date_of_birth DATE,
    phone_number VARCHAR(15),
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Creare tabel exercises
CREATE TABLE exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(50) NOT NULL,  -- Example: "Strength", "Cardio", etc.
    youtube_video_id VARCHAR(255) NOT NULL
);

-- Creare tabel workouts (pentru fiecare client)
CREATE TABLE workouts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    exercise_id INT,
    date DATE,
    sets INT,
    reps INT,
    weight DECIMAL(10,2),  -- In case of weightlifting exercises
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (exercise_id) REFERENCES exercises(id)
);

-- Creare tabel records (pentru a salva PR-urile clientilor)
CREATE TABLE records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    exercise_id INT,
    record_value DECIMAL(10,2),  -- Example: max weight lifted or best time
    record_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (exercise_id) REFERENCES exercises(id)
);

-- Creare tabel trainers_clients (pentru a asocia antrenorii cu clientii lor)
CREATE TABLE trainers_clients (
    trainer_id INT,
    client_id INT,
    start_date DATE,
    end_date DATE,
    PRIMARY KEY (trainer_id, client_id),
    FOREIGN KEY (trainer_id) REFERENCES users(id),
    FOREIGN KEY (client_id) REFERENCES users(id)
);

-- Creare tabel pentru a salva sesiunile de antrenament ale clientilor
CREATE TABLE training_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    trainer_id INT,
    session_date DATETIME,
    duration INT,  -- Durata sesiunii in minute
    feedback TEXT,
    FOREIGN KEY (client_id) REFERENCES users(id),
    FOREIGN KEY (trainer_id) REFERENCES users(id)
);

-- Creare tabel pentru a salva informatii legate de abonamentele clientilor
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    start_date DATE,
    end_date DATE,
    type VARCHAR(50),  -- "monthly", "annual", etc.
    status VARCHAR(20),  -- "active", "expired"
    FOREIGN KEY (user_id) REFERENCES users(id)
);


-- Creare tabel pentru clasele de grup
CREATE TABLE group_classes (
    id INT AUTO_INCREMENT PRIMARY KEY,           -- Identificator unic al clasei
    name VARCHAR(255) NOT NULL,                  -- Numele clasei (de exemplu: Yoga, Spinning)
    description TEXT,                            -- Descrierea clasei
    instructor_id INT,                          -- ID-ul antrenorului care predă clasa (referință la tabelul users)
    schedule DATETIME,                          -- Data și ora la care se ține clasa
    capacity INT,                               -- Capacitatea maximă a clasei
    FOREIGN KEY (instructor_id) REFERENCES users(id) -- Antrenorul este un utilizator (trainer)
);



-- Inserarea datelor pentru roles
INSERT INTO roles (name) VALUES 
('client'),
('trainer'),
('owner');

-- Inserarea datelor pentru users
INSERT INTO users (first_name, last_name, email, password, role_id, date_of_birth, phone_number) VALUES
('Ion', 'Popescu', 'ion.popescu@example.com', '$2y$10$Dcv55ZBljOjmO0S5n3FEO8W5dC6YX6VgJr2llT/lt4Zc9gnxCwHsq', 1, '1990-06-15', '0712345678'),
('Maria', 'Ionescu', 'maria.ionescu@example.com', '$2y$10$Dcv55ZBljOjmO0S5n3FEO8W5dC6YX6VgJr2llT/lt4Zc9gnxCwHsq', 2, '1985-04-20', '0723456789'),
('Andrei', 'Vasilescu', 'andrei.vasilescu@example.com', '$2y$10$Dcv55ZBljOjmO0S5n3FEO8W5dC6YX6VgJr2llT/lt4Zc9gnxCwHsq', 3, '1980-03-10', '0734567890');

-- Inserarea datelor pentru exercises
INSERT INTO exercises (name, description, category) VALUES
('Squat', 'Exercițiu pentru picioare care lucrează coapsele și fesierii', 'Strength', 'l83R5PblSMA'),
('Push-up', 'Exercițiu pentru piept, umeri și triceps', 'Strength', '3qCnU1TZboY'),
('Running', 'Exercițiu cardio pentru îmbunătățirea rezistenței', 'Cardio', 'N9C88z3g0Es'),
('Deadlift', 'Exercițiu de forță pentru spate și picioare', 'Strength', '2SJ9HkKaxwU');

-- Inserarea datelor pentru workouts
INSERT INTO workouts (user_id, exercise_id, date, sets, reps, weight) VALUES
(1, 1, '2024-11-01', 3, 10, 50.00),
(1, 2, '2024-11-02', 4, 12, 0),
(2, 3, '2024-11-03', 1, 30, 0);

-- Inserarea datelor pentru records
INSERT INTO records (user_id, exercise_id, record_value, record_date) VALUES
(1, 1, 100.00, '2024-11-05'),
(1, 2, 50.00, '2024-11-06');

-- Inserarea datelor pentru trainers_clients
INSERT INTO trainers_clients (trainer_id, client_id, start_date, end_date) VALUES
(2, 1, '2024-11-01', '2025-11-01');

-- Inserarea datelor pentru training_sessions
INSERT INTO training_sessions (client_id, trainer_id, session_date, duration, feedback) VALUES
(1, 2, '2024-11-01 10:00:00', 60, 'Antrenament de forță foarte bun pentru picioare și spate');

-- Inserarea datelor pentru subscriptions
INSERT INTO subscriptions (user_id, start_date, end_date, type, status) VALUES
(1, '2024-11-01', '2025-11-01', 'annual', 'active');


-- Inserare clase de grup
INSERT INTO group_classes (name, description, instructor_id, schedule, capacity) 
VALUES 
('Yoga', 'Clasa de yoga pentru toate nivelele, cu focus pe relaxare și flexibilitate.', 2, '2024-11-12 18:00:00', 20),
('Pilates', 'Clasa de Pilates pentru tonifiere și îmbunătățirea posturii.', 3, '2024-11-13 10:00:00', 15);


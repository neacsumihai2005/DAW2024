# Fitness Room Management System

## Architecture Overview

The application follows the **Model-View-Controller (MVC)** design pattern, a common and efficient architectural approach that separates the application into three main components:

- **Model**: Handles the data logic and business rules.
- **View**: Responsible for displaying data to the user (the user interface).
- **Controller**: Acts as an intermediary between the Model and View, processing user inputs, manipulating data, and updating the view.

## Roles, Entities, and Processes

### Roles:
1. **Client**: A user who signs up to the application to use its features.
2. **Trainer**: An instructor who can manage group classes and individual training sessions for clients.
3. **Owner**: The administrator who manages the overall gym or fitness center, including user management and class scheduling.

### Entities:
- **Users**: Includes clients, trainers, and owners. All users have an account, and each has specific roles and permissions.
- **Classes**: Both group and individual training sessions, with details like schedule, capacity, and instructor.
- **Workouts**: Specific exercises or routines that can be assigned to clients.
- **Records**: Personal records (PRs) for each client related to their fitness progress (e.g., best weight lifted, fastest time).
- **Schedule**: A timetable for classes and personal training sessions.

### Processes:
- **Registration and Login**: Users (clients, trainers, or owners) can register, log in, and manage their profiles.
- **Scheduling Classes**: Trainers and owners can schedule group or individual classes and assign them to clients.
- **Tracking Progress**: Clients can track their workout progress and personal records.
- **Admin Management**: Owners can manage users, classes, and other administrative tasks.

## Relationships Between Entities
- **Users and Classes**: Users can either be clients attending a class or trainers offering the classes.
- **Users and Workouts**: Clients are assigned specific workouts and track their personal records.
- **Trainers and Clients**: Trainers can have multiple clients, each with personalized workouts.
- **Owner and Users**: Owners manage the users, ensuring they can create accounts, modify roles, and oversee the entire system.

## Database Design

The database is designed to store all relevant data for users, classes, workouts, and records. It includes several key tables, such as:

1. **Users Table**: Stores details about each user (ID, name, role, login details).
2. **Classes Table**: Stores group class details, including name, description, schedule, instructor, and capacity.
3. **Workouts Table**: Stores the exercises that can be assigned to clients.
4. **Personal Records Table**: Stores personal bests (PRs) for clients.
5. **Client-Class Enrollment Table**: Manages which clients are attending which group classes.
6. **Trainer-Class Assignment**: Keeps track of which trainers are teaching which classes.

### Example of Database Tables

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    role ENUM('client', 'trainer', 'owner'),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    instructor_id INT,
    schedule DATETIME,
    capacity INT,
    FOREIGN KEY (instructor_id) REFERENCES users(id)
);

CREATE TABLE personal_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    exercise_name VARCHAR(100),
    record_value FLOAT,
    date_recorded DATE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

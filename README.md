# Fitness Room Management System
Host: [http://neacsumihai-daw2024.infinityfreeapp.com/DAW2024](http://neacsumihai-daw2024.infinityfreeapp.com/DAW2024)

## Architecture Overview

The application follows the **Model-View-Controller (MVC)** design pattern, a widely used approach that separates the logic of the application into three main components:

- **Model**: Handles the data logic, interacts with the database, and performs business rules.
- **View**: Responsible for rendering the data to the user interface.
- **Controller**: Acts as an intermediary between the Model and View. It processes user input, updates the model, and refreshes the view accordingly.

## Database: `gym_management`

The `gym_management` database is designed for managing a fitness gym or sports club, keeping track of users, exercises, workouts, and group classes. It consists of four primary tables: `exercises`, `group_classes`, `users`, and `workouts`. Below is a detailed explanation of each table and its relationships.

### Tables

#### 1. **exercises**
The `exercises` table stores the exercises available in the gym. Each exercise has a name, description, category (e.g., Strength, Cardio), and a YouTube video ID for instructional purposes.

- **Columns:**
  - `id`: Primary key, unique identifier for each exercise.
  - `name`: The name of the exercise.
  - `description`: A brief description of the exercise.
  - `category`: The type/category of the exercise (e.g., Strength, Cardio).
  - `youtube_video_id`: The YouTube video ID for the exercise tutorial.

#### 2. **group_classes**
The `group_classes` table tracks the group fitness classes offered in the gym. Each class has a name, description, instructor, schedule, and capacity.

- **Columns:**
  - `id`: Primary key, unique identifier for each class.
  - `name`: The name of the group class (e.g., Yoga, Pilates).
  - `description`: A brief description of the class.
  - `instructor_id`: Foreign key referencing the `users` table for the instructor of the class.
  - `schedule`: The scheduled date and time for the class.
  - `capacity`: The maximum number of participants allowed in the class.

#### 3. **users**
The `users` table contains information about the gym's users, including their personal details and roles (e.g., Admin, Instructor, Member). This table is also used for storing user login credentials (passwords are hashed for security).

- **Columns:**
  - `id`: Primary key, unique identifier for each user.
  - `first_name`: The user's first name.
  - `last_name`: The user's last name.
  - `email`: The user's email address (unique).
  - `password`: The hashed password for user authentication.
  - `role_id`: The user's role (e.g., Admin, Instructor, Member).
  - `date_of_birth`: The user's date of birth.
  - `phone_number`: The user's phone number.

#### 4. **workouts**
The `workouts` table records the individual workout sessions for each user, linking them to exercises. It tracks the number of sets, reps, and weight (if applicable) for each exercise.

- **Columns:**
  - `id`: Primary key, unique identifier for each workout record.
  - `user_id`: Foreign key referencing the `users` table for the user performing the workout.
  - `exercise_id`: Foreign key referencing the `exercises` table for the exercise performed.
  - `sets`: The number of sets for the exercise.
  - `reps`: The number of repetitions per set.
  - `weight`: The weight used for the exercise (if applicable).
  - `date`: Timestamp indicating when the workout was logged.

### Relationships

- The `group_classes` table has a foreign key `instructor_id` that references the `users` table. This indicates which instructor is teaching a particular class.
- The `workouts` table has two foreign keys:
  - `user_id`: References the `users` table to identify which user performed the workout.
  - `exercise_id`: References the `exercises` table to identify which exercise was performed during the workout.

### Sample Data
The database includes sample data such as exercises like `Squat`, `Push-up`, and `Running`, as well as group classes like `Yoga` and `Pilates`. User data is also included with sample users like `Maria Ionescu`, `Andrei Vasilescu`, and `Mihai Neacsu`.

### Setup Instructions

1. Import the SQL dump into your MySQL database.
2. Ensure that your PHP application connects to the `gym_management` database.
3. Use the tables and data to manage gym users, workouts, exercises, and classes.

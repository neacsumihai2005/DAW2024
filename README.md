# Fitness Room Management System
Host: http://neacsumihai-daw2024.infinityfreeapp.com/DAW2024
## Architecture Overview

The application follows the Model-View-Controller (MVC) design pattern, a widely used approach that separates the logic of the application into three main components:

- **Model**: Handles the data logic, interacts with the database, and performs business rules.
- **View**: Responsible for rendering the data to the user interface.
- **Controller**: Acts as an intermediary between the Model and View. It processes user input, updates the model, and refreshes the view accordingly.

## Roles, Entities, and Relationships

### Roles:
- **Client**: A user who registers for the gym services to track their workouts, records, and training sessions.
- **Trainer**: A fitness instructor who manages group classes and works with clients individually.
- **Owner**: The administrator responsible for overseeing gym operations, managing users, and scheduling group classes.

### Entities:

1. **Users**: 
   - This table contains all users in the system (clients, trainers, and owners).
   - Fields: id, first_name, last_name, email, password, role_id, date_of_birth, phone_number.

2. **Exercises**: 
   - Contains a list of exercises available for clients and trainers to use in their workouts.
   - Fields: id, name, description, category, youtube_video_id.

3. **Workouts**:
   - Tracks the specific workouts that clients perform, including details about sets, reps, weight, etc.
   - Fields: id, user_id (client), exercise_id, date, sets, reps, weight.

4. **Records**:
   - Stores personal records (PRs) for each client, such as maximum weight lifted or best time for specific exercises.
   - Fields: id, user_id, exercise_id, record_value, record_date.

5. **Trainers-Clients**:
   - Establishes a many-to-many relationship between trainers and clients, defining which clients are assigned to which trainers, along with their start and end dates.
   - Fields: trainer_id, client_id, start_date, end_date.

6. **Training Sessions**:
   - Stores information about training sessions between clients and trainers, including feedback and session duration.
   - Fields: id, client_id, trainer_id, session_date, duration, feedback.

7. **Subscriptions**:
   - Tracks the subscriptions of clients, indicating the start and end dates, type (monthly, annual), and the status (active or expired).
   - Fields: id, user_id, start_date, end_date, type, status.

8. **Group Classes**:
   - Contains the schedule and details for group classes, along with the instructor's information.
   - Fields: id, name, description, instructor_id, schedule, capacity.

## Database Description

The database for the fitness room management system is structured to support the core functionalities of the application. It handles users (clients, trainers, and owners), their subscriptions, records, and workouts, along with managing group classes and training sessions. The relationships between entities are well-defined using foreign keys to ensure data integrity.


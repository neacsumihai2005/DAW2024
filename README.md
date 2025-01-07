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

1. **Import the SQL dump into your MySQL database.**
2. **Ensure that your PHP application connects to the `gym_management` database.**
3. **Use the tables and data to manage gym users, workouts, exercises, and classes.**
4. **Install dependencies using Composer**:
   - Make sure you have Composer installed on your server. If not, you can install it by running the following command:
     ```bash
     curl -sS https://getcomposer.org/installer | php
     ```
     Or, for global installation on a Linux/macOS-based system:
     ```bash
     sudo mv composer.phar /usr/local/bin/composer
     ```
   - Once Composer is installed, navigate to the root directory of your PHP application and run the following command to install the dependencies defined in your `composer.json` file:
     ```bash
     composer install
     ```
   - This command will download and install all required libraries, including **PHPMailer**, **phpdotenv**, and other packages defined in `composer.json`.

5. **Configure PHPMailer**:
   - PHPMailer is used for sending emails, such as for confirming user registration.
   - To configure PHPMailer, you need to add your SMTP server credentials in the `.env` file. Add the following environment variables:
     ```dotenv
     MAIL_HOST=smtp.example.com
     MAIL_SMTPAUTH=true
     MAIL_USERNAME=your_email@example.com
     MAIL_PASSWORD=your_email_password
     MAIL_SMTPSECURE=STARTTLS
     MAIL_PORT=587
     ```
   - Replace the values with your actual email server configuration details.

6. **Configure `.env` with vlucas/phpdotenv**:
   - **phpdotenv** is used to load environment variables from the `.env` file. These variables are essential for storing sensitive information like API keys and email credentials.
   - Make sure you have an `.env` file in the root directory of your application with the following environment variables:
     ```dotenv
     RECAPTCHA_SECRET=your_recaptcha_secret
     RECAPTCHA_SITEKEY=your_recaptcha_sitekey
     ```
   - In your PHP application, you need to load the variables from the `.env` file using `phpdotenv`. Typically, this is done in your main application file (e.g., `index.php` or a similar file):
     ```php
     use Dotenv\Dotenv;

     $dotenv = Dotenv::createImmutable(__DIR__);
     $dotenv->load();
     ```
     This code will load all the variables from the `.env` file into your application's environment.

7. **Configure the database and reCAPTCHA**:
   - Make sure the environment variables for the database connection and reCAPTCHA are correctly set in the `.env` file:
     ```dotenv
     DB_HOST=localhost
     DB_NAME=gym_management
     DB_USER=your_db_user
     DB_PASSWORD=your_db_password
     ```

8. Continue using the application to manage gym users, workouts, and exercises.


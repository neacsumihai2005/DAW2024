Fitness room management system

Architecture Overview
The application follows the Model-View-Controller (MVC) design pattern, a common and efficient architectural approach that separates the application into three main components:

Model: Handles the data logic and business rules.
View: Responsible for displaying data to the user (the user interface).
Controller: Acts as an intermediary between the Model and View, processing user inputs, manipulating data, and updating the view.
Roles, Entities, and Processes
Roles:
Client: A user who signs up to the application to use its features.
Trainer: An instructor who can manage group classes and individual training sessions for clients.
Owner: The administrator who manages the overall gym or fitness center, including user management and class scheduling.
Entities:
Users: Includes clients, trainers, and owners. All users have an account, and each has specific roles and permissions.
Classes: Both group and individual training sessions, with details like schedule, capacity, and instructor.
Workouts: Specific exercises or routines that can be assigned to clients.
Records: Personal records (PRs) for each client related to their fitness progress (e.g., best weight lifted, fastest time).
Schedule: A timetable for classes and personal training sessions.


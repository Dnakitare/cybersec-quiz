# CyberSec Quiz Platform

The CyberSec Quiz Platform is a web application built with Laravel and Livewire. It allows administrators to manage quizzes, questions, and categories, and users to take quizzes and view their results.

## Features

- Admin Dashboard
  - Manage Quizzes
  - Manage Questions
  - Manage Categories
- User Dashboard
  - Take Quizzes
  - View Quiz Results
- Authentication and Authorization
- Responsive Design

## Prerequisites

- PHP \>= 8.2
- Composer
- Node.js & NPM
- Docker (for Laravel Sail)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/your-username/cybersec-quiz-platform.git
   cd cybersec-quiz-platform
   ```

2. **Install dependencies:**

   ```bash
   composer install
   npm install
   ```

3. **Set up environment variables:**

  ```bash
  cp .env.example .env
  ```

4. **Generate application key:**

  ```bash
  php artisan key:generate
  ```

5. **Run migrations and seed the database:**

  ```bash
  php artisan migrate --seed
  ```

6. **Compile assets:**

  ```bash
  npm run dev
  ```

7. **Start the development server:**

  ```bash
  ./vendor/bin/sail up
  ```

8. **Access the application:**

  Open your browser and navigate to http://localhost to view the application.

### Directory Structure

  ```plaintext
  cybersec-quiz-platform
  ├── app
  │   ├── Http
  │   │   ├── Controllers
  │   │   ├── Livewire
  │   │   │   ├── Admin
  │   │   │   │   ├── QuizComponent.php
  │   │   │   │   ├── QuestionComponent.php
  │   │   │   │   ├── CategoryComponent.php
  │   │   │   │   ├── DashboardComponent.php
  │   │   │   ├── QuizTakingComponent.php
  │   │   │   ├── UserDashboardComponent.php
  │   ├── Models
  │   │   ├── Quiz.php
  │   │   ├── Question.php
  │   │   ├── Category.php
  │   │   ├── Result.php
  ├── database
  │   ├── factories
  │   │   ├── CategoryFactory.php
  │   │   ├── QuizFactory.php
  │   │   ├── QuestionFactory.php
  │   ├── migrations
  │   │   ├── create_quizzes_table.php
  │   │   ├── create_questions_table.php
  │   │   ├── create_categories_table.php
  │   │   ├── create_results_table.php
  │   ├── seeders
  │   │   ├── DatabaseSeeder.php
  ├── resources
  │   ├── views
  │   │   ├── layouts
  │   │   │   ├── app.blade.php
  │   │   │   ├── admin.blade.php
  │   │   ├── livewire
  │   │   │   ├── admin
  │   │   │   │   ├── quiz-component.blade.php
  │   │   │   │   ├── create-quiz.blade.php
  │   │   │   │   ├── question-component.blade.php
  │   │   │   │   ├── create-question.blade.php
  │   │   │   │   ├── category-component.blade.php
  │   │   │   │   ├── create-category.blade.php
  │   │   │   │   ├── dashboard-component.blade.php
  │   │   │   ├── quiz-taking-component.blade.php
  │   │   │   ├── user-dashboard-component.blade.php
  │   │   ├── dashboard.blade.php
  ├── routes
  │   ├── web.php
  ├── .env
  ├── .env.example
  ├── composer.json
  ├── package.json
  ├── tailwind.config.js
  └── vite.config.js
  ```

### Usage

#### Admin
- Access the admin dashboard at http://localhost/admin/dashboard.
- Manage quizzes, questions, and categories.

#### User
- Register or log in to the application.
- Take quizzes and view your results on the user dashboard.

### License

This project is licensed under the Apache 2.0 [License](https://github.com/Dnakitare/cybersec-quiz?tab=Apache-2.0-1-ov-file#readme)

# **Course Discovery System**

This project is a Course Discovery System built using Laravel. It allows users to search for courses, view course details, and apply various filters. It also provides a RESTful API for managing courses.

---

## **Features**

### **Frontend**
- Responsive user interface built with Laravel Blade and Tailwind CSS.
- Search courses by keywords.
- Filter courses by:
  - Category
  - Price (Free/Paid/Price Range)
  - Difficulty Level
  - Duration
  - Ratings
  - Course Format
  - Certification
  - Release Date
  - Popularity
- Display course details including title, description, price, instructor, and more.

### **Backend**
- RESTful API for managing courses:
  - Retrieve all courses: `GET /api/courses`
  - Retrieve a specific course by ID: `GET /api/courses/{id}`
  - Add a new course: `POST /api/courses`
  - Update a course: `PUT /api/courses/{id}`
  - Delete a course: `DELETE /api/courses/{id}`
- Well-structured database schema with migrations.
- Unit and integration tests for API endpoints.

---

## **Prerequisites**

- PHP >= 8.1
- Composer
- MySQL or any other supported database
- Node.js and npm (for frontend assets)
- Laravel 10

---

## **Installation**

1. Install dependencies:

    composer install

2. Configure environment variables:

    cp .env.example .env

3. Generate application key:

    php artisan key:generate

4. Run database migrations:

    php artisan migrate

5. Start the development server:

    php artisan serve

6. Access the application at http://localhost:8000


## **API Documentation**

### **Endpoints**

### **1. Retrieve All Courses**
- **Method**: `GET`
- **Endpoint**: `/courses`
- **Description**: Fetches a list of all courses.
- **Response**:
  ```json
  [
      {
          "id": 1,
          "title": "Learn Laravel",
          "description": "A comprehensive guide to Laravel.",
          "price": 99.99,
          "instructor": "John Doe",
          "category": "Programming",
          "difficulty": "Intermediate",
          "duration": 10,
          "rating": 5,
          "format": "Video",
          "certification": true,
          "release_date": "2025-01-01",
          "popularity": 100,
          "created_at": "2025-01-27T00:00:00.000000Z",
          "updated_at": "2025-01-27T00:00:00.000000Z"
      }
  ]


### **2. Retrieve a Specific Course**

- **Method**: `GET`
- **Endpoint**: `/courses/{id}`
- **Description**: Fetches the details of a specific course by its ID.
- **URL Parameters**: `id` (integer): The ID of the course.
- **Response**:
  ```json
  [
      {
            "id": 1,
            "title": "Learn Laravel",
            "description": "A comprehensive guide to Laravel.",
            "price": 99.99,
            "instructor": "John Doe",
            "category": "Programming",
            "difficulty": "Intermediate",
            "duration": 10,
            "rating": 5,
            "format": "Video",
            "certification": true,
            "release_date": "2025-01-01",
            "popularity": 100,
            "created_at": "2025-01-27T00:00:00.000000Z",
            "updated_at": "2025-01-27T00:00:00.000000Z"
      }
  ]


### **3. Add a New Course**

- **Method**: `POST`
- **Endpoint**: `/courses`
- **Description**: Creates a new course.
- **Request Body**:
  ```json
  [
      {
            "title": "Learn Laravel",
            "description": "A comprehensive guide to Laravel.",
            "price": 99.99,
            "instructor": "John Doe",
            "category": "Programming",
            "difficulty": "Intermediate",
            "duration": 10,
            "rating": 5,
            "format": "Video",
            "certification": true,
            "release_date": "2025-01-01",
            "popularity": 100,
      }
  ]

- **Response**:
  ```json
  [
      {
            "id": 2,
            "title": "Learn Laravel",
            "description": "A comprehensive guide to Laravel.",
            "price": 99.99,
            "instructor": "John Doe",
            "category": "Programming",
            "difficulty": "Intermediate",
            "duration": 10,
            "rating": 5,
            "format": "Video",
            "certification": true,
            "release_date": "2025-01-01",
            "popularity": 100,
            "created_at": "2025-01-27T12:00:00.000000Z",
            "updated_at": "2025-01-27T12:00:00.000000Z"
      }
  ]


### **4. Update an Existing Course**

- **Method**: `PUT`
- **Endpoint**: `courses/{id}`
- **Description**: Updates an existing course by ID.
- **URL Parameters**: `id` (integer): The ID of the course.
- **Request Body**:
  ```json
  [
      {
            "title": "Updated Laravel Course",
            "price": 119.99,
            "rating": 4
      }
  ]

- **Response**:
  ```json
  [
      {
            "id": 1,
            "title": "Updated Laravel Course",
            "description": "A comprehensive guide to Laravel.",
            "price": 119.99,
            "instructor": "John Doe",
            "category": "Programming",
            "difficulty": "Intermediate",
            "duration": 10,
            "rating": 4,
            "format": "Video",
            "certification": true,
            "release_date": "2025-01-01",
            "popularity": 100,
            "created_at": "2025-01-27T00:00:00.000000Z",
            "updated_at": "2025-01-27T12:30:00.000000Z"
      }
  ]


### **5. Delete a Course**

- **Method**: `DELETE`
- **Endpoint**: `courses/{id}`
- **Description**: Deletes a course by its ID.
- **URL Parameters**: `id` (integer): The ID of the course.
- **Response**:
  ```json
  [
      {
            "message": "Course deleted successfully."
      }
  ]
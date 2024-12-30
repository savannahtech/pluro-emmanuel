
---

# Accessibility Analysis Web Application

## Overview

This project is an accessibility analysis tool designed to help identify and resolve accessibility issues in HTML content. It includes both a backend built with **Laravel** and a frontend built with **Vue.js**, providing an intuitive user interface for uploading HTML files and viewing accessibility insights.

The backend analyzes the HTML content using WCAG principles and provides a compliance score along with suggestions for fixing common accessibility issues (e.g., missing `alt` attributes for images, form inputs missing labels, etc.). The frontend allows users to upload HTML files and view the analysis results in real-time.

## Features

- **Backend (Laravel)**:
    - Analyzes HTML files for accessibility issues.
    - Returns a score based on the number of issues found.
    - Suggests fixes for detected issues.
    - Built using Laravel and Pest for testing.

- **Frontend (Vue.js)**:
    - A user-friendly interface to upload HTML files.
    - Displays accessibility score and issues with suggestions for fixes.

## Requirements

To run this project locally, ensure you have the following installed:

- **Docker**: To run the application in containers.
- **Docker Compose**: To manage multi-container Docker applications.
- **Git**: To clone the repository.

## Installation

Follow these steps to install and run the project:

### 1. Clone the repository

```bash
git clone git@github.com:emmadedayo/accessibility-checkers.git
cd accessibility-checkers
```

### 2. Copy environment variables

Navigate to the respective directories for the backend and frontend, and copy the `.env.example` file to `.env`:

- For the **backend**:

  ```bash
  cd backend
  cp .env.example .env
  ```

- For the **frontend**:

  ```bash
  cd frontend
  cp .env.example .env
  ```

Return to the root directory:

```bash
cd ..
```

### 3. Set up Docker containers

Run the following command to build the Docker containers for both the backend (Laravel) and frontend (Vue.js):

```bash
make build
```

### 4. Start the Docker containers

Start the containers in detached mode:

```bash
make up
```

This will spin up both the backend and frontend services defined in the `docker-compose.yml` file. By default:
- The Laravel backend will be available on `http://localhost:8081`
- The Vue.js frontend will be available on `http://localhost:8090/`.

### 5. Run the tests (optional)

You can run the tests for the backend and frontend separately using the following commands:

- **Backend (Laravel)**:  
  Run Pest tests for the Laravel backend:

  ```bash
  make test-backend
  ```

- **Frontend (Vue.js)**:  
  Run Jest or Pest tests for the Vue.js frontend:

  ```bash
  make test-frontend
  ```

### 6. Access the application

- Visit the **frontend** at `http://localhost:8090/` in your web browser.
- The frontend provides an interface for uploading HTML files and displaying the accessibility analysis results.

### 7. Stopping the containers

To stop the containers, run:

```bash
make down
```

To remove the containers and associated volumes, run:

```bash
make clean
```

## Project Structure

- **backend**: Contains the Laravel application responsible for analyzing HTML content for accessibility issues.
- **frontend**: Contains the Vue.js application responsible for interacting with users and displaying analysis results.
- **docker-compose.yml**: Defines the multi-container setup for both backend and frontend services.
- **Makefile**: Provides a set of commands for managing Docker containers, running tests, and cleaning up the environment.

## How It Works

1. **Frontend**:
    - Users upload an HTML file via the web interface.
    - The frontend sends the file to the backend for analysis.

2. **Backend**:
    - The backend analyzes the HTML file for accessibility issues, such as missing `alt` attributes on images, improper heading order, and missing labels on form inputs.
    - A score is generated based on the number of issues detected, and suggested fixes are returned.

3. **Result Display**:
    - The frontend receives the analysis results from the backend and displays the issues with suggested fixes.
    - The user can view the accessibility score and take necessary actions to improve accessibility.

## Contributing

Feel free to fork the repository, submit issues, and create pull requests for new features or bug fixes. When contributing, please follow these guidelines:

- Ensure that any code changes are covered by tests.
- Follow the existing code style and conventions.
- Provide a detailed description of your changes in the pull request.

## Contact

For questions or inquiries, feel free to contact the project maintainer:

- **Emmanuel Adenagbe**: [emmadenagbe@gmail.com](mailto:emmadenagbe@gmail.com)

---
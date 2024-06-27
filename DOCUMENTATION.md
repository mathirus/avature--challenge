
# Jobberwocky API Documentation

## Overview
Jobberwocky is a job posting and searching service that allows companies to share open positions and users to find job opportunities. This documentation provides details on the available API endpoints and their usage.

## Endpoints

### Job Endpoints

#### Search Jobs
- **URL:** `/api/jobs`
- **Method:** `GET`
- **Description:** Search for job opportunities based on various filters.
- **Request Parameters:**
    - `skills` (array[string], optional): List of skills to filter jobs.
    - `category_id` (integer, optional): ID of the job category.
    - `job_type_id` (integer, optional): ID of the job type.
    - `country_id` (integer, optional): ID of the country.
    - `name` (string, optional): Name of the job.
    - `salary_min` (numeric, optional): Minimum salary.
    - `salary_max` (numeric, optional): Maximum salary.
- **Response:**
    - **200 OK**: A list of matching job opportunities.
    - **404 Not Found**: No jobs found.

#### Create Job
- **URL:** `/api/jobs`
- **Method:** `POST`
- **Description:** Create a new job opportunity.
- **Request Body:**
    - `name` (string, required): Name of the job.
    - `skills` (array[string], required): List of skills required for the job.
    - `company_name` (string, required): Name of the company offering the job.
    - `salary` (numeric, required): Salary for the job.
    - `experience_level` (string, optional): Experience level required for the job.
    - `country_id` (integer, required): ID of the country.
    - `category_id` (integer, required): ID of the job category.
    - `job_type_id` (integer, required): ID of the job type.
    - `is_enabled` (boolean, optional): Whether the job is enabled.
- **Response:**
    - **201 Created**: The created job opportunity.

### Subscription Endpoints

#### Create Subscription
- **URL:** `/api/subscriptions`
- **Method:** `POST`
- **Description:** Subscribe to job alerts based on specific filters.
- **Request Body:**
    - `email` (string, required): Email address for job alerts.
    - `filters` (object, optional): Filters for the subscription.
        - `name` (string, optional): Name of the job.
        - `country_id` (integer, optional): ID of the country.
        - `skills` (array[string], optional): List of skills.
        - `salary_min` (numeric, optional): Minimum salary.
        - `salary_max` (numeric, optional): Maximum salary.
- **Response:**
    - **201 Created**: The created subscription.

## Models

### Job
- **Attributes:**
    - `name` (string): Name of the job.
    - `skills` (array[string]): List of skills required for the job.
    - `company_name` (string): Name of the company offering the job.
    - `salary` (numeric): Salary for the job.
    - `experience_level` (string): Experience level required for the job.
    - `country_id` (integer): ID of the country.
    - `category_id` (integer): ID of the job category.
    - `job_type_id` (integer): ID of the job type.
    - `is_enabled` (boolean): Whether the job is enabled.
    - `created_at` (timestamp): Timestamp when the job was created.
    - `updated_at` (timestamp): Timestamp when the job was last updated.

### Subscription
- **Attributes:**
    - `email` (string): Email address for job alerts.
    - `filters` (object): Filters for the subscription.
        - `name` (string, optional): Name of the job.
        - `country_id` (integer, optional): ID of the country.
        - `skills` (array[string], optional): List of skills.
        - `salary_min` (numeric, optional): Minimum salary.
        - `salary_max` (numeric, optional): Maximum salary.
    - `created_at` (timestamp): Timestamp when the subscription was created.
    - `updated_at` (timestamp): Timestamp when the subscription was last updated.

## Example Requests

### Search Jobs
```bash
curl -X GET "http://localhost:8000/api/jobs?skills[]=php&country_id=1&salary_min=50000" -H "accept: application/json"
```

### Create Job
```bash
curl -X POST "http://localhost:8000/api/jobs" -H "accept: application/json" -H "Content-Type: application/json" -d "{ "name": "Senior PHP Developer", "skills": ["php", "laravel"], "company_name": "Acme Corp", "salary": 90000, "experience_level": "Senior", "country_id": 1, "category_id": 1, "job_type_id": 1, "is_enabled": true }"
```

### Create Subscription
```bash
curl -X POST "http://localhost:8000/api/subscriptions" -H "accept: application/json" -H "Content-Type: application/json" -d "{ "email": "user@example.com", "filters": { "country_id": 1, "salary_min": 50000, "salary_max": 100000, "skills": ["php", "mysql"] } }"
```

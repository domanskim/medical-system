# Medical System

This repository contains a Laravel application for a medical system. 
This project was developed as part of a recruitment process (assignment task).

## Installation

Follow these steps to set up the project:

1. Clone the repository:
   ```
   git clone git@github.com:domanskim/medical-system.git
   ```

2. Navigate to the project folder:
   ```
   cd medical-system
   ```

3. Install dependencies:
   ```
   docker run --rm \
       --pull=always \
       -v "$(pwd)":/opt \
       -w /opt \
       laravelsail/php83-composer:latest \
       bash -c "composer install"
   ```

4. Configure environment variables:
   ```
   cp .env.example .env && nano .env
   ```

5. Build and start the Docker containers:
   ```
   ./vendor/bin/sail up -d --build
   ```

6. Test the application:
   ```
   ./vendor/bin/sail artisan
   ```

7. Generate a key for the application:
   ```
   ./vendor/bin/sail artisan key:generate
   ```

8. Create the database schema:
   ```
   ./vendor/bin/sail artisan migrate
   ```

9. Seed the database:
   ```
   ./vendor/bin/sail artisan db:seed
   ```

10. You're all set!

**Note:** If you're using Postman, you can import the provided collection for easier API testing.

### Endpoints

1. **Upload a document for a patient**
    - Method: POST
    - URL: `/api/patients/{patient}/documents`
    - Authentication: Basic Auth
    - Request:
        - Body: form-data
            - Key: `document`
            - Value: PDF file (max size defined by `MAX_DOCUMENT_SIZE` env variable, default 5MB)
    - Response: 204 No Content

2. **Get all documents for a patient**
    - Method: GET
    - URL: `/api/patients/{patient}/documents`
    - Authentication: Basic Auth
    - Response: JSON array of documents (paginated, 10 items per page)

3. **Delete a document for a patient**
    - Method: DELETE
    - URL: `/api/patients/{patient}/documents/{document}`
    - Authentication: Basic Auth
    - Response: 204 No Content

**Note:** If you're using Postman, you can import the provided collection for easier API testing.

### Authorization

- Only the doctor assigned to a patient can access or modify that patient's documents.
- Attempting to access data for patients not assigned to the authenticated doctor will result in a `RestrictedDataException`.

### Document Processing

- When a document is uploaded, it's stored in the `storage/app/public/documents` directory.
- After storage, a `ProcessDocument` job is dispatched to handle any necessary background processing.

### Error Handling

- If a document is requested for deletion and it doesn't belong to the specified patient, a `PatientNotFoundException` will be thrown.
- Validation errors (e.g., file type, size) will return appropriate error responses.

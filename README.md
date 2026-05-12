# Lyrid PHP Native

## Installation
1. Clone the repository:
    ```bash
    git clone https://github.com/muh-arga/lyrid-php-native.git
    ```
2. Navigate to the project directory:
    ```bash
    cd lyrid-php-native
    ```
3. Import the database:
    Import the `database.sql` file into your MySQL database to create the necessary tables and seed data.

4. Set up environment variables by copying the example file and modifying it:
    ```bash
    cp .env.example .env
    ```
    Update the `.env` file with your database credentials.

## Credentials
- Admin User:
    - username: admin
    - password: admin123

- Regular User:
    - username: user
    - password: user123

## Note
- If failed upload image, make sure to create `uploads` directory in the project root and set proper permissions:
    ```bash
    mkdir uploads
    chmod 755 uploads
    ```

# Filament CSV Export Sorting Issue

This repository demonstrates a PostgreSQL-specific sorting issue in Filament's CSV export functionality.

## The Issue

When exporting records with a specific sort order and using chunking, the final CSV file may not maintain the expected global sort order. This is particularly noticeable when:

-   Using PostgreSQL as the database
-   Having a large number of records
-   Having a default sort order or explicitly setting a sort order for the export

## Setup Instructions

1. Clone the repository:

    ```bash
    git clone git@github.com:kaspernowak/filament-issue.git
    cd filament-issue
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Copy `.env.example` to `.env`:

    ```bash
    cp .env.example .env
    ```

4. Configure your PostgreSQL database in `.env`. Adjust these values according to your setup:

    ```env
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=filament_issue
    DB_USERNAME=filament_user
    DB_PASSWORD=filament_password
    ```

5. Generate application key:

    ```bash
    php artisan key:generate
    ```

6. Run migrations and seeders:

    ```bash
    php artisan migrate:fresh --seed
    ```

7. Start the development server:

    ```bash
    php artisan serve
    ```

8. Visit `http://localhost:8000/admin` and login with test credentials:
    - Email: test@example.com
    - Password: password

## Steps to Reproduce

1. Navigate to the Products listing page (`/admin/products`)
2. Note the default sorting (price ascending)
3. Click the Export button in the header actions
4. When the export completes, download and open the CSV
5. Compare the sorting in the CSV with the web interface

## Expected Behavior

The exported CSV should maintain the same sort order as shown in the web interface.

## Current Behavior

The exported CSV's sort order may not match the web interface, particularly when dealing with larger datasets that require chunking.

## Technical Details

-   Laravel 11.x
-   Filament 3.2.124
-   PostgreSQL
-   Test dataset: 200 products with random prices
-   Default sorting: Price (ascending)

## Temporary Workaround

Currently, the issue can be worked around by:

1. Setting a very large chunk size (e.g., `->chunkSize(100000)`)

However, this may not be suitable for production environments with large datasets.

## Database Schema

The reproduction uses a simple products table with the following structure:

-   `id` (primary key)
-   `name` (string)
-   `price` (decimal)
-   `stock` (integer)
-   timestamps

## Additional Notes

-   The queue connection is set to 'sync' in `.env.example` for immediate processing of exports
-   The repository includes a seeder that creates 200 test products with random prices
-   The export is configured to sort by price in ascending order

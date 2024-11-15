# Filament CSV Export Sorting Issue

This repository demonstrates a PostgreSQL-specific sorting issue in Filament's CSV export functionality.

## The Issue

When exporting records with a specific sort order and using chunking, the final CSV file may not maintain the expected global sort order. This is particularly noticeable when:
- Using PostgreSQL as the database
- Having a large number of records
- Setting a specific chunk size for the export
- Having a default sort order or explicitly setting a sort order for the export

## Setup Instructions

1. Clone the repository
2. Copy `.env.example` to `.env` and configure your PostgreSQL database:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=filament_issue
   DB_USERNAME=filament_user
   DB_PASSWORD=filament_password
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Run migrations and seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```
5. Start the development server:
   ```bash
   php artisan serve
   ```
6. Login with test credentials:
   - Email: test@example.com
   - Password: password

## Steps to Reproduce

1. Navigate to the Products listing page
2. Note the default sorting (price descending)
3. Click the Export button in the header actions
4. When the export completes, download and open the CSV
5. Compare the sorting in the CSV with the web interface

## Expected Behavior

The exported CSV should maintain the same sort order as shown in the web interface.

## Current Behavior

The exported CSV's sort order may not match the web interface, particularly when dealing with larger datasets that require chunking.

## Technical Details

- Laravel 10.x
- Filament 3.2.124
- PostgreSQL
- Test dataset: 200 products with random prices
- Default sorting: Price (descending)

## Temporary Workaround

Currently, the issue can be worked around by either:
1. Setting a very large chunk size (e.g., `->chunkSize(100000)`)
2. Removing the chunk size configuration entirely

However, this may not be suitable for production environments with large datasets.

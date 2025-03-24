# Taxi Stand Management System

The **Taxi Stand Management System** is a web-based application designed to manage taxi stand operations efficiently. It allows the management of taxis, drivers, customers, and bookings in a seamless and user-friendly interface. This system is built with PHP and provides essential features for controlling and monitoring the day-to-day activities at a taxi stand.

## Features

- **Admin Panel**: Secure login for administrators to manage the entire system.
- **Taxi Management**: Add, update, or remove taxi details.
- **Driver Management**: Manage driver information, assign taxis, and view driver performance.
- **Booking System**: Handle customer bookings, track booking statuses, and assign drivers to bookings.
- **Reports**: View statistics on completed rides, available taxis, and driver performance.

## Technology Stack

- **Backend**: PHP
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **Server**: Apache or any PHP-supported server
- **Version Control**: GitHub for source code management

---

## Installation Guide

### Prerequisites

1. **PHP** (version 7.4 or higher)
2. **MySQL Database**
3. **Apache Server** (or other PHP-compatible server)
4. **Text Editor** (VS Code, Sublime, etc.)

### Setup Steps

1. **Clone the Repository**  
   Clone the repository to your local machine using Git:

   ```bash
   git clone https://github.com/AliBaig102/atsms
   ```

2. **Set up the Apache Server**  
   Place the cloned folder in your `htdocs` directory (for XAMPP) or the respective directory of your web server. For example:

   ```
   C:\xampp\htdocs\atsms
   ```

3. **Configure the Database**  
   - Open PHPMyAdmin (or any MySQL management tool).
   - Create a new database (e.g., `atsmsdb`).
   - Import the `atsms.sql` file from the project directory to create necessary tables.

4. **Access the Application**  
   Now, open your web browser and go to:

   ```
   http://localhost/atsms
   ```

---

## Login Credentials

To access the **Admin Panel**, use the following credentials:

- **Username**: admin
- **Password**: Test@123

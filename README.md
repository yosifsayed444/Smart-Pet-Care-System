

<h1 align="center">Smart Pet Care & Veterinary Management System</h1>

<p align="center">
  A comprehensive web-based platform connecting pet owners with veterinarians and service providers — built with a custom PHP MVC framework.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.5-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-4.6-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/XAMPP-Apache-FB7A24?style=for-the-badge&logo=xampp&logoColor=white" alt="XAMPP">
  <img src="https://img.shields.io/badge/Architecture-MVC-2ECC71?style=for-the-badge" alt="MVC">
</p>






---

## 🏗️ Architecture

The application follows a **custom MVC (Model-View-Controller)** architecture built from scratch in PHP:

```
Request → .htaccess → Public/index.php → App.php (Router)
                                            ↓
                                     Controller (+ Middleware)
                                       ↙         ↘
                                  Model            View
                                (Database)       (PHP Templates)
```

### Core Components

| Component | File | Role |
|-----------|------|------|
| **Router** | `App/Core/App.php` | URL parsing, controller/method resolution |
| **Base Controller** | `App/Core/Controller.php` | View rendering with data injection |
| **Model Trait** | `App/Core/Model.php` | Generic CRUD operations (insert, update, delete, where, first) |
| **Database Trait** | `App/Core/Database.php` | PDO connection and prepared statement execution |
| **Middleware** | `App/Core/Middleware.php` | Authentication and role-based access control |
| **Validator** | `App/Core/Validator.php` | Server-side validation for users, products, and checkout |
| **Config** | `App/Core/config.php` | Database credentials and application root URL |

### Routing Convention

URLs map to controllers and methods automatically:

```
/petowner/dashboard  →  PetOwnerController::dashboard()
/admin/deleteUser/5  →  AdminController::deleteUser(5)
/shop/addToCart/12   →  ShopController::addToCart(12)
```

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | PHP 8.5 (custom MVC framework) |
| **Database** | MySQL 8.0 via PDO with prepared statements |
| **Frontend** | HTML5, CSS3, JavaScript |
| **CSS Framework** | Bootstrap 4.6 |
| **Server** | Apache (XAMPP) with mod_rewrite |
| **Security** | Password hashing (bcrypt), session-based auth, RBAC middleware, cache-control headers |

---

## 🗄️ Database Schema

The system uses **19 tables** in a MySQL database named `petcare`:

| Table | Description |
|-------|------------|
| `users` | All platform users (owners, vets, admins, providers) |
| `pet` | Registered pets with owner foreign key |
| `veterinarian` | Vet-specific data (specialization, license number) |
| `serviceprovider` | Provider profiles and verification status |
| `appointment` | Vet appointments between owners and veterinarians |
| `booking` | Service bookings with check-in/out and escrow tracking |
| `vaccination` | Pet vaccination records |
| `prescription` | Digital prescriptions issued by vets |
| `medicalrecord` | Medical notes and lab results |
| `chroniccondition` | Pet chronic condition history |
| `product` | Marketplace product catalog |
| `order` | Customer orders |
| `orderdetails` | Individual line items per order |
| `provider_services` | Services offered by each provider |
| `provider_availability` | Provider time slot availability |
| `provider_certifications` | Uploaded professional certifications |
| `notifications` | System-wide broadcast notifications |
| `incidents` | Service incident/emergency reports |
| `lost_pets` | Lost pet reports and broadcasts |

---

## 🚀 Installation

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL + PHP 8.x)
- Web browser (Chrome, Firefox, Edge)

### Setup Steps

1. **Clone the repository**
   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/yosifsayed444/SE1_Project.git smart-pet-care-system
   ```

2. **Start XAMPP services**
   - Open XAMPP Control Panel
   - Start **Apache** and **MySQL**

3. **Create the database**
   - Open [phpMyAdmin](http://localhost/phpmyadmin)
   - Create a new database named **`petcare`**
   - Import the SQL schema (if available in `docs/`) or create tables manually

4. **Configure the application**

   Edit `App/Core/config.php`:
   ```php
   define("ROOT", "http://localhost/smart-pet-care-system");
   define("DBNAME", "petcare");
   define("DBHOST", "localhost");
   define("DBUSER", "root");
   define("DBPASS", "");
   ```

5. **Access the application**
   ```
   http://localhost/smart-pet-care-system
   ```

---

## 📁 Project Structure

```
smart-pet-care-system/
├── .htaccess                    # Root URL rewrite to Public/
├── README.md
│
├── App/
│   ├── Core/                    # Framework core
│   │   ├── App.php              # Router / front controller
│   │   ├── Controller.php       # Base controller class
│   │   ├── Database.php         # PDO database trait
│   │   ├── Model.php            # Generic CRUD trait
│   │   ├── Middleware.php       # Auth & role guard
│   │   ├── Validator.php        # Input validation
│   │   ├── config.php           # DB & app configuration
│   │   ├── functions.php        # Global helper functions
│   │   └── init.php             # Autoloader & bootstrapper
│   │
│   ├── Controllers/             # Request handlers
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── PetOwnerController.php
│   │   ├── VetController.php
│   │   ├── ServiceProviderController.php
│   │   ├── ShopController.php
│   │   ├── ProfileController.php
│   │   ├── HomeController.php
│   │   ├── AboutController.php
│   │   ├── ContactController.php
│   │   ├── NotificationsController.php
│   │   └── _404.php
│   │
│   ├── models/                  # Data models
│   │   ├── User.php
│   │   ├── Pet.php
│   │   ├── Veterinarian.php
│   │   ├── ServiceProvider.php
│   │   ├── Appointment.php
│   │   ├── Booking.php
│   │   ├── MedicalRecord.php
│   │   ├── Vaccination.php
│   │   ├── Prescription.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   ├── Notification.php
│   │   ├── Certification.php
│   │   ├── Incident.php
│   │   ├── Review.php
│   │   ├── LostPet.php
│   │   └── croniccondition.php
│   │
│   └── views/                   # PHP templates
│       ├── layouts/             # Shared layout partials
│       │   ├── header.php
│       │   ├── navbar.php
│       │   ├── footer.php
│       │   └── admin_sidebar.php
│       ├── Auth/                # Login & registration
│       ├── PetOwner/            # Pet owner dashboard & pages
│       ├── Veterinarian/        # Vet dashboard & tools
│       ├── ServiceProvider/     # Provider dashboard & management
│       ├── admin/               # Admin panel views
│       │   └── reports/         # Analytics & reporting
│       ├── Shop/                # Marketplace
│       ├── profile/             # User profile management
│       ├── Home.php             # Landing page
│       ├── About.php            # About page
│       ├── contact.php          # Contact page
│       ├── notifications.php    # User notifications
│       └── 404.php              # Error page
│
├── Public/                      # Web root (document root)
│   ├── .htaccess                # Pretty URL rewriting
│   ├── index.php                # Application entry point
│   ├── assets/
│   │   ├── CSS/                 # Stylesheets
│   │   │   ├── style.css        # Global base styles
│   │   │   ├── navbar.css       # Navigation bar
│   │   │   ├── footer.css       # Footer layout
│   │   │   ├── home.css         # Homepage
│   │   │   ├── dashboards.css   # Role dashboards
│   │   │   ├── admin.css        # Admin panel
│   │   │   ├── auth.css         # Login & register
│   │   │   ├── shop.css         # Marketplace
│   │   │   ├── profile.css      # User profile
│   │   │   ├── pets.css         # Pet management
│   │   │   ├── appointments.css # Appointments
│   │   │   ├── booking.css      # Service booking
│   │   │   ├── passport.css     # Pet passport
│   │   │   ├── error.css        # 404 page
│   │   │   └── triage.css       # AI triage results
│   │   ├── images/              # Static image assets
│   │   └── JS/                  # JavaScript files
│   └── uploads/                 # User-uploaded files
│       ├── products/            # Product images
│       └── services/            # Service images
│
├── lib/                         # Third-party libraries
└── docs/                        # Documentation
```

---

## 👥 User Roles

| Role | Access | Key Capabilities |
|------|--------|-----------------|
| **Pet Owner** | `/petowner/*` | Manage pets, book vets & services, shop, view medical records |
| **Veterinarian** | `/vet/*` | Manage appointments, create medical records & prescriptions |
| **Service Provider** | `/serviceprovider/*` | Manage services, handle bookings, QR verification |
| **Admin** | `/admin/*` | Full platform control, user management, analytics |

### Authentication Flow

1. Users register at `/auth/register` with role selection
2. Login at `/auth/login` with email & password
3. Session-based authentication with role stored in `$_SESSION['role']`
4. Middleware guards protect all dashboard routes
5. Cache-control headers prevent back-button access after logout

---



## 🔒 Security Features

- **Password Hashing** — bcrypt via `password_hash()` / `password_verify()`
- **Prepared Statements** — All SQL queries use PDO prepared statements to prevent SQL injection
- **Role-Based Access Control** — Middleware enforces role requirements on every protected route
- **Session Security** — Cache-control headers prevent authenticated page caching
- **Input Validation** — Server-side validation for all forms (users, products, checkout)
- **XSS Protection** — `htmlspecialchars()` applied to all user-generated output
- **Self-Deletion Guard** — Admins cannot delete their own accounts



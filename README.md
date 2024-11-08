# Medical Appointment Management System

## 📚 Project Information
This system enables efficient management of medical appointments, facilitating interaction between patients, doctors, and receptionists in a digital environment. The goal is to provide a robust and scalable solution for appointment management, optimizing schedule availability and improving communication among all parties involved.

## 📚 Course Information
- **Course**: Software Engineering
- **Semester**: 2022-2
- **Institution**: Universidad Nacional Autónoma de México (UNAM), Facultad de Ingeniería
- **Instructor**: Ing. Sergio Noble Camargo


## 👥 Development Team
- **Canchola Cruz**, Fernando
- **Figueroa Villamares**, Gabriela
- **Ríos Lira**, Gamaliel
- **López Chong**, Jorge
- **Verano Peralta**, María
- **Acevedo Serrano**, Ximena



## 🎯 Objectives
The primary objectives of this project are to:
- Allow users (patients, doctors, receptionists) to efficiently manage medical appointments.
- Facilitate booking, confirmation, and cancellation of appointments through a web portal.
- Generate reports in Excel format for better appointment control.
- Ensure user verification and protect sensitive data.

## 🛠️ Technologies Used
The system was developed using the following technologies:
- **Backend**: PHP (Laravel Framework)
- **Frontend**: Blade (Laravel), HTML, Tailwind CSS
- **Database**: MySQL
- **ORM**: Eloquent for data management
- **Data Export**: Laravel Excel for generating reports in spreadsheets
- **IDE**: PhpStorm
- **Version Control**: GitHub

## 🏗️ System Architecture

The system follows the **Model-View-Controller (MVC)** pattern, which ensures a clear separation between business logic, data management, and user interface.

### General Structure
- **Model**: Defines the structure of the stored data (Users, Appointments, Doctors, etc.).
- **View**: Blade templates for presenting information to users.
- **Controller**: Manages business logic, coordinating views and models.

## 🚀 Key Features

### System Users
1. **Patients**
   - Register and log in to the system.
   - View available schedules and book appointments.
   - Confirm or cancel appointments.
   - View appointment history and receive email notifications.

2. **Doctors**
   - Manage their profile and consultation schedules.
   - Attend to appointments, add notes and treatments.
   - Review patient history and generate reports.

3. **Receptionists**
   - Manage appointments for all doctors.
   - Confirm patient attendance via email notifications.
   - Export appointment reports in Excel format.

### Highlighted Use Cases
- **Registration and Authentication**: Users can register as patients or doctors and verify their email.
- **Appointment Management**: View and edit schedules, confirm and cancel appointments.
- **Email Notifications**: Automatic appointment reminders.
- **Reports**: Generate monthly reports in Excel for easier management.

## 🛠️ Installation and Configuration

### Prerequisites
- **PHP** (version 8.x)
- **Composer**
- **Node.js** (for Tailwind CSS)
- **MySQL** (database server)
- **Git** (for version control)

### Installation Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repository.git
   cd your-repository
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Configure the `.env` file:
   - Update database credentials.
   - Set up the email server for notifications.

4. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```

The system will be accessible at [http://localhost:8000](http://localhost:8000).

## 🗂️ Additional Documentation
For more details, refer to:
- **Use Cases**: Complete documentation on user flows and available functionalities.
- **Meeting Minutes**: Record of meetings and key decisions during development.
- **Development Plan**: Description of the technology stack and justification for its selection.

## 🧩 Considerations and Future Enhancements
- **Security Implementation**: Add two-factor authentication (2FA) to enhance account security.
- **Performance Optimization**: Improve the efficiency of database queries and optimize the frontend for faster load times.
- **External API Integration**: Enable integration with popular calendar systems like Google Calendar.

## 📄 License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

---

This README provides a comprehensive overview of your project. If you need further adjustments or additional details, please let me know!

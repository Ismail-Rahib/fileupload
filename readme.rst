======================================
File Upload System in CodeIgniter 3
======================================

📌 Project Overview
===================
This is a **file upload system** built using **CodeIgniter 3 (CI3)** with **AJAX integration**.  
It allows users to upload **image** (``jpg, jpeg, png, gif``) and **PDF** (``pdf``) files  
with a maximum size of **2MB**.

🔹 The Admin Panel Provides:
-----------------------------
✔️ View uploaded files  
✔️ Download files  
✔️ Delete files  

📂 Features
===========
✅ **AJAX-based file upload** (reduces page reloads)  
✅ **File validation** (allowed types: images & PDFs, max size: 2MB)  
✅ **Secure file storage** (encrypted filenames)  
✅ **Admin panel** to manage uploaded files  
✅ **File preview** for images and PDFs  
✅ **Dynamic deletion** of files using AJAX  

🏗️ Project Structure
=====================
::

    /application
      /controllers
        - Upload.php   # Handles file uploads
        - Admin.php    # Manages uploaded files (view, download, delete)
      /models
        - Upload_model.php  # Database interactions
      /views
        - upload_form.php  # User file upload form with AJAX
        - admin_files.php  # Admin panel to manage files
    /uploads/  # Directory to store uploaded files
    /assets/   # CSS, JS, Bootstrap

📜 Database Structure
=====================
Create a table named **uploads** in MySQL:

.. code-block:: sql

    CREATE TABLE uploads (
      id INT AUTO_INCREMENT PRIMARY KEY,
      file_name VARCHAR(255) NOT NULL,
      file_type VARCHAR(50) NOT NULL,
      file_size FLOAT NOT NULL,
      file_path VARCHAR(255) NOT NULL,
      uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

🚀 Installation & Setup
========================
**Clone the repository:**

.. code-block:: bash

    git clone https://github.com/yourusername/your-repo.git
    cd your-repo

**Configure database settings in** ``application/config/database.php``.

**Ensure the** ``uploads/`` **folder is writable:**

.. code-block:: bash

    chmod -R 777 uploads/

**Import the** ``uploads`` **table into your MySQL database.**  

**Run the project on localhost** (e.g., using XAMPP or Apache).

🔧 Usage
=========
- **Upload Page**: `http://yourdomain.com/upload <http://yourdomain.com/upload>`_  
- **Admin Panel**: `http://yourdomain.com/admin <http://yourdomain.com/admin>`_  

🎯 Technologies Used
=====================
- ✅ **CodeIgniter 3** (PHP framework)  
- ✅ **MySQL** (Database)  
- ✅ **AJAX & jQuery** (Dynamic content loading)  
- ✅ **Bootstrap 5** (UI styling)  

🛡️ Security Measures
=====================
🔒 Restricts file types to images & PDFs  
🔒 Encrypts file names before storing  
🔒 Prevents direct script access  

📩 Contributions
================
Feel free to **fork**, **clone**, and submit **pull requests**. 🚀  

📜 License
==========
This project is open-source and available under the **MIT License**.

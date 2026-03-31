<?php
require_once '../auth/session.php';
checkAccess('admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Student Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        /* Registration Page Specific Styles */
        :root {
            --primary-deep: #00264d;
            --primary-soft: #1a6fb0;
            --success: #2b7e3a;
            --border-radius-card: 32px;
        }

        .registration-container {
            background: var(--white);
            border-radius: 30px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-top: 20px;
        }

        /* header */
        .reg-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
            color: white;
        }

        .reg-header::after {
            content: "📝";
            font-size: 80px;
            opacity: 0.1;
            position: absolute;
            bottom: -10px;
            right: 20px;
            pointer-events: none;
        }

        .title-section h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        /* form content */
        .form-content {
            padding: 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 40px;
        }

        /* left panel: image upload */
        .image-panel {
            background: var(--light-bg);
            border-radius: 20px;
            padding: 28px;
            text-align: center;
            border: 1px solid rgba(77, 143, 204, 0.2);
            height: fit-content;
        }

        .image-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #e2e8f0;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 4px solid var(--primary-light);
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-btn {
            background: white;
            border: 1px solid var(--primary-light);
            padding: 8px 16px;
            border-radius: 60px;
            font-weight: 600;
            color: var(--primary-medium);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .file-input { display: none; }

        /* fields */
        .field-group { margin-bottom: 20px; }
        .field-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--primary-medium);
            margin-bottom: 6px;
        }

        .field-group input, .field-group select {
            width: 100%;
            padding: 12px 18px;
            border: 1px solid rgba(77, 143, 204, 0.3);
            border-radius: 10px;
            font-size: 0.9rem;
        }

        .row-2cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .submit-btn {
            background: linear-gradient(95deg, var(--primary-medium), var(--primary-light));
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: 700;
            color: white;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            padding: 8px 16px;
            background: rgba(255,255,255,0.1);
            border-radius: 50px;
            transition: 0.3s;
        }

        .back-btn:hover { background: rgba(255,255,255,0.2); }

        @media (max-width: 1100px) {
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php include '../include/admin_sidebar.php'; ?>
        
        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay"></div>
        
        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Top Header -->
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="page-title"><h1>Add Student</h1></div>
                </div>
            </div>
            
            <div class="dashboard-content">
                <div style="margin-bottom: 25px; display: flex; justify-content: flex-start;">
                    <a href="manage_students.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Student List
                    </a>
                </div>

                <div class="registration-container">
                    <div class="reg-header">
                        <div class="title-section">
                            <h1><i class="fas fa-user-plus"></i> New Student Admission</h1>
                            <p>Enter details below to register a new student into the system.</p>
                        </div>
                    </div>

                    <div class="form-content">
                        <form id="registrationForm">
                            <div class="form-grid">
                                <!-- Left: Image Upload -->
                                <div class="image-panel">
                                    <div class="image-preview" id="imagePreview">
                                        <i class="fas fa-camera fa-3x" style="color: #cbd5e0;"></i>
                                    </div>
                                    <label class="upload-btn" for="studentImage">
                                        <i class="fas fa-cloud-upload-alt"></i> Upload Photo
                                    </label>
                                    <input type="file" id="studentImage" accept="image/*" class="file-input">
                                </div>

                                <!-- Right: Form Fields -->
                                <div class="fields-panel">
                                    <div class="field-group">
                                        <label>Full Name *</label>
                                        <input type="text" placeholder="Full legal name" required>
                                    </div>

                                    <div class="row-2cols">
                                        <div class="field-group">
                                            <label>Admission No *</label>
                                            <input type="text" placeholder="TT/26/xxx" required>
                                        </div>
                                        <div class="field-group">
                                            <label>Age *</label>
                                            <input type="number" placeholder="Age" required>
                                        </div>
                                    </div>

                                    <div class="field-group">
                                        <label>Parent / Guardian *</label>
                                        <input type="text" placeholder="Guardian Name" required>
                                    </div>

                                    <div class="row-2cols">
                                        <div class="field-group">
                                            <label><i class="fas fa-phone-alt"></i> Contact Number *</label>
                                            <input type="tel" name="contact" placeholder="Phone number" required>
                                        </div>
                                        <div class="field-group">
                                            <label><i class="fas fa-envelope"></i> Email Address *</label>
                                            <input type="email" name="email" placeholder="student@school.edu" required>
                                        </div>
                                    </div>

                                    <div class="row-2cols">
                                        <div class="field-group">
                                            <label><i class="fas fa-lock"></i> Login Password *</label>
                                            <input type="password" name="password" placeholder="Create password" required>
                                        </div>
                                        <div class="field-group">
                                            <label><i class="fas fa-calendar-week"></i> Academic Session *</label>
                                            <select name="session" required>
                                                <option value="2024-2025">2024-2025</option>
                                                <option value="2025-2026" selected>2025-2026</option>
                                                <option value="2026-2027">2026-2027</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="submit-btn"><i class="fas fa-save"></i> Save Student Record</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Image preview logic
        document.getElementById('studentImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('imagePreview').innerHTML = `<img src="${ev.target.result}" alt="Preview">`;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>

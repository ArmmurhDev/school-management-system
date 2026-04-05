<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('admin');

// Fetch dynamic data from database
$positions = getStaffPositions($pdo);
$subjects = getSubjects($pdo);

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize inputs
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $qualification = filter_input(INPUT_POST, 'qualification', FILTER_SANITIZE_STRING);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // Basic validation
    if (empty($full_name) || empty($email) || empty($password)) {
        $error_message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        try {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM staff WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetchColumn() > 0) {
                $error_message = "This email is already registered.";
            } else {
                // Handle image upload
                $image_name = NULL;
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                    $filename = $_FILES['image']['name'];
                    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    
                    if (in_array($ext, $allowed)) {
                        // Generate a unique name for the image
                        $image_name = "staff_" . time() . "_" . uniqid() . "." . $ext;
                        $upload_path = "../assets/images/staff/" . $image_name;
                        
                        if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                            $error_message = "Failed to upload image.";
                        }
                    } else {
                        $error_message = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
                    }
                }

                if (empty($error_message)) {
                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert into database
                    $stmt = $pdo->prepare("INSERT INTO staff (full_name, email, password, qualification, subject, position, phone, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    if ($stmt->execute([$full_name, $email, $hashed_password, $qualification, $subject, $position, $phone, $image_name])) {
                        $success_message = "Staff member registered successfully!";
                    } else {
                        $error_message = "Something went wrong. Please try again.";
                    }
                }
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Staff Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        :root {
            --primary-deep: #00264d;
            --primary-soft: #1a6fb0;
            --success: #2b7e3a;
            --border-radius-card: 32px;
        }

        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 10px; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }

        .registration-container {
            background: var(--white);
            border-radius: 30px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-top: 20px;
        }

        .reg-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
            color: white;
        }

        .title-section h1 { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.8rem; font-weight: 700; color: white; margin-bottom: 8px; }

        .form-content { padding: 40px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1.5fr; gap: 40px; }

        .image-panel { background: var(--light-bg); border-radius: 20px; padding: 28px; text-align: center; border: 1px solid rgba(77, 143, 204, 0.2); height: fit-content; }
        .image-preview { width: 150px; height: 150px; border-radius: 50%; background: #e2e8f0; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 4px solid var(--primary-light); }
        .image-preview img { width: 100%; height: 100%; object-fit: cover; }

        .upload-btn { background: white; border: 1px solid var(--primary-light); padding: 8px 16px; border-radius: 60px; font-weight: 600; color: var(--primary-medium); cursor: pointer; display: inline-flex; align-items: center; gap: 8px; }
        .file-input { display: none; }

        .field-group { margin-bottom: 20px; }
        .field-group label { display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--primary-medium); margin-bottom: 6px; }
        .field-group input, .field-group select { width: 100%; padding: 12px 18px; border: 1px solid rgba(77, 143, 204, 0.3); border-radius: 10px; font-size: 0.9rem; }

        .row-2cols { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .submit-btn { background: linear-gradient(95deg, var(--primary-medium), var(--primary-light)); border: none; padding: 14px; border-radius: 10px; font-weight: 700; color: white; cursor: pointer; width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; }

        @media (max-width: 1100px) { .form-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../include/admin_sidebar.php'; ?>
        <div class="overlay" id="overlay"></div>
        <div class="main-content" id="mainContent">
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="page-title"><h1>Add Staff</h1></div>
                </div>
            </div>
            
            <div class="dashboard-content">
                <div style="margin-bottom: 25px;">
                    <a href="manage_staff.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Staff List
                    </a>
                </div>

                <?php if ($success_message): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <div class="registration-container">
                    <div class="reg-header">
                        <div class="title-section">
                            <h1><i class="fas fa-user-tie"></i> New Staff Registration</h1>
                            <p>Enter details below to register a new staff member into the system.</p>
                        </div>
                    </div>

                    <div class="form-content">
                        <form id="staffRegistrationForm" action="add_new_staff.php" method="POST" enctype="multipart/form-data">
                            <div class="form-grid">
                                <div class="image-panel">
                                    <div class="image-preview" id="imagePreview">
                                        <i class="fas fa-user-circle fa-4x" style="color: #cbd5e0;"></i>
                                    </div>
                                    <label class="upload-btn" for="staffImage">
                                        <i class="fas fa-camera"></i> Upload Staff Photo
                                    </label>
                                    <input type="file" id="staffImage" name="image" accept="image/*" class="file-input">
                                    <p style="font-size: 0.7rem; margin-top: 12px; color: var(--text-muted);">Stored in assets/images/staff/</p>
                                </div>

                                <div class="fields-panel">
                                    <div class="field-group">
                                        <label>Full Name *</label>
                                        <input type="text" name="full_name" placeholder="Full legal name" value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>" required>
                                    </div>

                                    <div class="row-2cols">
                                        <div class="field-group">
                                            <label>Email Address *</label>
                                            <input type="email" name="email" placeholder="email@ttschool.edu" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                                        </div>
                                        <div class="field-group">
                                            <label>Phone Number *</label>
                                            <input type="tel" name="phone" placeholder="e.g., +123 456 7890" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="row-2cols">
                                        <div class="field-group">
                                            <label>Qualification *</label>
                                            <input type="text" name="qualification" placeholder="e.g., B.Ed" value="<?php echo isset($_POST['qualification']) ? htmlspecialchars($_POST['qualification']) : ''; ?>" required>
                                        </div>
                                        <div class="field-group">
                                            <label>Subject / Specialization</label>
                                            <select name="subject">
                                                <option value="">Select Subject (Optional)</option>
                                                <?php foreach ($subjects as $sub): ?>
                                                    <option value="<?php echo $sub; ?>" <?php echo (isset($_POST['subject']) && $_POST['subject'] == $sub) ? 'selected' : ''; ?>>
                                                        <?php echo $sub; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row-2cols">
                                        <div class="field-group">
                                            <label>Position / Role *</label>
                                            <select name="position" required>
                                                <option value="">Select Position</option>
                                                <?php foreach ($positions as $pos): ?>
                                                    <option value="<?php echo $pos; ?>" <?php echo (isset($_POST['position']) && $_POST['position'] == $pos) ? 'selected' : ''; ?>>
                                                        <?php echo $pos; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="field-group">
                                            <label>Login Password *</label>
                                            <input type="password" name="password" placeholder="Create login password" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="submit-btn"><i class="fas fa-save"></i> Register Staff Member</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
        }
        
        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }

        const staffImageInput = document.getElementById('staffImage');
        if (staffImageInput) {
            staffImageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        document.getElementById('imagePreview').innerHTML = `<img src="${ev.target.result}" alt="Preview">`;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</body>
</html>
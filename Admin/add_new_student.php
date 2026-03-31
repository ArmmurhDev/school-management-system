<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Student Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-dark: #003366;
            --primary-deep: #00264d;
            --primary-medium: #00509E;
            --primary-soft: #1a6fb0;
            --primary-light: #4D8FCC;
            --light-bg: #F0F8FF;
            --white: #FFFFFF;
            --text-dark: #1A2C3E;
            --text-soft: #2c3e50;
            --text-muted: #5a6e7c;
            --shadow-sm: 0 8px 20px rgba(0, 51, 102, 0.08);
            --shadow-md: 0 12px 28px rgba(0, 51, 102, 0.12);
            --success: #2b7e3a;
            --border-radius-card: 32px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(145deg, #eef5fc 0%, #e2edf7 100%);
            color: var(--text-dark);
            line-height: 1.5;
            padding: 28px 20px;
            min-height: 100vh;
        }

        .registration-container {
            max-width: 1300px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 48px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* header */
        .reg-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
        }

        .reg-header::after {
            content: "📝";
            font-size: 130px;
            opacity: 0.08;
            position: absolute;
            bottom: -20px;
            right: 20px;
            pointer-events: none;
        }

        .title-section h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
            margin-bottom: 8px;
        }

        .title-section p {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
        }

        .stats-badge {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 6px 18px;
            font-size: 0.8rem;
            display: inline-block;
            margin-top: 12px;
        }

        /* form content */
        .form-content {
            padding: 40px 42px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 40px;
        }

        /* left panel: image upload */
        .image-panel {
            background: var(--light-bg);
            border-radius: 32px;
            padding: 28px;
            text-align: center;
            border: 1px solid rgba(77, 143, 204, 0.2);
            transition: all 0.2s;
            height: fit-content;
        }

        .image-preview {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: #e2e8f0;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 4px solid var(--primary-light);
            box-shadow: var(--shadow-sm);
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-placeholder {
            color: var(--text-muted);
            font-size: 3rem;
        }

        .upload-btn {
            background: white;
            border: 1px solid var(--primary-light);
            padding: 10px 20px;
            border-radius: 60px;
            font-weight: 600;
            color: var(--primary-medium);
            cursor: pointer;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .upload-btn:hover {
            background: var(--primary-light);
            color: white;
        }

        .file-input {
            display: none;
        }

        /* right panel: fields */
        .fields-panel {
            background: var(--white);
            border-radius: 32px;
        }

        .field-group {
            margin-bottom: 20px;
        }

        .field-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--primary-medium);
            margin-bottom: 6px;
        }

        .field-group input, .field-group select {
            width: 100%;
            padding: 12px 18px;
            border: 1px solid rgba(77, 143, 204, 0.3);
            border-radius: 60px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            transition: 0.2s;
            background: var(--white);
        }

        .field-group input:focus, .field-group select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.2);
        }

        .row-2cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .submit-btn {
            background: linear-gradient(95deg, var(--primary-medium), var(--primary-light));
            border: none;
            padding: 14px 28px;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            transition: 0.2s;
            width: 100%;
            margin-top: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            background: linear-gradient(95deg, var(--primary-dark), var(--primary-medium));
            transform: scale(0.98);
        }

        /* recent students section */
        .recent-section {
            margin-top: 48px;
            border-top: 1px solid rgba(77, 143, 204, 0.2);
            padding-top: 32px;
        }

        .recent-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .student-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        .student-card {
            background: var(--light-bg);
            border-radius: 24px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: 0.2s;
            border: 1px solid transparent;
        }

        .student-card:hover {
            border-color: var(--primary-light);
            transform: translateY(-2px);
        }

        .student-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            overflow: hidden;
            flex-shrink: 0;
        }

        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-info h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .student-info p {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .empty-list {
            text-align: center;
            padding: 40px;
            color: var(--text-muted);
            background: var(--light-bg);
            border-radius: 28px;
            grid-column: 1 / -1;
        }

        footer {
            background: var(--primary-dark);
            padding: 20px 42px;
            text-align: center;
            color: #bcd0e6;
            font-size: 0.75rem;
        }

        @media (max-width: 880px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
            .image-panel {
                max-width: 400px;
                margin: 0 auto;
            }
            .form-content {
                padding: 28px 24px;
            }
            .reg-header {
                padding: 24px 24px;
            }
            .title-section h1 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 560px) {
            .row-2cols {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .student-list {
                grid-template-columns: 1fr;
            }
        }

        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-dark);
            color: white;
            padding: 12px 28px;
            border-radius: 60px;
            font-weight: 500;
            z-index: 1000;
            font-size: 0.9rem;
            pointer-events: none;
            transition: 0.2s;
            opacity: 0;
        }
        .toast.show { opacity: 1; bottom: 40px; }
    </style>
</head>
<body>

<div class="registration-container">
    <div class="reg-header">
        <div class="title-section">
            <h1><i class="fas fa-user-plus"></i> Student Registration</h1>
            <p>T&T School · Enrollment Management System</p>
            <div class="stats-badge" id="totalCountBadge"><i class="fas fa-users"></i> Total registered: <span id="totalRegistered">0</span></div>
        </div>
    </div>

    <div class="form-content">
        <div class="form-grid">
            <!-- Left: Image Upload -->
            <div class="image-panel">
                <div class="image-preview" id="imagePreview">
                    <div class="image-placeholder">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <label class="upload-btn" for="studentImage">
                    <i class="fas fa-cloud-upload-alt"></i> Upload Photo
                </label>
                <input type="file" id="studentImage" accept="image/*" class="file-input">
                <p style="font-size: 0.7rem; margin-top: 12px; color: var(--text-muted);">JPEG or PNG, max 2MB</p>
            </div>

            <!-- Right: Form Fields -->
            <div class="fields-panel">
                <form id="registrationForm">
                    <div class="field-group">
                        <label><i class="fas fa-user-graduate"></i> Full Name *</label>
                        <input type="text" id="studentName" placeholder="e.g., Olivia Chen" required>
                    </div>

                    <div class="row-2cols">
                        <div class="field-group">
                            <label><i class="fas fa-id-card"></i> Admission Number *</label>
                            <input type="text" id="admissionNo" placeholder="e.g., STU-2025-001" required>
                        </div>
                        <div class="field-group">
                            <label><i class="fas fa-calendar-alt"></i> Age *</label>
                            <input type="number" id="age" placeholder="e.g., 16" min="5" max="100" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label><i class="fas fa-user-friends"></i> Parent / Guardian *</label>
                        <input type="text" id="parentName" placeholder="Full name of parent/guardian" required>
                    </div>

                    <div class="row-2cols">
                        <div class="field-group">
                            <label><i class="fas fa-phone-alt"></i> Contact Number *</label>
                            <input type="tel" id="contact" placeholder="+123 456 7890" required>
                        </div>
                        <div class="field-group">
                            <label><i class="fas fa-envelope"></i> Email Address *</label>
                            <input type="email" id="email" placeholder="student@ttschool.edu" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label><i class="fas fa-calendar-week"></i> Academic Session *</label>
                        <select id="session" required>
                            <option value="">Select session</option>
                            <option value="2024-2025">2024-2025</option>
                            <option value="2025-2026" selected>2025-2026</option>
                            <option value="2026-2027">2026-2027</option>
                        </select>
                    </div>

                    <button type="submit" class="submit-btn"><i class="fas fa-save"></i> Register Student</button>
                </form>
            </div>
        </div>

        <!-- Recent Registrations Section -->
        <div class="recent-section">
            <div class="recent-title">
                <i class="fas fa-history"></i> Recently Registered Students
            </div>
            <div id="recentStudentsList" class="student-list">
                <!-- dynamic list -->
            </div>
        </div>
    </div>

    <footer>
        <p><i class="fas fa-school"></i> T&T School Administration · All records are securely stored</p>
    </footer>
</div>

<div id="toastMsg" class="toast"></div>

<script>
    // Storage key
    const STORAGE_KEY = "tt_school_students";

    // Load students from localStorage
    let students = [];

    function loadStudents() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored) {
            try {
                students = JSON.parse(stored);
            } catch(e) { students = []; }
        } else {
            // Sample demo students
            students = [
                {
                    id: "STU-2025-001",
                    name: "Olivia Chen",
                    age: 16,
                    parent: "Mr. & Mrs. Chen",
                    contact: "+1 234 567 8901",
                    email: "olivia.chen@ttschool.edu",
                    session: "2025-2026",
                    imageData: null,
                    registeredAt: "2025-03-15T10:30:00"
                },
                {
                    id: "STU-2025-002",
                    name: "Liam Rodriguez",
                    age: 17,
                    parent: "Maria Rodriguez",
                    contact: "+1 234 567 8902",
                    email: "liam.rodriguez@ttschool.edu",
                    session: "2025-2026",
                    imageData: null,
                    registeredAt: "2025-03-14T09:15:00"
                }
            ];
            saveStudents();
        }
        updateUI();
    }

    function saveStudents() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(students));
        updateUI();
    }

    function updateUI() {
        // Update total badge
        document.getElementById('totalRegistered').innerText = students.length;
        // Render recent students (last 5)
        const recent = [...students].sort((a,b) => new Date(b.registeredAt) - new Date(a.registeredAt)).slice(0, 5);
        const container = document.getElementById('recentStudentsList');
        if (recent.length === 0) {
            container.innerHTML = '<div class="empty-list"><i class="fas fa-user-graduate"></i> No students registered yet. Fill the form above!</div>';
            return;
        }
        let html = '';
        recent.forEach(student => {
            const initials = student.name.split(' ').map(n => n[0]).join('').toUpperCase();
            const hasImage = student.imageData && student.imageData.startsWith('data:image');
            html += `
                <div class="student-card">
                    <div class="student-avatar">
                        ${hasImage ? `<img src="${student.imageData}" alt="${student.name}">` : `<span>${initials}</span>`}
                    </div>
                    <div class="student-info">
                        <h4>${escapeHtml(student.name)}</h4>
                        <p>${student.id} · ${student.session}</p>
                        <p style="font-size: 0.65rem;"><i class="fas fa-envelope"></i> ${escapeHtml(student.email)}</p>
                    </div>
                </div>
            `;
        });
        container.innerHTML = html;
    }

    // Helper: escape HTML
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    // Toast notification
    function showToast(message, isError = false) {
        const toast = document.getElementById('toastMsg');
        toast.textContent = message;
        toast.style.backgroundColor = isError ? '#c23b22' : '#00509E';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }

    // Check duplicate admission number
    function isDuplicateAdmission(admissionNo) {
        return students.some(s => s.id === admissionNo);
    }

    // Validate email format
    function isValidEmail(email) {
        const re = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
        return re.test(email);
    }

    // Handle image preview
    const imageInput = document.getElementById('studentImage');
    const imagePreviewDiv = document.getElementById('imagePreview');
    let selectedImageData = null;

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        if (!file.type.startsWith('image/')) {
            showToast("Please select a valid image file", true);
            imageInput.value = '';
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            showToast("Image size must be less than 2MB", true);
            imageInput.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(ev) {
            selectedImageData = ev.target.result;
            imagePreviewDiv.innerHTML = `<img src="${selectedImageData}" alt="Student preview">`;
        };
        reader.readAsDataURL(file);
    });

    // Form submission
    const form = document.getElementById('registrationForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Gather values
        const name = document.getElementById('studentName').value.trim();
        const admissionNo = document.getElementById('admissionNo').value.trim();
        const age = parseInt(document.getElementById('age').value);
        const parent = document.getElementById('parentName').value.trim();
        const contact = document.getElementById('contact').value.trim();
        const email = document.getElementById('email').value.trim();
        const session = document.getElementById('session').value;

        // Validation
        if (!name || !admissionNo || !age || !parent || !contact || !email || !session) {
            showToast("Please fill all required fields", true);
            return;
        }
        if (isNaN(age) || age < 5 || age > 100) {
            showToast("Please enter a valid age (5-100)", true);
            return;
        }
        if (!isValidEmail(email)) {
            showToast("Please enter a valid email address", true);
            return;
        }
        if (isDuplicateAdmission(admissionNo)) {
            showToast(`Admission number ${admissionNo} already exists.`, true);
            return;
        }

        // Create student object
        const newStudent = {
            id: admissionNo,
            name: name,
            age: age,
            parent: parent,
            contact: contact,
            email: email,
            session: session,
            imageData: selectedImageData || null,
            registeredAt: new Date().toISOString()
        };

        students.unshift(newStudent); // add to beginning
        saveStudents();

        // Reset form and image preview
        form.reset();
        document.getElementById('session').value = "2025-2026"; // reset default
        selectedImageData = null;
        imagePreviewDiv.innerHTML = `<div class="image-placeholder"><i class="fas fa-camera"></i></div>`;
        imageInput.value = '';
        
        showToast(`✅ Student ${name} (${admissionNo}) registered successfully!`);
        updateUI();
    });

    // Initial load
    loadStudents();
</script>
</body>
</html>
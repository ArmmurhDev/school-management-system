<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - T&T School Student Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #003366;
            --primary-medium: #00509E;
            --primary-light: #4D8FCC;
            --accent-blue: #1E88E5;
            --light-bg: #F0F8FF;
            --student-blue: #3A7CA5;
            --text-dark: #333333;
            --text-light: #666666;
            --white: #FFFFFF;
            --shadow: rgba(0, 51, 102, 0.1);
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background: linear-gradient(135deg, var(--light-bg) 0%, #E3F2FD 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .logout-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
        
        /* Logo Header */
        .logo-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .logo-wrapper {
            display: inline-flex;
            align-items: center;
            background-color: var(--white);
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 51, 102, 0.1);
            margin-bottom: 25px;
        }
        
        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--student-blue), var(--accent-blue));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }
        
        .logo-icon i {
            font-size: 28px;
            color: var(--white);
        }
        
        .logo-text h1 {
            font-size: 2rem;
            margin-bottom: 5px;
            color: var(--primary-dark);
        }
        
        .logo-text p {
            color: var(--student-blue);
            font-size: 1rem;
        }
        
        /* Logout Card */
        .logout-card {
            background-color: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 51, 102, 0.15);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .logout-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--student-blue), var(--accent-blue));
        }
        
        .student-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .student-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 20px;
            border: 5px solid var(--light-bg);
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.1);
            position: relative;
        }
        
        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .student-badge {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 30px;
            height: 30px;
            background-color: var(--student-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 0.8rem;
            border: 2px solid var(--white);
        }
        
        .student-details h3 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }
        
        .student-details p {
            color: var(--text-light);
            font-size: 0.95rem;
        }
        
        .student-id {
            display: inline-block;
            background-color: var(--light-bg);
            color: var(--student-blue);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: 10px;
        }
        
        /* Session Summary */
        .session-summary {
            background-color: var(--light-bg);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: left;
        }
        
        .session-summary h4 {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: var(--student-blue);
        }
        
        .session-summary h4 i {
            margin-right: 10px;
            color: var(--student-blue);
        }
        
        .session-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .stat-item {
            background-color: var(--white);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 51, 102, 0.05);
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 1.1rem;
        }
        
        .stat-icon.courses {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .stat-icon.activities {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .stat-icon.messages {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .stat-icon.time {
            background-color: rgba(103, 58, 183, 0.1);
            color: #673ab7;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .session-details {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            text-align: left;
        }
        
        .session-details h5 {
            font-size: 1rem;
            margin-bottom: 15px;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
        }
        
        .session-details h5 i {
            margin-right: 10px;
            color: var(--student-blue);
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #ddd;
        }
        
        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .detail-value {
            color: var(--student-blue);
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            min-width: 160px;
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.1);
        }
        
        .btn i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
        
        .btn-logout {
            background: linear-gradient(to right, var(--danger), #e53935);
            color: var(--white);
        }
        
        .btn-logout:hover {
            background: linear-gradient(to right, #c62828, #d32f2f);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.25);
        }
        
        .btn-cancel {
            background-color: var(--white);
            color: var(--student-blue);
            border: 2px solid var(--primary-light);
        }
        
        .btn-cancel:hover {
            background-color: var(--light-bg);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 51, 102, 0.15);
        }
        
        /* Security Notice */
        .security-notice {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff8e1;
            border-radius: 10px;
            border-left: 4px solid var(--warning);
            text-align: left;
        }
        
        .security-notice h5 {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #856404;
        }
        
        .security-notice h5 i {
            margin-right: 10px;
        }
        
        .security-notice p {
            font-size: 0.9rem;
            color: #856404;
            line-height: 1.6;
        }
        
        /* Important Reminder */
        .reminder-box {
            margin-top: 25px;
            padding: 20px;
            background-color: #e8f4ff;
            border-radius: 10px;
            border-left: 4px solid var(--accent-blue);
            text-align: left;
        }
        
        .reminder-box h5 {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: var(--primary-medium);
        }
        
        .reminder-box h5 i {
            margin-right: 10px;
        }
        
        .reminder-box p {
            font-size: 0.9rem;
            color: var(--text-light);
            line-height: 1.6;
        }
        
        /* Logout Process */
        .logout-process {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        
        .spinner {
            width: 80px;
            height: 80px;
            border: 5px solid var(--light-bg);
            border-top: 5px solid var(--student-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 30px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .logout-process h3 {
            margin-bottom: 15px;
            color: var(--student-blue);
        }
        
        .logout-process p {
            color: var(--text-light);
            text-align: center;
            max-width: 350px;
        }
        
        /* Quick Links */
        .quick-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        .quick-link {
            display: inline-flex;
            align-items: center;
            color: var(--student-blue);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 8px 15px;
            border-radius: 20px;
            background-color: rgba(58, 124, 165, 0.1);
            transition: all 0.3s;
        }
        
        .quick-link i {
            margin-right: 8px;
            font-size: 0.9rem;
        }
        
        .quick-link:hover {
            background-color: rgba(58, 124, 165, 0.2);
            transform: translateY(-2px);
        }
        
        /* Footer */
        .logout-footer {
            text-align: center;
            margin-top: 40px;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .logout-footer a {
            color: var(--student-blue);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .logout-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .logout-card {
                padding: 30px 25px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 15px;
            }
            
            .btn {
                min-width: 100%;
            }
            
            .logo-wrapper {
                padding: 15px 20px;
            }
            
            .logo-text h1 {
                font-size: 1.7rem;
            }
            
            .session-stats {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .logout-card {
                padding: 25px 20px;
            }
            
            .logo-wrapper {
                flex-direction: column;
                text-align: center;
            }
            
            .logo-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .student-avatar {
                width: 80px;
                height: 80px;
            }
            
            .session-summary {
                padding: 20px;
            }
            
            .session-details {
                padding: 15px;
            }
            
            .quick-links {
                flex-direction: column;
                align-items: center;
            }
            
            .quick-link {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Animation for logout process */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .logout-card:hover {
            animation: pulse 2s infinite;
        }
        
        /* Return link styling */
        .return-link {
            display: inline-flex;
            align-items: center;
            color: var(--student-blue);
            text-decoration: none;
            font-weight: 500;
            margin-top: 20px;
            transition: all 0.3s;
        }
        
        .return-link i {
            margin-right: 8px;
            transition: transform 0.3s;
        }
        
        .return-link:hover {
            color: var(--primary-dark);
        }
        
        .return-link:hover i {
            transform: translateX(-5px);
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <!-- Logo Header -->
        <div class="logo-header">
            <div class="logo-wrapper">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="logo-text">
                    <h1>T&T School</h1>
                    <p>Student Portal</p>
                </div>
            </div>
        </div>
        
        <!-- Logout Card -->
        <div class="logout-card" id="logoutCard">
            <div class="student-info">
                <div class="student-avatar">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael Johnson">
                    <div class="student-badge">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
                <div class="student-details">
                    <h3>Michael Johnson</h3>
                    <p>Grade 10 Student | Section A</p>
                    <div class="student-id">ID: STU-2023-045</div>
                    <p style="margin-top: 10px; color: var(--primary-light); font-size: 0.9rem;">
                        <i class="fas fa-envelope"></i> m.johnson@ttschool.edu
                    </p>
                </div>
            </div>
            
            <div class="session-summary">
                <h4><i class="fas fa-chart-line"></i> Today's Session Summary</h4>
                
                <div class="session-stats">
                    <div class="stat-item">
                        <div class="stat-icon courses">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-value">4</div>
                        <div class="stat-label">Courses Accessed</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon activities">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-value">7</div>
                        <div class="stat-label">Activities Completed</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon messages">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-value">3</div>
                        <div class="stat-label">New Messages</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon time">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-value">2.5h</div>
                        <div class="stat-label">Session Duration</div>
                    </div>
                </div>
                
                <div class="session-details">
                    <h5><i class="fas fa-clock"></i> Session Details</h5>
                    <div class="detail-item">
                        <span class="detail-label">Login Time:</span>
                        <span class="detail-value">Today, 9:15 AM</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Last Activity:</span>
                        <span class="detail-value">10 minutes ago</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Device:</span>
                        <span class="detail-value">Chrome on Windows</span>
                    </div>
                </div>
            </div>
            
            <div class="reminder-box">
                <h5><i class="fas fa-bell"></i> Before You Leave...</h5>
                <p>Make sure you've saved all your work and submitted any pending assignments. Your progress has been automatically saved.</p>
            </div>
            
            <div class="security-notice">
                <h5><i class="fas fa-shield-alt"></i> Security Reminder</h5>
                <p>Always log out from shared computers. If you're using a school computer, make sure to clear browser cache if needed for privacy.</p>
            </div>
            
            <div class="action-buttons">
                <button class="btn btn-cancel" id="cancelBtn">
                    <i class="fas fa-arrow-left"></i> Back to Portal
                </button>
                <button class="btn btn-logout" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
            
            <div class="quick-links">
                <a href="student-dashboard.html" class="quick-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="student-courses.html" class="quick-link">
                    <i class="fas fa-book"></i> My Courses
                </a>
                <a href="student-assignments.html" class="quick-link">
                    <i class="fas fa-tasks"></i> Assignments
                </a>
                <a href="student-grades.html" class="quick-link">
                    <i class="fas fa-chart-line"></i> Grades
                </a>
            </div>
            
            <div class="logout-footer">
                <p>Need help? Contact <a href="mailto:support@ttschool.edu">Student Support</a>.</p>
                <p style="margin-top: 10px; font-size: 0.85rem;">&copy; 2023 T&T School Student Portal</p>
            </div>
        </div>
        
        <!-- Logout Process Screen -->
        <div class="logout-card logout-process" id="logoutProcess">
            <div class="spinner"></div>
            <h3>Securing Your Session...</h3>
            <p>Please wait while we save your progress and securely end your session.</p>
            <p style="margin-top: 15px; font-size: 0.9rem; color: var(--student-blue);">
                <i class="fas fa-sync-alt"></i> Saving your latest activity...
            </p>
        </div>
    </div>

    <script>
        // DOM Elements
        const logoutCard = document.getElementById('logoutCard');
        const logoutProcess = document.getElementById('logoutProcess');
        const logoutBtn = document.getElementById('logoutBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        
        // Session data
        const sessionData = {
            loginTime: new Date(new Date().setHours(9, 15, 0)),
            lastActivity: new Date(new Date().setMinutes(new Date().getMinutes() - 10)),
            coursesAccessed: 4,
            activitiesCompleted: 7,
            newMessages: 3,
            device: "Chrome on Windows"
        };
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateSessionDetails();
            setupEventListeners();
            startInactivityTimer();
        });
        
        // Setup event listeners
        function setupEventListeners() {
            // Logout Button Click
            logoutBtn.addEventListener('click', function() {
                startLogoutProcess();
            });
            
            // Cancel Button Click
            cancelBtn.addEventListener('click', function() {
                if (confirm('Return to student dashboard without logging out?')) {
                    window.location.href = 'student-dashboard.html';
                }
            });
            
            // Quick links
            document.querySelectorAll('.quick-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const destination = this.getAttribute('href');
                    if (confirm(`Navigate to ${this.textContent.trim()}?`)) {
                        window.location.href = destination;
                    }
                });
            });
            
            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Escape key to cancel
                if (e.key === 'Escape') {
                    if (confirm('Return to dashboard without logging out?')) {
                        window.location.href = 'student-dashboard.html';
                    }
                }
                
                // L key to logout (with Ctrl)
                if (e.ctrlKey && e.key === 'l') {
                    e.preventDefault();
                    logoutBtn.click();
                }
            });
        }
        
        // Update session details
        function updateSessionDetails() {
            const now = new Date();
            const loginTime = sessionData.loginTime;
            
            // Calculate session duration
            const durationMs = now - loginTime;
            const hours = Math.floor(durationMs / (1000 * 60 * 60));
            const minutes = Math.floor((durationMs % (1000 * 60 * 60)) / (1000 * 60));
            
            // Update session duration in stats
            document.querySelector('.stat-icon.time + .stat-value').textContent = 
                `${hours}h ${minutes}m`;
                
            // Update last activity time
            const lastActivity = sessionData.lastActivity;
            const timeDiff = now - lastActivity;
            const minutesAgo = Math.floor(timeDiff / (1000 * 60));
            
            let lastActivityText = "Just now";
            if (minutesAgo > 0) {
                lastActivityText = `${minutesAgo} minute${minutesAgo !== 1 ? 's' : ''} ago`;
            }
            
            document.querySelectorAll('.detail-item')[1].querySelector('.detail-value').textContent = 
                lastActivityText;
        }
        
        // Start logout process
        function startLogoutProcess() {
            // Show loading animation
            logoutCard.style.display = 'none';
            logoutProcess.style.display = 'flex';
            
            // Step 1: Saving progress
            setTimeout(() => {
                updateProgressMessage('Saving your progress...', 25);
            }, 1000);
            
            // Step 2: Ending session
            setTimeout(() => {
                updateProgressMessage('Ending your session...', 50);
            }, 2000);
            
            // Step 3: Clearing temporary data
            setTimeout(() => {
                updateProgressMessage('Clearing temporary data...', 75);
            }, 3000);
            
            // Step 4: Complete
            setTimeout(() => {
                updateProgressMessage('Logout successful!', 100);
                
                // Change spinner to checkmark
                const spinner = logoutProcess.querySelector('.spinner');
                spinner.style.border = '5px solid #28a745';
                spinner.style.borderTop = '5px solid #28a745';
                spinner.style.animation = 'none';
                spinner.innerHTML = '<i class="fas fa-check" style="font-size: 2.5rem; color: #28a745; line-height: 70px;"></i>';
                
                logoutProcess.querySelector('h3').textContent = 'Successfully Logged Out!';
                logoutProcess.querySelector('p').textContent = 'You have been securely logged out. Redirecting to login page...';
                
                // Redirect to login page after 2 seconds
                setTimeout(() => {
                    window.location.href = 'student-login.html';
                }, 2000);
            }, 4000);
        }
        
        // Update progress message
        function updateProgressMessage(message, percent) {
            const progressMessage = logoutProcess.querySelector('p');
            const subMessage = logoutProcess.querySelector('p:nth-child(4)');
            
            progressMessage.textContent = message;
            
            // Update submessage based on progress
            if (percent < 50) {
                subMessage.innerHTML = '<i class="fas fa-sync-alt"></i> Saving your latest activity...';
            } else if (percent < 75) {
                subMessage.innerHTML = '<i class="fas fa-lock"></i> Securing your account...';
            } else {
                subMessage.innerHTML = '<i class="fas fa-check-circle"></i> Almost done...';
            }
        }
        
        // Inactivity timer (auto-logout after 5 minutes of inactivity)
        let inactivityTimer;
        function startInactivityTimer() {
            resetInactivityTimer();
            
            // Reset timer on user activity
            document.addEventListener('mousemove', resetInactivityTimer);
            document.addEventListener('keypress', resetInactivityTimer);
            document.addEventListener('click', resetInactivityTimer);
        }
        
        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(() => {
                // Show auto-logout warning
                if (confirm('You have been inactive for a while. Would you like to stay logged in?')) {
                    resetInactivityTimer();
                } else {
                    startLogoutProcess();
                }
            }, 300000); // 5 minutes
        }
        
        // Update session stats in real-time (simulated)
        function simulateActivityUpdates() {
            // Randomly increment activities completed
            setInterval(() => {
                const activitiesElement = document.querySelector('.stat-icon.activities + .stat-value');
                const currentActivities = parseInt(activitiesElement.textContent);
                
                // 10% chance to increment
                if (Math.random() < 0.1) {
                    activitiesElement.textContent = currentActivities + 1;
                    sessionData.activitiesCompleted = currentActivities + 1;
                    
                    // Show notification
                    showNotification('New activity recorded!');
                }
            }, 30000); // Every 30 seconds
            
            // Update last activity time
            setInterval(() => {
                sessionData.lastActivity = new Date();
                updateSessionDetails();
            }, 60000); // Every minute
        }
        
        // Show notification
        function showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: var(--student-blue);
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                z-index: 1000;
                animation: slideIn 0.3s ease;
                max-width: 300px;
            `;
            
            notification.innerHTML = `
                <div style="display: flex; align-items: center;">
                    <i class="fas fa-info-circle" style="margin-right: 10px;"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
        
        // Add CSS for notification animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
        
        // Start simulating activity updates
        simulateActivityUpdates();
        
        // Add a return link at the bottom
        const returnLink = document.createElement('a');
        returnLink.href = 'student-dashboard.html';
        returnLink.className = 'return-link';
        returnLink.innerHTML = '<i class="fas fa-arrow-left"></i> Return to Student Dashboard';
        returnLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Return to dashboard without logging out?')) {
                window.location.href = 'student-dashboard.html';
            }
        });
        
        document.querySelector('.logout-footer').appendChild(returnLink);
    </script>
</body>
</html>
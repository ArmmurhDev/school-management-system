<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #003366;
            --primary-medium: #00509E;
            --primary-light: #4D8FCC;
            --accent-blue: #1E88E5;
            --light-bg: #F0F8FF;
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
            background: linear-gradient(135deg, var(--primary-dark), var(--accent-blue));
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
            color: var(--primary-medium);
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
            background: linear-gradient(to right, var(--primary-light), var(--accent-blue));
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 20px;
            border: 5px solid var(--light-bg);
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.1);
        }
        
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .user-details h3 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }
        
        .user-details p {
            color: var(--text-light);
            font-size: 0.95rem;
        }
        
        .logout-message {
            background-color: var(--light-bg);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: left;
        }
        
        .logout-message h4 {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: var(--primary-medium);
        }
        
        .logout-message h4 i {
            margin-right: 10px;
            color: var(--primary-medium);
        }
        
        .logout-message p {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.7;
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
            color: var(--primary-medium);
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
            color: var(--primary-medium);
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
            color: var(--primary-medium);
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
        
        /* Footer */
        .logout-footer {
            text-align: center;
            margin-top: 40px;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .logout-footer a {
            color: var(--primary-medium);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .logout-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* Animation for logout process */
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
            border-top: 5px solid var(--primary-medium);
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
            color: var(--primary-medium);
        }
        
        .logout-process p {
            color: var(--text-light);
            text-align: center;
            max-width: 350px;
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
            
            .user-avatar {
                width: 80px;
                height: 80px;
            }
            
            .logout-message {
                padding: 20px;
            }
            
            .session-details {
                padding: 15px;
            }
        }
        
        /* Return link styling */
        .return-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary-medium);
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
                    <p>Management System</p>
                </div>
            </div>
        </div>
        
        <!-- Logout Card -->
        <div class="logout-card" id="logoutCard">
            <div class="user-info">
                <div class="user-avatar">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin User">
                </div>
                <div class="user-details">
                    <h3>Dr. Sarah Williams</h3>
                    <p>Super Administrator</p>
                    <p style="color: var(--primary-light); font-size: 0.9rem;">
                        <i class="fas fa-envelope"></i> admin@ttschool.edu
                    </p>
                </div>
            </div>
            
            <div class="logout-message">
                <h4><i class="fas fa-sign-out-alt"></i> Confirm Logout</h4>
                <p>You are about to log out of the T&T School Management System. This will end your current session and you'll need to log in again to access the system.</p>
                
                <div class="session-details">
                    <h5><i class="fas fa-clock"></i> Current Session Details</h5>
                    <div class="detail-item">
                        <span class="detail-label">Login Time:</span>
                        <span class="detail-value">Today, 9:15 AM</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Session Duration:</span>
                        <span class="detail-value">3 hours, 25 minutes</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Last Activity:</span>
                        <span class="detail-value">2 minutes ago</span>
                    </div>
                </div>
            </div>
            
            <div class="security-notice">
                <h5><i class="fas fa-shield-alt"></i> Security Notice</h5>
                <p>For security reasons, please ensure you are logging out from a private device. If you are using a public or shared computer, we recommend clearing the browser cache after logout.</p>
            </div>
            
            <div class="action-buttons">
                <button class="btn btn-cancel" id="cancelBtn">
                    <i class="fas fa-arrow-left"></i> Cancel & Return
                </button>
                <button class="btn btn-logout" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
            
            <div class="logout-footer">
                <p>If you're not ready to log out, you can return to the <a href="dashboard.html" id="dashboardLink">Dashboard</a>.</p>
                <p style="margin-top: 10px; font-size: 0.85rem;">&copy; 2023 T&T School Management System</p>
            </div>
        </div>
        
        <!-- Logout Process Screen -->
        <div class="logout-card logout-process" id="logoutProcess">
            <div class="spinner"></div>
            <h3>Logging Out...</h3>
            <p>Please wait while we securely end your session and redirect you to the login page.</p>
            <p style="margin-top: 15px; font-size: 0.9rem; color: var(--primary-light);">
                <i class="fas fa-lock"></i> Securing your account...
            </p>
        </div>
    </div>

    <script>
        // DOM Elements
        const logoutCard = document.getElementById('logoutCard');
        const logoutProcess = document.getElementById('logoutProcess');
        const logoutBtn = document.getElementById('logoutBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const dashboardLink = document.getElementById('dashboardLink');
        
        // Logout Button Click
        logoutBtn.addEventListener('click', function() {
            // Show loading animation
            logoutCard.style.display = 'none';
            logoutProcess.style.display = 'flex';
            
            // Simulate logout process
            setTimeout(() => {
                // Update the message
                logoutProcess.querySelector('h3').textContent = 'Logout Successful!';
                logoutProcess.querySelector('p').textContent = 'You have been securely logged out. Redirecting to login page...';
                
                // Change spinner to checkmark
                const spinner = logoutProcess.querySelector('.spinner');
                spinner.style.border = '5px solid #28a745';
                spinner.style.borderTop = '5px solid #28a745';
                spinner.style.animation = 'none';
                spinner.innerHTML = '<i class="fas fa-check" style="font-size: 2.5rem; color: #28a745; line-height: 70px;"></i>';
                
                // Redirect to login page after 2 seconds
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 2000);
            }, 2000);
        });
        
        // Cancel Button Click
        cancelBtn.addEventListener('click', function() {
            // Show confirmation dialog
            if (confirm('Return to dashboard without logging out?')) {
                window.location.href = 'dashboard.html';
            }
        });
        
        // Dashboard Link Click
        dashboardLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Return to dashboard without logging out?')) {
                window.location.href = 'dashboard.html';
            }
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Escape key to cancel
            if (e.key === 'Escape') {
                if (confirm('Return to dashboard without logging out?')) {
                    window.location.href = 'dashboard.html';
                }
            }
            
            // L key to logout (with Ctrl)
            if (e.ctrlKey && e.key === 'l') {
                e.preventDefault();
                logoutBtn.click();
            }
        });
        
        // Auto-logout timer (optional - would cancel logout after 60 seconds of inactivity on this page)
        let inactivityTimer;
        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(() => {
                // Auto-logout after 60 seconds of inactivity
                if (confirm('You have been inactive for a while. Would you like to continue with logout?')) {
                    logoutBtn.click();
                } else {
                    resetInactivityTimer();
                }
            }, 60000); // 60 seconds
        }
        
        // Reset timer on user activity
        document.addEventListener('mousemove', resetInactivityTimer);
        document.addEventListener('keypress', resetInactivityTimer);
        document.addEventListener('click', resetInactivityTimer);
        
        // Start the inactivity timer
        resetInactivityTimer();
        
        // Simulate session data (in a real app, this would come from the server)
        function updateSessionDetails() {
            const loginTime = new Date();
            loginTime.setHours(9, 15, 0);
            
            const lastActivity = new Date();
            lastActivity.setMinutes(lastActivity.getMinutes() - 2);
            
            const sessionDuration = new Date() - loginTime;
            const hours = Math.floor(sessionDuration / (1000 * 60 * 60));
            const minutes = Math.floor((sessionDuration % (1000 * 60 * 60)) / (1000 * 60));
            
            // Update session details in real-time
            document.querySelectorAll('.detail-item')[1].querySelector('.detail-value').textContent = 
                `${hours} hours, ${minutes} minutes`;
                
            document.querySelectorAll('.detail-item')[2].querySelector('.detail-value').textContent = 
                'Just now';
        }
        
        // Update session details every minute
        setInterval(updateSessionDetails, 60000);
        
        // Add a return link at the bottom
        const returnLink = document.createElement('a');
        returnLink.href = 'dashboard.html';
        returnLink.className = 'return-link';
        returnLink.innerHTML = '<i class="fas fa-arrow-left"></i> Return to Dashboard';
        returnLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Return to dashboard without logging out?')) {
                window.location.href = 'dashboard.html';
            }
        });
        
        document.querySelector('.logout-footer').appendChild(returnLink);
    </script>
</body>
</html>
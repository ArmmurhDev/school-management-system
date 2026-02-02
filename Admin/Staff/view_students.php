<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #003366;
            --primary-medium: #00509E;
            --primary-light: #4D8FCC;
            --accent-blue: #1E88E5;
            --light-bg: #F0F8FF;
            --sidebar-bg: #002147;
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
            background-color: #f5f7fb;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: var(--white);
            transition: all 0.3s ease;
            position: fixed;
            height: 100vh;
            z-index: 100;
            overflow-y: auto;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 25px 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--accent-blue), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .logo-icon i {
            font-size: 22px;
            color: var(--white);
        }
        
        .logo-text h2 {
            font-size: 1.5rem;
            color: var(--white);
            margin-bottom: 3px;
        }
        
        .logo-text p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.8);
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-left-color: var(--accent-blue);
        }
        
        .menu-item i {
            width: 25px;
            margin-right: 15px;
            font-size: 1.1rem;
        }
        
        .menu-text {
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 2px solid var(--primary-light);
        }
        
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .user-details h4 {
            color: var(--white);
            font-size: 0.95rem;
            margin-bottom: 3px;
        }
        
        .user-details p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
        }
        
        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }
        
        /* Top Header */
        .top-header {
            background-color: var(--white);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px var(--shadow);
            position: sticky;
            top: 0;
            z-index: 99;
        }
        
        .header-left {
            display: flex;
            align-items: center;
        }
        
        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-dark);
            cursor: pointer;
            margin-right: 20px;
            display: none;
        }
        
        .page-title h1 {
            font-size: 1.8rem;
            color: var(--primary-dark);
        }
        
        .header-right {
            display: flex;
            align-items: center;
        }
        
        .header-action {
            margin-left: 25px;
            position: relative;
            cursor: pointer;
        }
        
        .header-action i {
            font-size: 1.3rem;
            color: var(--primary-medium);
            transition: color 0.3s;
        }
        
        .header-action:hover i {
            color: var(--accent-blue);
        }
        
        /* Dashboard Content */
        .dashboard-content {
            padding: 30px;
        }
        
        /* Student Profile Header */
        .student-profile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        
        .student-profile-header h2 {
            font-size: 1.8rem;
        }
        
        .student-actions {
            display: flex;
            gap: 15px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 51, 102, 0.1);
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: var(--white);
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-medium), var(--accent-blue));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 51, 102, 0.2);
        }
        
        .btn-secondary {
            background-color: var(--light-bg);
            color: var(--primary-medium);
            border: 1px solid var(--primary-light);
        }
        
        .btn-secondary:hover {
            background-color: #e3f2fd;
            transform: translateY(-2px);
        }
        
        .btn-success {
            background-color: var(--success);
            color: var(--white);
        }
        
        .btn-warning {
            background-color: var(--warning);
            color: var(--white);
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }
        
        /* Student Profile Container */
        .student-profile-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 992px) {
            .student-profile-container {
                grid-template-columns: 1fr;
            }
        }
        
        /* Student Profile Card */
        .student-profile-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
            position: sticky;
            top: 100px;
            height: fit-content;
        }
        
        .profile-header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            padding: 40px 30px;
            text-align: center;
            color: var(--white);
            position: relative;
        }
        
        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-header h3 {
            font-size: 1.5rem;
            color: var(--white);
            margin-bottom: 8px;
        }
        
        .profile-header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }
        
        .profile-status {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .status-active {
            background-color: rgba(40, 167, 69, 0.9);
        }
        
        .status-inactive {
            background-color: rgba(220, 53, 69, 0.9);
        }
        
        .profile-body {
            padding: 30px;
        }
        
        .profile-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid #eee;
        }
        
        .profile-detail:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.9rem;
        }
        
        .detail-value {
            color: var(--text-light);
            font-size: 0.9rem;
            text-align: right;
        }
        
        .profile-footer {
            padding: 20px 30px;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
        }
        
        .emergency-contact h4 {
            font-size: 1rem;
            margin-bottom: 15px;
            color: var(--primary-dark);
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        
        .contact-item i {
            width: 20px;
            color: var(--primary-medium);
            margin-right: 10px;
            margin-top: 3px;
        }
        
        /* Student Details Tabs */
        .student-details-tabs {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .tabs-header {
            display: flex;
            background-color: var(--light-bg);
            border-bottom: 1px solid #eee;
            overflow-x: auto;
        }
        
        .tab-btn {
            padding: 18px 30px;
            background: none;
            border: none;
            font-weight: 600;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
            border-bottom: 3px solid transparent;
            display: flex;
            align-items: center;
        }
        
        .tab-btn i {
            margin-right: 10px;
        }
        
        .tab-btn:hover {
            color: var(--primary-medium);
            background-color: rgba(77, 143, 204, 0.05);
        }
        
        .tab-btn.active {
            color: var(--primary-medium);
            border-bottom-color: var(--primary-medium);
            background-color: rgba(77, 143, 204, 0.1);
        }
        
        .tab-content {
            padding: 30px;
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Academic Info */
        .academic-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .academic-card {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            border-left: 4px solid var(--primary-medium);
        }
        
        .academic-card h4 {
            font-size: 1rem;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }
        
        .academic-card p {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .grades-table-container {
            overflow-x: auto;
            margin-top: 30px;
        }
        
        .grades-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .grades-table thead {
            background-color: var(--light-bg);
        }
        
        .grades-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
        }
        
        .grades-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .grade-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .grade-a {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .grade-b {
            background-color: rgba(23, 162, 184, 0.1);
            color: var(--info);
        }
        
        .grade-c {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .grade-d {
            background-color: rgba(253, 126, 20, 0.1);
            color: #fd7e14;
        }
        
        .grade-f {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        /* Attendance */
        .attendance-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .attendance-stat {
            background-color: var(--white);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 51, 102, 0.05);
            border: 1px solid #eee;
        }
        
        .attendance-stat h3 {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .attendance-stat p {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .attendance-calendar {
            margin-top: 30px;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .calendar-month {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1.2rem;
        }
        
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }
        
        .calendar-day-header {
            text-align: center;
            padding: 10px;
            font-weight: 600;
            color: var(--primary-medium);
            font-size: 0.9rem;
            background-color: var(--light-bg);
            border-radius: 5px;
        }
        
        .calendar-day {
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            font-weight: 500;
            position: relative;
        }
        
        .calendar-day.present::after {
            content: '';
            position: absolute;
            bottom: 5px;
            width: 6px;
            height: 6px;
            background-color: var(--success);
            border-radius: 50%;
        }
        
        .calendar-day.absent::after {
            content: '';
            position: absolute;
            bottom: 5px;
            width: 6px;
            height: 6px;
            background-color: var(--danger);
            border-radius: 50%;
        }
        
        .calendar-day.today {
            background-color: var(--primary-light);
            color: var(--white);
        }
        
        /* Behavior */
        .behavior-timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .behavior-timeline::before {
            content: '';
            position: absolute;
            width: 3px;
            background-color: var(--primary-light);
            top: 0;
            bottom: 0;
            left: 20px;
        }
        
        .behavior-item {
            padding-left: 50px;
            position: relative;
            margin-bottom: 30px;
        }
        
        .behavior-item::before {
            content: '';
            position: absolute;
            width: 15px;
            height: 15px;
            background-color: var(--white);
            border: 3px solid var(--primary-light);
            border-radius: 50%;
            left: 14px;
            top: 5px;
        }
        
        .behavior-item.positive::before {
            border-color: var(--success);
        }
        
        .behavior-item.negative::before {
            border-color: var(--danger);
        }
        
        .behavior-item.neutral::before {
            border-color: var(--warning);
        }
        
        .behavior-content {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
        }
        
        .behavior-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .behavior-title {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .behavior-date {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .behavior-description {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        /* Medical */
        .medical-info {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .medical-card {
            background-color: var(--white);
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 51, 102, 0.05);
            border: 1px solid #eee;
        }
        
        .medical-card h4 {
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
        }
        
        .medical-card h4 i {
            margin-right: 10px;
            color: var(--primary-medium);
        }
        
        .medical-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #eee;
        }
        
        .medical-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .medical-label {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .medical-value {
            color: var(--text-light);
            font-size: 0.95rem;
        }
        
        /* Documents */
        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .document-card {
            background-color: var(--white);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 51, 102, 0.05);
            border: 1px solid #eee;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        
        .document-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 51, 102, 0.1);
        }
        
        .document-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-medium);
            font-size: 1.3rem;
        }
        
        .document-info h5 {
            font-size: 1rem;
            margin-bottom: 5px;
            color: var(--primary-dark);
        }
        
        .document-info p {
            color: var(--text-light);
            font-size: 0.85rem;
            margin-bottom: 10px;
        }
        
        .document-actions {
            display: flex;
            gap: 10px;
        }
        
        .doc-action-btn {
            width: 30px;
            height: 30px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .doc-action-btn.view {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .doc-action-btn.download {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        /* Notes Section */
        .notes-section {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .notes-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .notes-header h3 {
            font-size: 1.3rem;
            color: var(--primary-dark);
        }
        
        .notes-list {
            margin-bottom: 25px;
        }
        
        .note-item {
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin-bottom: 15px;
            border-left: 4px solid var(--primary-light);
        }
        
        .note-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .note-author {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .note-date {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .note-content {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .note-form textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            background-color: #f9f9f9;
            min-height: 100px;
            resize: vertical;
            margin-bottom: 15px;
        }
        
        /* Footer */
        .dashboard-footer {
            padding: 20px 30px;
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            background-color: var(--white);
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 99;
                display: none;
            }
            
            .overlay.active {
                display: block;
            }
            
            .tabs-header {
                flex-wrap: wrap;
            }
            
            .tab-btn {
                padding: 15px 20px;
            }
        }
        
        @media (max-width: 768px) {
            .student-profile-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .student-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .attendance-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .academic-info-grid {
                grid-template-columns: 1fr;
            }
            
            .calendar-grid {
                grid-template-columns: repeat(7, 1fr);
                gap: 5px;
            }
            
            .calendar-day-header,
            .calendar-day {
                padding: 8px 5px;
                font-size: 0.85rem;
            }
        }
        
        @media (max-width: 576px) {
            .student-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .attendance-stats {
                grid-template-columns: 1fr;
            }
            
            .profile-detail {
                flex-direction: column;
                gap: 5px;
            }
            
            .detail-value {
                text-align: left;
            }
            
            .tab-btn {
                flex: 1;
                min-width: 120px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="logo-text">
                    <h2>T&T School</h2>
                    <p>Staff Portal</p>
                </div>
            </div>
            
            <div class="sidebar-menu">
                <a href="dashboard.html" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="manage-students.html" class="menu-item active">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Students</span>
                </a>
                
                <a href="manage-courses.html" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">Courses</span>
                </a>
                
                <a href="upload-results.html" class="menu-item">
                    <i class="fas fa-file-upload"></i>
                    <span class="menu-text">Upload Results</span>
                </a>
                
                <a href="attendance.html" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="reports.html" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span class="menu-text">Reports</span>
                </a>
                
                <a href="messages.html" class="menu-item">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-text">Messages</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Teacher">
                    </div>
                    <div class="user-details">
                        <h4>Mr. David Chen</h4>
                        <p>Mathematics Teacher</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay"></div>
        
        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Top Header -->
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="page-title">
                        <h1>Student Profile</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-print" title="Print Profile"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-share-alt" title="Share"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Student Profile Header -->
                <div class="student-profile-header">
                    <h2>Michael Johnson</h2>
                    <div class="student-actions">
                        <button class="btn btn-secondary">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-envelope"></i> Contact Parent
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-file-pdf"></i> Generate Report
                        </button>
                    </div>
                </div>
                
                <!-- Student Profile Container -->
                <div class="student-profile-container">
                    <!-- Student Profile Card -->
                    <div class="student-profile-card">
                        <div class="profile-header">
                            <div class="profile-status status-active">Active</div>
                            <div class="profile-avatar">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Johnson">
                            </div>
                            <h3>Michael Johnson</h3>
                            <p>Grade 10 | Section A</p>
                            <p style="font-size: 0.9rem; margin-top: 5px;">Student ID: STU-2023-045</p>
                        </div>
                        
                        <div class="profile-body">
                            <div class="profile-detail">
                                <span class="detail-label">Date of Birth</span>
                                <span class="detail-value">June 15, 2007</span>
                            </div>
                            
                            <div class="profile-detail">
                                <span class="detail-label">Age</span>
                                <span class="detail-value">16 years</span>
                            </div>
                            
                            <div class="profile-detail">
                                <span class="detail-label">Gender</span>
                                <span class="detail-value">Male</span>
                            </div>
                            
                            <div class="profile-detail">
                                <span class="detail-label">Blood Group</span>
                                <span class="detail-value">O+</span>
                            </div>
                            
                            <div class="profile-detail">
                                <span class="detail-label">Enrollment Date</span>
                                <span class="detail-value">Sept 15, 2023</span>
                            </div>
                            
                            <div class="profile-detail">
                                <span class="detail-label">Class Teacher</span>
                                <span class="detail-value">Ms. Emily Johnson</span>
                            </div>
                            
                            <div class="profile-detail">
                                <span class="detail-label">Address</span>
                                <span class="detail-value">123 Oak Street, Knowledge City</span>
                            </div>
                        </div>
                        
                        <div class="profile-footer">
                            <div class="emergency-contact">
                                <h4>Emergency Contact</h4>
                                
                                <div class="contact-item">
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <div style="font-weight: 600;">Robert Johnson</div>
                                        <div style="font-size: 0.85rem; color: var(--text-light);">Father</div>
                                    </div>
                                </div>
                                
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <div>+1 (555) 123-4567</div>
                                </div>
                                
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>r.johnson@email.com</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Student Details Tabs -->
                    <div class="student-details-tabs">
                        <div class="tabs-header">
                            <button class="tab-btn active" data-tab="academic">
                                <i class="fas fa-graduation-cap"></i> Academic
                            </button>
                            <button class="tab-btn" data-tab="attendance">
                                <i class="fas fa-calendar-alt"></i> Attendance
                            </button>
                            <button class="tab-btn" data-tab="behavior">
                                <i class="fas fa-chart-line"></i> Behavior
                            </button>
                            <button class="tab-btn" data-tab="medical">
                                <i class="fas fa-heartbeat"></i> Medical
                            </button>
                            <button class="tab-btn" data-tab="documents">
                                <i class="fas fa-folder"></i> Documents
                            </button>
                        </div>
                        
                        <!-- Academic Tab -->
                        <div class="tab-content active" id="academicTab">
                            <h3 style="margin-bottom: 25px;">Academic Information</h3>
                            
                            <div class="academic-info-grid">
                                <div class="academic-card">
                                    <h4>Current GPA</h4>
                                    <p style="font-size: 1.5rem; font-weight: 600; color: var(--primary-medium);">3.75 / 4.0</p>
                                    <p style="font-size: 0.9rem; color: var(--text-light);">Rank: 5 out of 35 students</p>
                                </div>
                                
                                <div class="academic-card">
                                    <h4>Overall Attendance</h4>
                                    <p style="font-size: 1.5rem; font-weight: 600; color: var(--success);">94.5%</p>
                                    <p style="font-size: 0.9rem; color: var(--text-light);">Present: 142/150 days</p>
                                </div>
                                
                                <div class="academic-card">
                                    <h4>Current Grade</h4>
                                    <p style="font-size: 1.5rem; font-weight: 600; color: var(--accent-blue);">Grade 10</p>
                                    <p style="font-size: 0.9rem; color: var(--text-light);">Section A, Room 205</p>
                                </div>
                                
                                <div class="academic-card">
                                    <h4>Class Teacher</h4>
                                    <p style="font-size: 1.1rem; font-weight: 600; color: var(--primary-dark);">Ms. Emily Johnson</p>
                                    <p style="font-size: 0.9rem; color: var(--text-light);">emily.johnson@ttschool.edu</p>
                                </div>
                            </div>
                            
                            <h4 style="margin: 30px 0 20px;">Current Term Grades</h4>
                            <div class="grades-table-container">
                                <table class="grades-table">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Test 1</th>
                                            <th>Test 2</th>
                                            <th>Assignment</th>
                                            <th>Final Exam</th>
                                            <th>Total</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Mathematics</td>
                                            <td>Mr. David Chen</td>
                                            <td>92</td>
                                            <td>88</td>
                                            <td>95</td>
                                            <td>90</td>
                                            <td>91.2</td>
                                            <td><span class="grade-badge grade-a">A</span></td>
                                        </tr>
                                        <tr>
                                            <td>Physics</td>
                                            <td>Ms. Emily Johnson</td>
                                            <td>85</td>
                                            <td>82</td>
                                            <td>90</td>
                                            <td>87</td>
                                            <td>86.0</td>
                                            <td><span class="grade-badge grade-b">B</span></td>
                                        </tr>
                                        <tr>
                                            <td>Chemistry</td>
                                            <td>Dr. Robert Smith</td>
                                            <td>78</td>
                                            <td>82</td>
                                            <td>85</td>
                                            <td>80</td>
                                            <td>81.3</td>
                                            <td><span class="grade-badge grade-b">B</span></td>
                                        </tr>
                                        <tr>
                                            <td>English</td>
                                            <td>Ms. Patricia Miller</td>
                                            <td>88</td>
                                            <td>90</td>
                                            <td>92</td>
                                            <td>85</td>
                                            <td>88.8</td>
                                            <td><span class="grade-badge grade-b">B</span></td>
                                        </tr>
                                        <tr>
                                            <td>History</td>
                                            <td>Mr. James Wilson</td>
                                            <td>92</td>
                                            <td>95</td>
                                            <td>90</td>
                                            <td>93</td>
                                            <td>92.5</td>
                                            <td><span class="grade-badge grade-a">A</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Attendance Tab -->
                        <div class="tab-content" id="attendanceTab">
                            <h3 style="margin-bottom: 25px;">Attendance Record</h3>
                            
                            <div class="attendance-stats">
                                <div class="attendance-stat">
                                    <h3 style="color: var(--success);">94.5%</h3>
                                    <p>Overall Attendance</p>
                                </div>
                                
                                <div class="attendance-stat">
                                    <h3 style="color: var(--success);">142</h3>
                                    <p>Days Present</p>
                                </div>
                                
                                <div class="attendance-stat">
                                    <h3 style="color: var(--danger);">8</h3>
                                    <p>Days Absent</p>
                                </div>
                                
                                <div class="attendance-stat">
                                    <h3 style="color: var(--warning);">5</h3>
                                    <p>Days Late</p>
                                </div>
                            </div>
                            
                            <div class="attendance-calendar">
                                <div class="calendar-header">
                                    <div class="calendar-month">October 2023</div>
                                    <div style="display: flex; gap: 10px;">
                                        <button class="btn btn-secondary" style="padding: 8px 15px;">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="btn btn-secondary" style="padding: 8px 15px;">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="calendar-grid">
                                    <div class="calendar-day-header">Sun</div>
                                    <div class="calendar-day-header">Mon</div>
                                    <div class="calendar-day-header">Tue</div>
                                    <div class="calendar-day-header">Wed</div>
                                    <div class="calendar-day-header">Thu</div>
                                    <div class="calendar-day-header">Fri</div>
                                    <div class="calendar-day-header">Sat</div>
                                    
                                    <!-- Empty days -->
                                    <div class="calendar-day"></div>
                                    <div class="calendar-day"></div>
                                    
                                    <!-- October 1-31 -->
                                    <div class="calendar-day present">1</div>
                                    <div class="calendar-day present">2</div>
                                    <div class="calendar-day present">3</div>
                                    <div class="calendar-day present">4</div>
                                    <div class="calendar-day present">5</div>
                                    <div class="calendar-day absent">6</div>
                                    <div class="calendar-day">7</div>
                                    <div class="calendar-day">8</div>
                                    <div class="calendar-day present">9</div>
                                    <div class="calendar-day present">10</div>
                                    <div class="calendar-day present">11</div>
                                    <div class="calendar-day present">12</div>
                                    <div class="calendar-day present">13</div>
                                    <div class="calendar-day present">14</div>
                                    <div class="calendar-day">15</div>
                                    <div class="calendar-day present">16</div>
                                    <div class="calendar-day today">17</div>
                                    <div class="calendar-day">18</div>
                                    <div class="calendar-day">19</div>
                                    <div class="calendar-day">20</div>
                                    <div class="calendar-day">21</div>
                                    <div class="calendar-day">22</div>
                                    <div class="calendar-day">23</div>
                                    <div class="calendar-day">24</div>
                                    <div class="calendar-day">25</div>
                                    <div class="calendar-day">26</div>
                                    <div class="calendar-day">27</div>
                                    <div class="calendar-day">28</div>
                                    <div class="calendar-day">29</div>
                                    <div class="calendar-day">30</div>
                                    <div class="calendar-day">31</div>
                                </div>
                                
                                <div style="margin-top: 20px; display: flex; gap: 20px; font-size: 0.9rem;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 12px; height: 12px; border-radius: 50%; background-color: var(--success);"></div>
                                        <span>Present</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 12px; height: 12px; border-radius: 50%; background-color: var(--danger);"></div>
                                        <span>Absent</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="background-color: var(--primary-light); color: white; padding: 2px 6px; border-radius: 3px; font-size: 0.8rem;">17</div>
                                        <span>Today</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Behavior Tab -->
                        <div class="tab-content" id="behaviorTab">
                            <h3 style="margin-bottom: 25px;">Behavior & Conduct</h3>
                            
                            <div class="behavior-timeline">
                                <div class="behavior-item positive">
                                    <div class="behavior-content">
                                        <div class="behavior-header">
                                            <div class="behavior-title">Excellent Class Participation</div>
                                            <div class="behavior-date">Oct 15, 2023</div>
                                        </div>
                                        <div class="behavior-description">
                                            Michael actively participated in class discussions and demonstrated excellent understanding of the topic. He helped other students who were struggling with the concepts.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="behavior-item neutral">
                                    <div class="behavior-content">
                                        <div class="behavior-header">
                                            <div class="behavior-title">Late Submission</div>
                                            <div class="behavior-date">Oct 10, 2023</div>
                                        </div>
                                        <div class="behavior-description">
                                            Submitted Physics assignment 2 days late due to illness. Provided medical certificate.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="behavior-item positive">
                                    <div class="behavior-content">
                                        <div class="behavior-header">
                                            <div class="behavior-title">Science Fair Winner</div>
                                            <div class="behavior-date">Sept 28, 2023</div>
                                        </div>
                                        <div class="behavior-description">
                                            Won first prize in school science fair for project "Renewable Energy Solutions". Demonstrated exceptional creativity and scientific understanding.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="behavior-item negative">
                                    <div class="behavior-content">
                                        <div class="behavior-header">
                                            <div class="behavior-title">Disruptive Behavior</div>
                                            <div class="behavior-date">Sept 15, 2023</div>
                                        </div>
                                        <div class="behavior-description">
                                            Was disruptive during English class. Spoke to student and parent. Behavior improved significantly after discussion.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Medical Tab -->
                        <div class="tab-content" id="medicalTab">
                            <h3 style="margin-bottom: 25px;">Medical Information</h3>
                            
                            <div class="medical-info">
                                <div class="medical-card">
                                    <h4><i class="fas fa-file-medical"></i> Medical History</h4>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Allergies</div>
                                        <div class="medical-value">Peanuts, Penicillin</div>
                                    </div>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Chronic Conditions</div>
                                        <div class="medical-value">Mild asthma (controlled with inhaler)</div>
                                    </div>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Medications</div>
                                        <div class="medical-value">Albuterol inhaler (as needed)</div>
                                    </div>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Last Physical Exam</div>
                                        <div class="medical-value">August 15, 2023</div>
                                    </div>
                                </div>
                                
                                <div class="medical-card">
                                    <h4><i class="fas fa-user-md"></i> Health Provider</h4>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Primary Physician</div>
                                        <div class="medical-value">Dr. Amanda Roberts</div>
                                    </div>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Clinic</div>
                                        <div class="medical-value">City Health Center</div>
                                    </div>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Phone</div>
                                        <div class="medical-value">+1 (555) 987-6543</div>
                                    </div>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Insurance</div>
                                        <div class="medical-value">Family Health Plan #FH-789012</div>
                                    </div>
                                </div>
                                
                                <div class="medical-card">
                                    <h4><i class="fas fa-heartbeat"></i> Vaccination Record</h4>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Last Tetanus Shot</div>
                                        <div class="medical-value">March 2022</div>
                                    </div>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">COVID-19 Vaccination</div>
                                        <div class="medical-value">Fully vaccinated (Boosted: Jan 2023)</div>
                                    </div>
                                    
                                    <div class="medical-item">
                                        <div class="medical-label">Flu Shot</div>
                                        <div class="medical-value">October 2023</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Documents Tab -->
                        <div class="tab-content" id="documentsTab">
                            <h3 style="margin-bottom: 25px;">Student Documents</h3>
                            
                            <div class="documents-grid">
                                <div class="document-card">
                                    <div class="document-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="document-info">
                                        <h5>Admission Form</h5>
                                        <p>PDF • 245 KB</p>
                                        <div class="document-actions">
                                            <button class="doc-action-btn view">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="doc-action-btn download">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="document-card">
                                    <div class="document-icon">
                                        <i class="fas fa-file-image"></i>
                                    </div>
                                    <div class="document-info">
                                        <h5>Birth Certificate</h5>
                                        <p>Image • 1.2 MB</p>
                                        <div class="document-actions">
                                            <button class="doc-action-btn view">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="doc-action-btn download">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="document-card">
                                    <div class="document-icon">
                                        <i class="fas fa-file-medical"></i>
                                    </div>
                                    <div class="document-info">
                                        <h5>Medical Records</h5>
                                        <p>PDF • 856 KB</p>
                                        <div class="document-actions">
                                            <button class="doc-action-btn view">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="doc-action-btn download">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="document-card">
                                    <div class="document-icon">
                                        <i class="fas fa-file-contract"></i>
                                    </div>
                                    <div class="document-info">
                                        <h5>Parent Consent Forms</h5>
                                        <p>PDF • 320 KB</p>
                                        <div class="document-actions">
                                            <button class="doc-action-btn view">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="doc-action-btn download">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="document-card">
                                    <div class="document-icon">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <div class="document-info">
                                        <h5>Achievement Certificates</h5>
                                        <p>PDF • 1.5 MB</p>
                                        <div class="document-actions">
                                            <button class="doc-action-btn view">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="doc-action-btn download">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="document-card">
                                    <div class="document-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="document-info">
                                        <h5>Previous School Records</h5>
                                        <p>PDF • 2.1 MB</p>
                                        <div class="document-actions">
                                            <button class="doc-action-btn view">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="doc-action-btn download">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Notes Section -->
                <div class="notes-section">
                    <div class="notes-header">
                        <h3>Staff Notes</h3>
                        <button class="btn btn-secondary" id="addNoteBtn">
                            <i class="fas fa-plus"></i> Add Note
                        </button>
                    </div>
                    
                    <div class="notes-list" id="notesList">
                        <div class="note-item">
                            <div class="note-header">
                                <div class="note-author">Ms. Emily Johnson (Class Teacher)</div>
                                <div class="note-date">October 12, 2023</div>
                            </div>
                            <div class="note-content">
                                Michael has shown significant improvement in his Physics coursework. He's been actively participating in class and his recent test scores reflect his dedication. Keep up the good work!
                            </div>
                        </div>
                        
                        <div class="note-item">
                            <div class="note-header">
                                <div class="note-author">Mr. David Chen (Math Teacher)</div>
                                <div class="note-date">October 5, 2023</div>
                            </div>
                            <div class="note-content">
                                Excelled in the recent mathematics competition. Demonstrated advanced problem-solving skills. Recommended for advanced math class next semester.
                            </div>
                        </div>
                        
                        <div class="note-item">
                            <div class="note-header">
                                <div class="note-author">School Counselor</div>
                                <div class="note-date">September 20, 2023</div>
                            </div>
                            <div class="note-content">
                                Had a positive counseling session regarding future career options. Michael shows interest in engineering fields. Will schedule follow-up meeting with parents to discuss university preparation.
                            </div>
                        </div>
                    </div>
                    
                    <div class="note-form" id="noteForm" style="display: none;">
                        <textarea id="newNote" placeholder="Enter your note here..."></textarea>
                        <div style="display: flex; justify-content: flex-end; gap: 15px;">
                            <button class="btn btn-secondary" id="cancelNoteBtn">Cancel</button>
                            <button class="btn btn-primary" id="saveNoteBtn">Save Note</button>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Student Profile View v1.5</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        const addNoteBtn = document.getElementById('addNoteBtn');
        const noteForm = document.getElementById('noteForm');
        const cancelNoteBtn = document.getElementById('cancelNoteBtn');
        const saveNoteBtn = document.getElementById('saveNoteBtn');
        const newNote = document.getElementById('newNote');
        const notesList = document.getElementById('notesList');
        
        // Document action buttons
        const docViewBtns = document.querySelectorAll('.doc-action-btn.view');
        const docDownloadBtns = document.querySelectorAll('.doc-action-btn.download');
        
        // Calendar navigation
        const calendarPrevBtn = document.querySelector('.btn-secondary .fa-chevron-left')?.parentElement;
        const calendarNextBtn = document.querySelector('.btn-secondary .fa-chevron-right')?.parentElement;
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            setupDocumentActions();
            setupCalendarNavigation();
        });
        
        // Setup event listeners
        function setupEventListeners() {
            // Mobile sidebar toggle
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
            
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
            
            // Tab switching
            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const tabId = btn.dataset.tab;
                    switchTab(tabId);
                });
            });
            
            // Notes functionality
            addNoteBtn.addEventListener('click', () => {
                noteForm.style.display = 'block';
                addNoteBtn.style.display = 'none';
                newNote.focus();
            });
            
            cancelNoteBtn.addEventListener('click', () => {
                noteForm.style.display = 'none';
                addNoteBtn.style.display = 'flex';
                newNote.value = '';
            });
            
            saveNoteBtn.addEventListener('click', saveNote);
            
            // Close sidebar when clicking on a menu item (for mobile)
            document.querySelectorAll('.sidebar-menu .menu-item').forEach(item => {
                item.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    }
                });
            });
        }
        
        // Setup document action buttons
        function setupDocumentActions() {
            // View document buttons
            docViewBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const documentCard = this.closest('.document-card');
                    const documentName = documentCard.querySelector('h5').textContent;
                    alert(`Viewing document: ${documentName}`);
                });
            });
            
            // Download document buttons
            docDownloadBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const documentCard = this.closest('.document-card');
                    const documentName = documentCard.querySelector('h5').textContent;
                    alert(`Downloading document: ${documentName}`);
                });
            });
        }
        
        // Setup calendar navigation
        function setupCalendarNavigation() {
            if (calendarPrevBtn) {
                calendarPrevBtn.addEventListener('click', () => {
                    alert('Navigating to previous month');
                });
            }
            
            if (calendarNextBtn) {
                calendarNextBtn.addEventListener('click', () => {
                    alert('Navigating to next month');
                });
            }
        }
        
        // Switch between tabs
        function switchTab(tabId) {
            // Remove active class from all tabs
            tabBtns.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked tab
            document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
            document.getElementById(`${tabId}Tab`).classList.add('active');
        }
        
        // Save new note
        function saveNote() {
            const noteText = newNote.value.trim();
            
            if (!noteText) {
                alert('Please enter a note before saving.');
                return;
            }
            
            // Create new note element
            const noteItem = document.createElement('div');
            noteItem.className = 'note-item';
            
            const today = new Date();
            const formattedDate = today.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            noteItem.innerHTML = `
                <div class="note-header">
                    <div class="note-author">Mr. David Chen (Current User)</div>
                    <div class="note-date">${formattedDate}</div>
                </div>
                <div class="note-content">${noteText}</div>
            `;
            
            // Add to top of notes list
            notesList.prepend(noteItem);
            
            // Reset form
            newNote.value = '';
            noteForm.style.display = 'none';
            addNoteBtn.style.display = 'flex';
            
            // Show success message
            alert('Note saved successfully!');
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
        
        // Print functionality
        document.querySelector('.fa-print').closest('.header-action').addEventListener('click', function() {
            if (confirm('Print student profile?')) {
                // In a real app, this would open a print dialog
                alert('Opening print dialog...');
            }
        });
        
        // Share functionality
        document.querySelector('.fa-share-alt').closest('.header-action').addEventListener('click', function() {
            alert('Share options would appear here.');
        });
        
        // Edit profile button
        document.querySelector('.btn-secondary .fa-edit').closest('.btn').addEventListener('click', function() {
            alert('Opening edit profile form...');
        });
        
        // Contact parent button
        document.querySelector('.btn-primary .fa-envelope').closest('.btn').addEventListener('click', function() {
            alert('Opening parent contact form...');
        });
        
        // Generate report button
        document.querySelector('.btn-success .fa-file-pdf').closest('.btn').addEventListener('click', function() {
            alert('Generating student report PDF...');
        });
    </script>
</body>
</html>
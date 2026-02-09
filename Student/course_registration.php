<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration - T&T School Management System</title>
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
        
        /* Registration Header */
        .registration-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .registration-header h2 {
            font-size: 1.8rem;
        }
        
        .registration-info {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            background-color: var(--light-bg);
            padding: 10px 20px;
            border-radius: 8px;
        }
        
        .info-item i {
            color: var(--primary-medium);
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .info-item span {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        /* Registration Steps */
        .registration-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }
        
        .registration-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #e0e0e0;
            z-index: 1;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            width: 20%;
        }
        
        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e0e0;
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 10px;
            border: 3px solid var(--white);
            transition: all 0.3s;
        }
        
        .step.active .step-circle {
            background-color: var(--primary-medium);
            color: var(--white);
        }
        
        .step.completed .step-circle {
            background-color: var(--success);
            color: var(--white);
        }
        
        .step.completed .step-circle i {
            font-size: 1.2rem;
        }
        
        .step-text {
            font-size: 0.9rem;
            color: var(--text-light);
            text-align: center;
        }
        
        .step.active .step-text {
            color: var(--primary-dark);
            font-weight: 600;
        }
        
        /* Registration Container */
        .registration-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 1200px) {
            .registration-container {
                grid-template-columns: 1fr;
            }
        }
        
        /* Course Catalog */
        .course-catalog {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .catalog-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .catalog-header h3 {
            font-size: 1.5rem;
        }
        
        .catalog-filters {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .filter-group {
            flex: 1;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.9rem;
        }
        
        .filter-group select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            background-color: #f9f9f9;
        }
        
        .filter-group select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.1);
        }
        
        /* Courses List */
        .courses-list {
            max-height: 600px;
            overflow-y: auto;
            padding-right: 10px;
        }
        
        .courses-list::-webkit-scrollbar {
            width: 6px;
        }
        
        .courses-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .courses-list::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
        }
        
        .course-item {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            border-left: 5px solid var(--primary-medium);
            transition: all 0.3s;
        }
        
        .course-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.1);
        }
        
        .course-item.registered {
            border-left-color: var(--success);
            background-color: rgba(40, 167, 69, 0.05);
        }
        
        .course-item.conflict {
            border-left-color: var(--danger);
            background-color: rgba(220, 53, 69, 0.05);
        }
        
        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .course-code {
            background-color: var(--white);
            color: var(--primary-medium);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .course-credits {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .course-title {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }
        
        .course-description {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .course-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .detail-item {
            display: flex;
            align-items: center;
        }
        
        .detail-item i {
            width: 25px;
            color: var(--primary-medium);
            font-size: 1rem;
        }
        
        .detail-item span {
            font-size: 0.9rem;
            color: var(--text-dark);
        }
        
        .course-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 80, 158, 0.1);
        }
        
        .course-status {
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .course-status.available {
            color: var(--success);
        }
        
        .course-status.full {
            color: var(--danger);
        }
        
        .course-status.waitlist {
            color: var(--warning);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
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
        
        .btn-success {
            background-color: var(--success);
            color: var(--white);
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
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
        
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }
        
        /* Registration Cart */
        .registration-cart {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            position: sticky;
            top: 100px;
            max-height: 700px;
            overflow-y: auto;
        }
        
        .cart-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .cart-header i {
            font-size: 1.5rem;
            color: var(--primary-medium);
            margin-right: 15px;
        }
        
        .cart-header h3 {
            font-size: 1.5rem;
        }
        
        .cart-summary {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .summary-item.total {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--primary-dark);
            border-top: 2px solid rgba(0, 80, 158, 0.2);
            padding-top: 15px;
            margin-top: 15px;
        }
        
        .cart-items {
            margin-bottom: 30px;
        }
        
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .cart-item-info h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .cart-item-info p {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .remove-item {
            background: none;
            border: none;
            color: var(--danger);
            cursor: pointer;
            font-size: 1.2rem;
            transition: transform 0.3s;
        }
        
        .remove-item:hover {
            transform: scale(1.2);
        }
        
        .cart-empty {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }
        
        .cart-empty i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary-light);
        }
        
        /* Schedule Preview */
        .schedule-preview {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .schedule-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .schedule-header i {
            font-size: 1.5rem;
            color: var(--primary-medium);
            margin-right: 15px;
        }
        
        .schedule-header h3 {
            font-size: 1.5rem;
        }
        
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
        
        .schedule-day {
            text-align: center;
            font-weight: 600;
            color: var(--primary-dark);
            padding: 10px;
            background-color: var(--light-bg);
            border-radius: 8px;
        }
        
        .schedule-slot {
            height: 80px;
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 10px;
            font-size: 0.8rem;
            overflow: hidden;
        }
        
        .schedule-slot.booked {
            background-color: rgba(30, 136, 229, 0.1);
            border-left: 4px solid var(--accent-blue);
        }
        
        .schedule-slot.conflict {
            background-color: rgba(220, 53, 69, 0.1);
            border-left: 4px solid var(--danger);
        }
        
        .course-time {
            font-weight: 600;
            font-size: 0.75rem;
            color: var(--primary-dark);
        }
        
        .course-name {
            font-size: 0.7rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        /* Registration Actions */
        .registration-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
        }
        
        .btn-large {
            padding: 15px 30px;
            font-size: 1rem;
        }
        
        /* Footer */
        .dashboard-footer {
            padding: 20px 30px;
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            background-color: var(--white);
            margin-top: 40px;
        }
        
        /* Registration Guidelines */
        .registration-guidelines {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 30px;
        }
        
        .guidelines-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .guidelines-header i {
            font-size: 1.5rem;
            color: var(--warning);
            margin-right: 15px;
        }
        
        .guidelines-header h3 {
            font-size: 1.5rem;
        }
        
        .guidelines-list {
            list-style: none;
        }
        
        .guidelines-list li {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: flex-start;
        }
        
        .guidelines-list li:last-child {
            border-bottom: none;
        }
        
        .guideline-icon {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            color: var(--primary-medium);
            font-size: 0.8rem;
        }
        
        .guideline-text h5 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .guideline-text p {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background-color: var(--white);
            border-radius: 15px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            padding: 25px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h3 {
            font-size: 1.5rem;
            color: var(--primary-dark);
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-light);
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .close-modal:hover {
            color: var(--danger);
        }
        
        .modal-body {
            padding: 30px;
        }
        
        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }
        
        /* Responsive Styles */
        @media (max-width: 1200px) {
            .registration-container {
                grid-template-columns: 1fr;
            }
            
            .registration-cart {
                position: static;
                max-height: none;
            }
            
            .schedule-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
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
            
            .registration-steps {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }
            
            .step {
                width: 30%;
            }
            
            .registration-steps::before {
                display: none;
            }
            
            .catalog-filters {
                flex-direction: column;
            }
        }
        
        @media (max-width: 768px) {
            .registration-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .registration-info {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .step {
                width: 45%;
            }
            
            .course-details {
                grid-template-columns: 1fr;
            }
            
            .registration-actions {
                flex-direction: column;
                gap: 20px;
                align-items: stretch;
            }
            
            .action-buttons {
                justify-content: space-between;
            }
            
            .schedule-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .step {
                width: 100%;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .course-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .schedule-grid {
                grid-template-columns: 1fr;
            }
            
            .info-item {
                padding: 8px 12px;
                font-size: 0.9rem;
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
                    <p>Student Portal</p>
                </div>
            </div>
            
            <div class="sidebar-menu">
                <a href="student-dashboard.html" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="student-courses.html" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">My Courses</span>
                </a>
                
                <a href="student-registration.html" class="menu-item active">
                    <i class="fas fa-clipboard-list"></i>
                    <span class="menu-text">Course Registration</span>
                </a>
                
                <a href="student-grades.html" class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span class="menu-text">Grades</span>
                </a>
                
                <a href="student-schedule.html" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">Schedule</span>
                </a>
                
                <a href="student-messages.html" class="menu-item">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-text">Messages</span>
                </a>
                
                <a href="student-profile.html" class="menu-item">
                    <i class="fas fa-user"></i>
                    <span class="menu-text">Profile</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Student">
                    </div>
                    <div class="user-details">
                        <h4>Michael Johnson</h4>
                        <p>Grade 10 Student</p>
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
                        <h1>Course Registration</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-bell"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Registration Header -->
                <div class="registration-header">
                    <h2>Fall 2023 Registration</h2>
                    <div class="registration-info">
                        <div class="info-item">
                            <i class="fas fa-calendar"></i>
                            <span>Registration Open: Sep 1 - Sep 15</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <span>Deadline: 5 days remaining</span>
                        </div>
                    </div>
                </div>
                
                <!-- Registration Steps -->
                <div class="registration-steps">
                    <div class="step active" id="step1">
                        <div class="step-circle">1</div>
                        <div class="step-text">Browse Courses</div>
                    </div>
                    
                    <div class="step" id="step2">
                        <div class="step-circle">2</div>
                        <div class="step-text">Add to Cart</div>
                    </div>
                    
                    <div class="step" id="step3">
                        <div class="step-circle">3</div>
                        <div class="step-text">Check Schedule</div>
                    </div>
                    
                    <div class="step" id="step4">
                        <div class="step-circle">4</div>
                        <div class="step-text">Review & Submit</div>
                    </div>
                    
                    <div class="step" id="step5">
                        <div class="step-circle">5</div>
                        <div class="step-text">Confirmation</div>
                    </div>
                </div>
                
                <!-- Registration Guidelines -->
                <div class="registration-guidelines">
                    <div class="guidelines-header">
                        <i class="fas fa-exclamation-circle"></i>
                        <h3>Registration Guidelines</h3>
                    </div>
                    
                    <ul class="guidelines-list">
                        <li>
                            <div class="guideline-icon">1</div>
                            <div class="guideline-text">
                                <h5>Credit Requirements</h5>
                                <p>Minimum 4 courses, maximum 6 courses per semester. At least 15 credits required.</p>
                            </div>
                        </li>
                        <li>
                            <div class="guideline-icon">2</div>
                            <div class="guideline-text">
                                <h5>Prerequisites</h5>
                                <p>Ensure you have completed all prerequisite courses before registration.</p>
                            </div>
                        </li>
                        <li>
                            <div class="guideline-icon">3</div>
                            <div class="guideline-text">
                                <h5>Time Conflicts</h5>
                                <p>Check your schedule carefully to avoid time conflicts between courses.</p>
                            </div>
                        </li>
                        <li>
                            <div class="guideline-icon">4</div>
                            <div class="guideline-text">
                                <h5>Advisor Approval</h5>
                                <p>Some courses may require advisor approval before registration.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Registration Container -->
                <div class="registration-container">
                    <!-- Course Catalog -->
                    <div class="course-catalog">
                        <div class="catalog-header">
                            <h3>Available Courses</h3>
                            <div class="info-item">
                                <i class="fas fa-filter"></i>
                                <span>Filter Courses</span>
                            </div>
                        </div>
                        
                        <div class="catalog-filters">
                            <div class="filter-group">
                                <label for="subjectFilter">Subject</label>
                                <select id="subjectFilter">
                                    <option value="">All Subjects</option>
                                    <option value="math">Mathematics</option>
                                    <option value="science">Science</option>
                                    <option value="english">English</option>
                                    <option value="history">History</option>
                                    <option value="arts">Arts</option>
                                </select>
                            </div>
                            
                            <div class="filter-group">
                                <label for="levelFilter">Level</label>
                                <select id="levelFilter">
                                    <option value="">All Levels</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>
                            
                            <div class="filter-group">
                                <label for="timeFilter">Time of Day</label>
                                <select id="timeFilter">
                                    <option value="">Any Time</option>
                                    <option value="morning">Morning (8AM-12PM)</option>
                                    <option value="afternoon">Afternoon (12PM-4PM)</option>
                                    <option value="evening">Evening (4PM-6PM)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="courses-list" id="coursesList">
                            <!-- Course items will be dynamically generated -->
                        </div>
                    </div>
                    
                    <!-- Registration Cart -->
                    <div class="registration-cart">
                        <div class="cart-header">
                            <i class="fas fa-shopping-cart"></i>
                            <h3>Registration Cart</h3>
                        </div>
                        
                        <div class="cart-summary">
                            <div class="summary-item">
                                <span>Selected Courses:</span>
                                <span id="selectedCoursesCount">0</span>
                            </div>
                            <div class="summary-item">
                                <span>Total Credits:</span>
                                <span id="totalCredits">0</span>
                            </div>
                            <div class="summary-item total">
                                <span>Registration Status:</span>
                                <span id="registrationStatus">Not Ready</span>
                            </div>
                        </div>
                        
                        <div class="cart-items" id="cartItems">
                            <div class="cart-empty">
                                <i class="fas fa-shopping-cart"></i>
                                <h4>Your cart is empty</h4>
                                <p>Browse courses and add them to your cart</p>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <button class="btn btn-secondary" id="clearCartBtn" disabled>
                                <i class="fas fa-trash"></i> Clear Cart
                            </button>
                            <button class="btn btn-primary" id="checkScheduleBtn" disabled>
                                <i class="fas fa-calendar-check"></i> Check Schedule
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Schedule Preview -->
                <div class="schedule-preview" id="schedulePreview" style="display: none;">
                    <div class="schedule-header">
                        <i class="fas fa-calendar-alt"></i>
                        <h3>Weekly Schedule Preview</h3>
                    </div>
                    
                    <div class="schedule-grid" id="scheduleGrid">
                        <!-- Schedule grid will be dynamically generated -->
                    </div>
                    
                    <div class="action-buttons" style="margin-top: 30px; justify-content: center;">
                        <button class="btn btn-danger" id="backToCatalogBtn">
                            <i class="fas fa-arrow-left"></i> Back to Catalog
                        </button>
                        <button class="btn btn-success" id="submitRegistrationBtn">
                            <i class="fas fa-paper-plane"></i> Submit Registration
                        </button>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Student Portal v2.3</p>
                </div>
            </div>
        </div>
        
        <!-- Registration Confirmation Modal -->
        <div class="modal" id="confirmationModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Confirm Registration</h3>
                    <button class="close-modal" id="closeModal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <div style="text-align: center; margin-bottom: 30px;">
                        <div style="font-size: 4rem; color: var(--primary-medium); margin-bottom: 20px;">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h3>Ready to submit your course registration?</h3>
                        <p>Please review your selected courses before final submission.</p>
                    </div>
                    
                    <div class="cart-summary" style="margin-bottom: 20px;">
                        <div class="summary-item">
                            <span>Selected Courses:</span>
                            <span id="confirmCoursesCount">0</span>
                        </div>
                        <div class="summary-item">
                            <span>Total Credits:</span>
                            <span id="confirmTotalCredits">0</span>
                        </div>
                        <div class="summary-item total">
                            <span>Registration Fee:</span>
                            <span>$0.00</span>
                        </div>
                    </div>
                    
                    <div class="info-item" style="margin-bottom: 20px; background-color: #fff8e1; border-left: 4px solid var(--warning);">
                        <i class="fas fa-exclamation-triangle" style="color: var(--warning);"></i>
                        <span>Once submitted, your registration cannot be changed without advisor approval.</span>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="cancelRegistrationBtn">Cancel</button>
                    <button class="btn btn-success" id="confirmRegistrationBtn">
                        <i class="fas fa-check-circle"></i> Confirm Registration
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Registration Success Modal -->
        <div class="modal" id="successModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Registration Successful!</h3>
                    <button class="close-modal" id="closeSuccessModal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <div style="text-align: center; padding: 20px;">
                        <div style="font-size: 5rem; color: var(--success); margin-bottom: 20px;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Registration Submitted Successfully</h3>
                        <p>Your course registration for Fall 2023 has been received.</p>
                        
                        <div class="info-item" style="margin: 30px auto; max-width: 400px; background-color: rgba(40, 167, 69, 0.1);">
                            <i class="fas fa-file-alt" style="color: var(--success);"></i>
                            <span>Registration ID: REG-2023-045-001</span>
                        </div>
                        
                        <p>You will receive a confirmation email with your schedule details. You can view your registered courses in the "My Courses" section.</p>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-primary" id="viewScheduleBtn">
                        <i class="fas fa-calendar-alt"></i> View Schedule
                    </button>
                    <button class="btn btn-secondary" id="closeSuccessBtn">
                        <i class="fas fa-home"></i> Return to Dashboard
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample course data
        const availableCourses = [
            {
                id: 1,
                code: "MATH-101",
                name: "Advanced Mathematics",
                description: "Comprehensive course covering advanced mathematical concepts including calculus, linear algebra, and differential equations.",
                credits: 4,
                subject: "math",
                level: "advanced",
                instructor: "Dr. Robert Smith",
                schedule: "Mon/Wed/Fri 10:00-11:30 AM",
                room: "Room 302",
                capacity: 35,
                enrolled: 32,
                waitlist: 3,
                status: "available",
                prerequisites: ["MATH-100"],
                conflicts: []
            },
            {
                id: 2,
                code: "SCI-201",
                name: "Physics Fundamentals",
                description: "Introduction to classical mechanics, thermodynamics, and electromagnetism with practical laboratory sessions.",
                credits: 3,
                subject: "science",
                level: "intermediate",
                instructor: "Ms. Emily Johnson",
                schedule: "Tue/Thu 1:00-2:30 PM",
                room: "Science Lab 2",
                capacity: 30,
                enrolled: 28,
                waitlist: 0,
                status: "available",
                prerequisites: ["SCI-101"],
                conflicts: []
            },
            {
                id: 3,
                code: "ENG-102",
                name: "Literature & Composition",
                description: "Study of literary works from various periods with emphasis on critical analysis and writing skills development.",
                credits: 3,
                subject: "english",
                level: "intermediate",
                instructor: "Mr. David Chen",
                schedule: "Mon/Wed 2:00-3:30 PM",
                room: "Room 105",
                capacity: 25,
                enrolled: 25,
                waitlist: 5,
                status: "waitlist",
                prerequisites: ["ENG-101"],
                conflicts: []
            },
            {
                id: 4,
                code: "CS-301",
                name: "Computer Science Principles",
                description: "Foundational course in computer science covering algorithms, data structures, and programming concepts.",
                credits: 3,
                subject: "science",
                level: "beginner",
                instructor: "Ms. Patricia Miller",
                schedule: "Tue/Thu 9:00-10:30 AM",
                room: "Computer Lab 1",
                capacity: 40,
                enrolled: 40,
                waitlist: 8,
                status: "full",
                prerequisites: [],
                conflicts: []
            },
            {
                id: 5,
                code: "HIS-103",
                name: "World History",
                description: "Survey of world civilizations from ancient times to the modern era with focus on cultural and political developments.",
                credits: 3,
                subject: "history",
                level: "beginner",
                instructor: "Dr. Sarah Williams",
                schedule: "Mon/Wed/Fri 11:00-12:00 PM",
                room: "Room 201",
                capacity: 30,
                enrolled: 22,
                waitlist: 0,
                status: "available",
                prerequisites: [],
                conflicts: ["MATH-101"] // Conflict with MATH-101
            },
            {
                id: 6,
                code: "ART-105",
                name: "Visual Arts Studio",
                description: "Practical course focusing on drawing, painting, and design principles for creative expression.",
                credits: 2,
                subject: "arts",
                level: "beginner",
                instructor: "Ms. Jennifer Davis",
                schedule: "Fri 3:00-5:30 PM",
                room: "Art Studio",
                capacity: 20,
                enrolled: 15,
                waitlist: 0,
                status: "available",
                prerequisites: [],
                conflicts: []
            },
            {
                id: 7,
                code: "BIO-202",
                name: "Advanced Biology",
                description: "In-depth study of cellular biology, genetics, and molecular biology with laboratory experiments.",
                credits: 4,
                subject: "science",
                level: "advanced",
                instructor: "Dr. Robert Smith",
                schedule: "Tue/Thu 10:00-11:30 AM",
                room: "Biology Lab",
                capacity: 30,
                enrolled: 26,
                waitlist: 0,
                status: "available",
                prerequisites: ["BIO-101"],
                conflicts: []
            },
            {
                id: 8,
                code: "MUS-106",
                name: "Music Theory & Appreciation",
                description: "Introduction to music theory, composition, and appreciation of various musical genres and traditions.",
                credits: 2,
                subject: "arts",
                level: "beginner",
                instructor: "Mr. James Wilson",
                schedule: "Wed 1:00-3:00 PM",
                room: "Music Room",
                capacity: 25,
                enrolled: 18,
                waitlist: 0,
                status: "available",
                prerequisites: [],
                conflicts: []
            }
        ];
        
        // Student's current schedule (empty initially)
        const studentSchedule = {
            monday: [],
            tuesday: [],
            wednesday: [],
            thursday: [],
            friday: []
        };
        
        // Cart state
        let cart = [];
        let currentStep = 1;
        let scheduleChecked = false;
        
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const coursesList = document.getElementById('coursesList');
        const cartItems = document.getElementById('cartItems');
        const selectedCoursesCount = document.getElementById('selectedCoursesCount');
        const totalCredits = document.getElementById('totalCredits');
        const registrationStatus = document.getElementById('registrationStatus');
        const clearCartBtn = document.getElementById('clearCartBtn');
        const checkScheduleBtn = document.getElementById('checkScheduleBtn');
        const schedulePreview = document.getElementById('schedulePreview');
        const scheduleGrid = document.getElementById('scheduleGrid');
        const backToCatalogBtn = document.getElementById('backToCatalogBtn');
        const submitRegistrationBtn = document.getElementById('submitRegistrationBtn');
        const confirmationModal = document.getElementById('confirmationModal');
        const closeModal = document.getElementById('closeModal');
        const cancelRegistrationBtn = document.getElementById('cancelRegistrationBtn');
        const confirmRegistrationBtn = document.getElementById('confirmRegistrationBtn');
        const successModal = document.getElementById('successModal');
        const closeSuccessModal = document.getElementById('closeSuccessModal');
        const viewScheduleBtn = document.getElementById('viewScheduleBtn');
        const closeSuccessBtn = document.getElementById('closeSuccessBtn');
        
        // Filter elements
        const subjectFilter = document.getElementById('subjectFilter');
        const levelFilter = document.getElementById('levelFilter');
        const timeFilter = document.getElementById('timeFilter');
        
        // Step elements
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step3 = document.getElementById('step3');
        const step4 = document.getElementById('step4');
        const step5 = document.getElementById('step5');
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderCourses();
            setupEventListeners();
            updateCartUI();
            updateSteps();
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
            
            // Filter events
            subjectFilter.addEventListener('change', filterCourses);
            levelFilter.addEventListener('change', filterCourses);
            timeFilter.addEventListener('change', filterCourses);
            
            // Cart buttons
            clearCartBtn.addEventListener('click', clearCart);
            checkScheduleBtn.addEventListener('click', checkSchedule);
            
            // Schedule buttons
            backToCatalogBtn.addEventListener('click', () => {
                schedulePreview.style.display = 'none';
                goToStep(2);
            });
            
            submitRegistrationBtn.addEventListener('click', showConfirmationModal);
            
            // Modal buttons
            closeModal.addEventListener('click', closeConfirmationModal);
            cancelRegistrationBtn.addEventListener('click', closeConfirmationModal);
            confirmRegistrationBtn.addEventListener('click', submitRegistration);
            
            closeSuccessModal.addEventListener('click', closeSuccessModalFunc);
            viewScheduleBtn.addEventListener('click', () => {
                window.location.href = 'student-schedule.html';
            });
            
            closeSuccessBtn.addEventListener('click', () => {
                window.location.href = 'student-dashboard.html';
            });
            
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
        
        // Render courses to the list
        function renderCourses(filteredCourses = availableCourses) {
            coursesList.innerHTML = '';
            
            filteredCourses.forEach(course => {
                const courseItem = createCourseItem(course);
                coursesList.appendChild(courseItem);
            });
        }
        
        // Create a course item element
        function createCourseItem(course) {
            const item = document.createElement('div');
            item.className = 'course-item';
            item.dataset.id = course.id;
            
            // Check if course is in cart
            const inCart = cart.some(item => item.id === course.id);
            if (inCart) {
                item.classList.add('registered');
            }
            
            // Check for conflicts with cart
            const hasConflict = checkCourseConflict(course, cart);
            if (hasConflict && !inCart) {
                item.classList.add('conflict');
            }
            
            // Get status text and class
            let statusText = '';
            let statusClass = '';
            switch(course.status) {
                case 'available':
                    statusText = 'Available';
                    statusClass = 'available';
                    break;
                case 'full':
                    statusText = 'Full';
                    statusClass = 'full';
                    break;
                case 'waitlist':
                    statusText = 'Waitlist';
                    statusClass = 'waitlist';
                    break;
            }
            
            // Check if button should be disabled
            let buttonDisabled = false;
            let buttonText = 'Add to Cart';
            let buttonClass = 'btn-primary';
            
            if (inCart) {
                buttonText = 'In Cart';
                buttonClass = 'btn-success';
                buttonDisabled = true;
            } else if (hasConflict) {
                buttonText = 'Time Conflict';
                buttonClass = 'btn-danger';
                buttonDisabled = true;
            } else if (course.status === 'full') {
                buttonText = 'Course Full';
                buttonClass = 'btn-danger';
                buttonDisabled = true;
            } else if (cart.length >= 6) {
                buttonText = 'Max Courses';
                buttonClass = 'btn-danger';
                buttonDisabled = true;
            }
            
            item.innerHTML = `
                <div class="course-header">
                    <div class="course-code">${course.code}</div>
                    <div class="course-credits">${course.credits} Credits</div>
                </div>
                
                <h3 class="course-title">${course.name}</h3>
                <p class="course-description">${course.description}</p>
                
                <div class="course-details">
                    <div class="detail-item">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>${course.instructor}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>${course.schedule}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-door-open"></i>
                        <span>${course.room}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-users"></i>
                        <span>${course.enrolled}/${course.capacity} enrolled</span>
                    </div>
                </div>
                
                <div class="course-footer">
                    <div class="course-status ${statusClass}">${statusText}</div>
                    <button class="btn ${buttonClass} add-to-cart-btn" ${buttonDisabled ? 'disabled' : ''} data-id="${course.id}">
                        <i class="fas fa-cart-plus"></i> ${buttonText}
                    </button>
                </div>
            `;
            
            // Add event listener to the button
            const addButton = item.querySelector('.add-to-cart-btn');
            if (!buttonDisabled && !inCart) {
                addButton.addEventListener('click', () => addToCart(course.id));
            }
            
            return item;
        }
        
        // Filter courses based on selected filters
        function filterCourses() {
            const subject = subjectFilter.value;
            const level = levelFilter.value;
            const time = timeFilter.value;
            
            const filteredCourses = availableCourses.filter(course => {
                // Subject filter
                if (subject && course.subject !== subject) return false;
                
                // Level filter
                if (level && course.level !== level) return false;
                
                // Time filter
                if (time) {
                    if (time === 'morning' && !course.schedule.includes('AM')) return false;
                    if (time === 'afternoon' && !course.schedule.includes('PM')) return false;
                    if (time === 'evening' && !course.schedule.includes('4PM')) return false;
                }
                
                return true;
            });
            
            renderCourses(filteredCourses);
        }
        
        // Add course to cart
        function addToCart(courseId) {
            const course = availableCourses.find(c => c.id === courseId);
            if (!course) return;
            
            // Check if already in cart
            if (cart.some(item => item.id === courseId)) {
                alert('This course is already in your cart.');
                return;
            }
            
            // Check for conflicts
            if (checkCourseConflict(course, cart)) {
                alert('This course conflicts with another course in your cart.');
                return;
            }
            
            // Check if cart is full
            if (cart.length >= 6) {
                alert('You can only register for a maximum of 6 courses.');
                return;
            }
            
            // Add to cart
            cart.push(course);
            updateCartUI();
            renderCourses(); // Re-render to update button states
            goToStep(2);
        }
        
        // Check if a course conflicts with courses in cart
        function checkCourseConflict(course, cartItems) {
            // Check against cart items
            for (const item of cartItems) {
                // Check if course explicitly lists conflict
                if (item.conflicts && item.conflicts.includes(course.code)) {
                    return true;
                }
                
                // Check if course conflicts with this item
                if (course.conflicts && course.conflicts.includes(item.code)) {
                    return true;
                }
                
                // Check for schedule overlap (simplified check)
                // In a real app, this would parse schedules and check for time overlaps
                if (course.schedule && item.schedule) {
                    // Simple day check - if they're on the same day, we'll flag as potential conflict
                    // This is simplified for demo purposes
                    const courseDays = course.schedule.split(' ')[0]; // e.g., "Mon/Wed/Fri"
                    const itemDays = item.schedule.split(' ')[0];
                    
                    // Check if they share any day
                    const courseDayArray = courseDays.split('/');
                    const itemDayArray = itemDays.split('/');
                    
                    for (const day of courseDayArray) {
                        if (itemDayArray.includes(day)) {
                            return true; // Potential conflict (simplified)
                        }
                    }
                }
            }
            
            return false;
        }
        
        // Update cart UI
        function updateCartUI() {
            // Update cart items list
            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="cart-empty">
                        <i class="fas fa-shopping-cart"></i>
                        <h4>Your cart is empty</h4>
                        <p>Browse courses and add them to your cart</p>
                    </div>
                `;
                clearCartBtn.disabled = true;
                checkScheduleBtn.disabled = true;
            } else {
                cartItems.innerHTML = '';
                
                cart.forEach(course => {
                    const cartItem = document.createElement('div');
                    cartItem.className = 'cart-item';
                    cartItem.innerHTML = `
                        <div class="cart-item-info">
                            <h4>${course.code} - ${course.name}</h4>
                            <p>${course.schedule} • ${course.credits} Credits</p>
                        </div>
                        <button class="remove-item" data-id="${course.id}">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    
                    // Add event listener to remove button
                    const removeButton = cartItem.querySelector('.remove-item');
                    removeButton.addEventListener('click', () => removeFromCart(course.id));
                    
                    cartItems.appendChild(cartItem);
                });
                
                clearCartBtn.disabled = false;
                checkScheduleBtn.disabled = false;
            }
            
            // Update cart summary
            const totalCreditsValue = cart.reduce((sum, course) => sum + course.credits, 0);
            selectedCoursesCount.textContent = cart.length;
            totalCredits.textContent = totalCreditsValue;
            
            // Update registration status
            if (cart.length >= 4 && cart.length <= 6 && totalCreditsValue >= 15) {
                registrationStatus.textContent = 'Ready to Register';
                registrationStatus.style.color = 'var(--success)';
            } else if (cart.length > 6) {
                registrationStatus.textContent = 'Too Many Courses';
                registrationStatus.style.color = 'var(--danger)';
            } else if (cart.length < 4) {
                registrationStatus.textContent = 'Minimum 4 Courses Required';
                registrationStatus.style.color = 'var(--warning)';
            } else if (totalCreditsValue < 15) {
                registrationStatus.textContent = 'Minimum 15 Credits Required';
                registrationStatus.style.color = 'var(--warning)';
            } else {
                registrationStatus.textContent = 'Not Ready';
                registrationStatus.style.color = 'var(--text-light)';
            }
        }
        
        // Remove course from cart
        function removeFromCart(courseId) {
            cart = cart.filter(item => item.id !== courseId);
            updateCartUI();
            renderCourses(); // Re-render to update button states
        }
        
        // Clear entire cart
        function clearCart() {
            if (confirm('Are you sure you want to clear your cart?')) {
                cart = [];
                updateCartUI();
                renderCourses(); // Re-render to update button states
                goToStep(1);
            }
        }
        
        // Check schedule for conflicts
        function checkSchedule() {
            // Generate schedule grid
            generateScheduleGrid();
            
            // Show schedule preview
            schedulePreview.style.display = 'block';
            goToStep(3);
        }
        
        // Generate schedule grid
        function generateScheduleGrid() {
            // Clear schedule grid
            scheduleGrid.innerHTML = '';
            
            // Define days and time slots
            const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            const timeSlots = [
                { time: '8:00-9:30', hour: 8 },
                { time: '9:30-11:00', hour: 9 },
                { time: '11:00-12:30', hour: 11 },
                { time: '1:00-2:30', hour: 13 },
                { time: '2:30-4:00', hour: 14 },
                { time: '4:00-5:30', hour: 16 }
            ];
            
            // Add day headers
            days.forEach(day => {
                const dayHeader = document.createElement('div');
                dayHeader.className = 'schedule-day';
                dayHeader.textContent = day.substring(0, 3);
                scheduleGrid.appendChild(dayHeader);
            });
            
            // Clear schedule for this check
            Object.keys(studentSchedule).forEach(day => {
                studentSchedule[day] = [];
            });
            
            // Parse course schedules and add to grid
            cart.forEach(course => {
                // Parse schedule (simplified parsing for demo)
                // Format: "Mon/Wed/Fri 10:00-11:30 AM"
                const [daysPart, timePart] = course.schedule.split(' ');
                const courseDays = daysPart.split('/');
                const [startTime, endTime] = timePart.split('-');
                
                // Determine which time slot this course belongs to (simplified)
                let timeSlotIndex = 0;
                if (startTime.includes('8:00')) timeSlotIndex = 0;
                else if (startTime.includes('9:30')) timeSlotIndex = 1;
                else if (startTime.includes('11:00')) timeSlotIndex = 2;
                else if (startTime.includes('1:00')) timeSlotIndex = 3;
                else if (startTime.includes('2:30')) timeSlotIndex = 4;
                else if (startTime.includes('4:00')) timeSlotIndex = 5;
                
                // Add course to each day
                courseDays.forEach(day => {
                    const dayKey = day.toLowerCase().substring(0, 3);
                    const fullDayKey = dayKey + 'sday'; // Convert "mon" to "monday"
                    
                    if (studentSchedule[fullDayKey]) {
                        // Check for conflict
                        const hasConflict = studentSchedule[fullDayKey].some(slot => slot.timeSlot === timeSlotIndex);
                        
                        studentSchedule[fullDayKey].push({
                            course: course,
                            timeSlot: timeSlotIndex,
                            conflict: hasConflict
                        });
                    }
                });
            });
            
            // Generate grid cells
            for (let timeSlot = 0; timeSlot < 6; timeSlot++) {
                for (let dayIndex = 0; dayIndex < 5; dayIndex++) {
                    const dayKey = Object.keys(studentSchedule)[dayIndex];
                    const coursesAtThisTime = studentSchedule[dayKey].filter(slot => slot.timeSlot === timeSlot);
                    
                    const cell = document.createElement('div');
                    cell.className = 'schedule-slot';
                    
                    if (coursesAtThisTime.length > 0) {
                        const course = coursesAtThisTime[0].course;
                        const hasConflict = coursesAtThisTime.some(slot => slot.conflict);
                        
                        cell.classList.add('booked');
                        if (hasConflict) {
                            cell.classList.add('conflict');
                        }
                        
                        cell.innerHTML = `
                            <div class="course-time">${timeSlots[timeSlot].time}</div>
                            <div class="course-name">${course.code}</div>
                        `;
                        
                        // Add tooltip for conflict
                        if (hasConflict) {
                            cell.title = 'Time conflict detected!';
                        }
                    } else {
                        cell.innerHTML = `
                            <div class="course-time">${timeSlots[timeSlot].time}</div>
                            <div class="course-name">Available</div>
                        `;
                    }
                    
                    scheduleGrid.appendChild(cell);
                }
            }
            
            // Check for conflicts
            const hasAnyConflict = Object.values(studentSchedule).some(day => 
                day.some(slot => slot.conflict)
            );
            
            if (hasAnyConflict) {
                submitRegistrationBtn.disabled = true;
                submitRegistrationBtn.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Resolve Conflicts';
            } else {
                submitRegistrationBtn.disabled = false;
                submitRegistrationBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Registration';
            }
        }
        
        // Navigate between steps
        function goToStep(step) {
            currentStep = step;
            updateSteps();
        }
        
        // Update step indicators
        function updateSteps() {
            // Reset all steps
            step1.className = 'step';
            step2.className = 'step';
            step3.className = 'step';
            step4.className = 'step';
            step5.className = 'step';
            
            // Mark previous steps as completed
            for (let i = 1; i < currentStep; i++) {
                document.getElementById(`step${i}`).className = 'step completed';
                document.getElementById(`step${i}`).querySelector('.step-circle').innerHTML = '<i class="fas fa-check"></i>';
            }
            
            // Mark current step as active
            if (currentStep >= 1 && currentStep <= 5) {
                document.getElementById(`step${currentStep}`).classList.add('active');
            }
        }
        
        // Show confirmation modal
        function showConfirmationModal() {
            // Check if registration is valid
            const totalCreditsValue = cart.reduce((sum, course) => sum + course.credits, 0);
            
            if (cart.length < 4) {
                alert('You must select at least 4 courses.');
                return;
            }
            
            if (cart.length > 6) {
                alert('You can select at most 6 courses.');
                return;
            }
            
            if (totalCreditsValue < 15) {
                alert('You must have at least 15 credits.');
                return;
            }
            
            // Check for conflicts
            const hasConflict = Object.values(studentSchedule).some(day => 
                day.some(slot => slot.conflict)
            );
            
            if (hasConflict) {
                alert('Please resolve all schedule conflicts before submitting.');
                return;
            }
            
            // Update confirmation modal
            document.getElementById('confirmCoursesCount').textContent = cart.length;
            document.getElementById('confirmTotalCredits').textContent = totalCreditsValue;
            
            // Show modal
            confirmationModal.classList.add('active');
            goToStep(4);
        }
        
        // Close confirmation modal
        function closeConfirmationModal() {
            confirmationModal.classList.remove('active');
        }
        
        // Submit registration
        function submitRegistration() {
            // In a real app, this would send data to server
            console.log('Submitting registration:', cart);
            
            // Simulate API call
            setTimeout(() => {
                // Close confirmation modal
                confirmationModal.classList.remove('active');
                
                // Show success modal
                successModal.classList.add('active');
                goToStep(5);
                
                // Clear cart after successful registration
                cart = [];
                updateCartUI();
                renderCourses();
            }, 1000);
        }
        
        // Close success modal
        function closeSuccessModalFunc() {
            successModal.classList.remove('active');
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>
</body>
</html>
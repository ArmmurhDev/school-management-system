<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Results - T&T School Management System</title>
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
        
        /* Results View Header */
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .results-header h2 {
            font-size: 1.8rem;
        }
        
        .results-actions {
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
        
        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }
        
        /* Filters Section */
        .filters-section {
            background-color: var(--white);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 30px;
        }
        
        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .filter-group {
            margin-bottom: 15px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.9rem;
        }
        
        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            background-color: #f9f9f9;
        }
        
        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.1);
        }
        
        .filter-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        /* Results Summary */
        .results-summary {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .summary-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        
        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.15);
        }
        
        .summary-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 1.5rem;
        }
        
        .summary-card.average .summary-icon {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .summary-card.highest .summary-icon {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .summary-card.lowest .summary-icon {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .summary-card.students .summary-icon {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .summary-info h3 {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        
        .summary-card.average .summary-info h3 {
            color: var(--accent-blue);
        }
        
        .summary-card.highest .summary-info h3 {
            color: var(--success);
        }
        
        .summary-card.lowest .summary-info h3 {
            color: var(--danger);
        }
        
        .summary-card.students .summary-info h3 {
            color: var(--warning);
        }
        
        .summary-info p {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        /* Results Container */
        .results-container {
            background-color: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .results-tabs {
            display: flex;
            background-color: var(--light-bg);
            border-bottom: 1px solid #eee;
            overflow-x: auto;
        }
        
        .results-tab {
            padding: 20px 30px;
            background: none;
            border: none;
            font-weight: 600;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
            border-bottom: 3px solid transparent;
        }
        
        .results-tab:hover {
            color: var(--primary-medium);
        }
        
        .results-tab.active {
            color: var(--primary-medium);
            border-bottom-color: var(--primary-medium);
            background-color: var(--white);
        }
        
        .results-content {
            padding: 30px;
        }
        
        /* Student Results Table */
        .table-container {
            overflow-x: auto;
        }
        
        .results-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .results-table thead {
            background-color: var(--light-bg);
        }
        
        .results-table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
            white-space: nowrap;
        }
        
        .results-table td {
            padding: 18px 20px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .results-table tbody tr {
            transition: all 0.3s;
        }
        
        .results-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .student-info {
            display: flex;
            align-items: center;
        }
        
        .student-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 2px solid var(--light-bg);
        }
        
        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .student-details h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .student-details p {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .score-cell {
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .grade-badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            min-width: 50px;
            text-align: center;
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
        
        .status-indicator {
            display: inline-flex;
            align-items: center;
        }
        
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .status-dot.passed {
            background-color: var(--success);
        }
        
        .status-dot.failed {
            background-color: var(--danger);
        }
        
        .status-dot.conditional {
            background-color: var(--warning);
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .action-btn.view {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .action-btn.print {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }
        
        .action-btn.download {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .action-btn:hover {
            transform: scale(1.1);
        }
        
        /* Individual Student Card View */
        .student-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }
        
        .student-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
            transition: all 0.3s;
        }
        
        .student-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 51, 102, 0.15);
        }
        
        .student-card-header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            padding: 25px;
            color: var(--white);
            display: flex;
            align-items: center;
        }
        
        .student-card-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }
        
        .student-card-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .student-card-header h3 {
            color: var(--white);
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .student-card-header p {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .student-card-body {
            padding: 25px;
        }
        
        .card-results-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .result-item {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
        }
        
        .result-label {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 5px;
        }
        
        .result-value {
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .result-value.score {
            color: var(--primary-dark);
        }
        
        .student-card-footer {
            padding: 20px 25px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
        }
        
        /* Detailed Results View */
        .detailed-results {
            display: none;
        }
        
        .detailed-results.active {
            display: block;
        }
        
        .detailed-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .detailed-info {
            display: flex;
            align-items: center;
        }
        
        .detailed-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 25px;
            border: 4px solid var(--light-bg);
        }
        
        .detailed-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .detailed-actions {
            display: flex;
            gap: 15px;
        }
        
        .subject-results {
            margin-top: 30px;
        }
        
        .subject-card {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .subject-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .subject-header h4 {
            font-size: 1.2rem;
            color: var(--primary-dark);
        }
        
        .subject-grades {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .grade-item {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 51, 102, 0.05);
        }
        
        /* Performance Chart */
        .performance-chart {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.05);
            margin-bottom: 30px;
        }
        
        .chart-container {
            height: 300px;
            position: relative;
            margin-top: 20px;
        }
        
        .chart-placeholder {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
            border-radius: 8px;
            color: #888;
            flex-direction: column;
        }
        
        .chart-placeholder i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
        /* Analysis Section */
        .analysis-section {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.05);
            margin-bottom: 40px;
        }
        
        .analysis-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        
        .analysis-card {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
        }
        
        .analysis-card h5 {
            margin-bottom: 15px;
            color: var(--primary-dark);
            font-size: 1rem;
        }
        
        .analysis-list {
            list-style: none;
        }
        
        .analysis-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }
        
        .analysis-list li:last-child {
            border-bottom: none;
        }
        
        /* View Toggle */
        .view-toggle {
            display: flex;
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 5px;
            margin-bottom: 20px;
            width: fit-content;
        }
        
        .view-toggle-btn {
            padding: 10px 20px;
            border: none;
            background: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .view-toggle-btn.active {
            background-color: var(--white);
            color: var(--primary-medium);
            box-shadow: 0 3px 10px rgba(0, 51, 102, 0.1);
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
        @media (max-width: 1200px) {
            .student-cards {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
            
            .filters-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
            
            .results-summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .results-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .results-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .student-cards {
                grid-template-columns: 1fr;
            }
            
            .results-summary {
                grid-template-columns: 1fr;
            }
            
            .results-tabs {
                flex-wrap: wrap;
            }
            
            .results-tab {
                flex: 1;
                min-width: 120px;
                text-align: center;
                padding: 15px 10px;
            }
            
            .detailed-info {
                flex-direction: column;
                text-align: center;
            }
            
            .detailed-avatar {
                margin-right: 0;
                margin-bottom: 20px;
            }
            
            .analysis-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .results-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .filter-actions {
                flex-direction: column;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
            
            .view-toggle {
                width: 100%;
                justify-content: center;
            }
            
            .card-results-grid {
                grid-template-columns: 1fr;
            }
            
            .detailed-actions {
                flex-direction: column;
                width: 100%;
            }
            
            .detailed-actions .btn {
                width: 100%;
            }
            
            .subject-grades {
                grid-template-columns: 1fr;
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
                <a href="staff-dashboard.html" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="staff-students.html" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Students</span>
                </a>
                
                <a href="staff-courses.html" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">My Courses</span>
                </a>
                
                <a href="staff-results.html" class="menu-item active">
                    <i class="fas fa-chart-line"></i>
                    <span class="menu-text">View Results</span>
                </a>
                
                <a href="staff-attendance.html" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="staff-messages.html" class="menu-item">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-text">Messages</span>
                </a>
                
                <a href="staff-schedule.html" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">Schedule</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Staff">
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
                        <h1>Student Results</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-search"></i>
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
                <!-- Results Header -->
                <div class="results-header">
                    <h2>Exam Results</h2>
                    <div class="results-actions">
                        <button class="btn btn-secondary" id="backBtn">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </button>
                        <button class="btn btn-primary" id="exportBtn">
                            <i class="fas fa-file-export"></i> Export Results
                        </button>
                        <button class="btn btn-primary" id="printAllBtn">
                            <i class="fas fa-print"></i> Print All
                        </button>
                    </div>
                </div>
                
                <!-- View Toggle -->
                <div class="view-toggle" id="viewToggle">
                    <button class="view-toggle-btn active" data-view="table">
                        <i class="fas fa-table"></i> Table View
                    </button>
                    <button class="view-toggle-btn" data-view="cards">
                        <i class="fas fa-th-large"></i> Card View
                    </button>
                    <button class="view-toggle-btn" data-view="analysis">
                        <i class="fas fa-chart-bar"></i> Analysis
                    </button>
                </div>
                
                <!-- Filters Section -->
                <div class="filters-section">
                    <h3 style="margin-bottom: 20px;">Filter Results</h3>
                    <div class="filters-grid">
                        <div class="filter-group">
                            <label for="academicYear">Academic Year</label>
                            <select id="academicYear">
                                <option value="2023-2024" selected>2023-2024</option>
                                <option value="2022-2023">2022-2023</option>
                                <option value="2021-2022">2021-2022</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="term">Term/Semester</label>
                            <select id="term">
                                <option value="">All Terms</option>
                                <option value="1" selected>Term 1</option>
                                <option value="2">Term 2</option>
                                <option value="3">Term 3</option>
                                <option value="sem1">Semester 1</option>
                                <option value="sem2">Semester 2</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="gradeLevel">Grade Level</label>
                            <select id="gradeLevel">
                                <option value="">All Grades</option>
                                <option value="9">Grade 9</option>
                                <option value="10" selected>Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="section">Section</label>
                            <select id="section">
                                <option value="">All Sections</option>
                                <option value="A" selected>Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                                <option value="D">Section D</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="subject">Subject</label>
                            <select id="subject">
                                <option value="">All Subjects</option>
                                <option value="math" selected>Mathematics</option>
                                <option value="physics">Physics</option>
                                <option value="chemistry">Chemistry</option>
                                <option value="biology">Biology</option>
                                <option value="english">English</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="examType">Exam Type</label>
                            <select id="examType">
                                <option value="">All Exams</option>
                                <option value="midterm" selected>Midterm Exam</option>
                                <option value="final">Final Exam</option>
                                <option value="quiz">Quiz</option>
                                <option value="assignment">Assignment</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="filter-actions">
                        <button class="btn btn-secondary" id="applyFiltersBtn">
                            <i class="fas fa-filter"></i> Apply Filters
                        </button>
                        <button class="btn btn-secondary" id="clearFiltersBtn">
                            <i class="fas fa-times"></i> Clear Filters
                        </button>
                    </div>
                </div>
                
                <!-- Results Summary -->
                <div class="results-summary" id="resultsSummary">
                    <div class="summary-card average">
                        <div class="summary-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div class="summary-info">
                            <h3>78.5%</h3>
                            <p>Class Average</p>
                        </div>
                    </div>
                    
                    <div class="summary-card highest">
                        <div class="summary-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="summary-info">
                            <h3>98%</h3>
                            <p>Highest Score</p>
                        </div>
                    </div>
                    
                    <div class="summary-card lowest">
                        <div class="summary-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="summary-info">
                            <h3>52%</h3>
                            <p>Lowest Score</p>
                        </div>
                    </div>
                    
                    <div class="summary-card students">
                        <div class="summary-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="summary-info">
                            <h3>32</h3>
                            <p>Students</p>
                        </div>
                    </div>
                </div>
                
                <!-- Results Container (Table View) -->
                <div class="results-container" id="tableView">
                    <div class="results-tabs">
                        <button class="results-tab active" data-results="all">All Students</button>
                        <button class="results-tab" data-results="passed">Passed (25)</button>
                        <button class="results-tab" data-results="failed">Failed (5)</button>
                        <button class="results-tab" data-results="conditional">Conditional (2)</button>
                    </div>
                    
                    <div class="results-content">
                        <div class="table-container">
                            <table class="results-table" id="resultsTable">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Score</th>
                                        <th>Grade</th>
                                        <th>Percentage</th>
                                        <th>Status</th>
                                        <th>Rank</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="resultsTableBody">
                                    <!-- Results rows will be dynamically generated -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Results Container (Card View) -->
                <div class="results-content" id="cardsView" style="display: none;">
                    <div class="student-cards" id="studentCards">
                        <!-- Student cards will be dynamically generated -->
                    </div>
                </div>
                
                <!-- Analysis View -->
                <div class="results-content" id="analysisView" style="display: none;">
                    <!-- Performance Chart -->
                    <div class="performance-chart">
                        <h3>Class Performance Distribution</h3>
                        <div class="chart-container">
                            <div class="chart-placeholder">
                                <i class="fas fa-chart-bar"></i>
                                <p>Performance Distribution Chart</p>
                                <p style="font-size: 0.9rem;">(Chart.js would be implemented here)</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Analysis Section -->
                    <div class="analysis-section">
                        <h3>Performance Analysis</h3>
                        <div class="analysis-grid">
                            <div class="analysis-card">
                                <h5>Grade Distribution</h5>
                                <ul class="analysis-list">
                                    <li>
                                        <span>A (90-100%)</span>
                                        <span>8 students</span>
                                    </li>
                                    <li>
                                        <span>B (80-89%)</span>
                                        <span>12 students</span>
                                    </li>
                                    <li>
                                        <span>C (70-79%)</span>
                                        <span>7 students</span>
                                    </li>
                                    <li>
                                        <span>D (60-69%)</span>
                                        <span>3 students</span>
                                    </li>
                                    <li>
                                        <span>F (Below 60%)</span>
                                        <span>2 students</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="analysis-card">
                                <h5>Performance Insights</h5>
                                <ul class="analysis-list">
                                    <li>
                                        <span>Class Average</span>
                                        <span>78.5%</span>
                                    </li>
                                    <li>
                                        <span>Median Score</span>
                                        <span>81%</span>
                                    </li>
                                    <li>
                                        <span>Standard Deviation</span>
                                        <span>12.3</span>
                                    </li>
                                    <li>
                                        <span>Pass Rate</span>
                                        <span>84.4%</span>
                                    </li>
                                    <li>
                                        <span>Top 10% Average</span>
                                        <span>94.2%</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="analysis-card">
                                <h5>Recommendations</h5>
                                <ul class="analysis-list" style="border: none;">
                                    <li style="border: none; padding: 0 0 15px 0;">
                                        <span>Focus Areas:</span>
                                    </li>
                                    <li style="border: none; padding: 0 0 10px 0; font-size: 0.9rem;">
                                        <i class="fas fa-check-circle" style="color: var(--success); margin-right: 8px;"></i>
                                        <span>Algebra concepts well understood</span>
                                    </li>
                                    <li style="border: none; padding: 0 0 10px 0; font-size: 0.9rem;">
                                        <i class="fas fa-exclamation-triangle" style="color: var(--warning); margin-right: 8px;"></i>
                                        <span>Geometry needs reinforcement</span>
                                    </li>
                                    <li style="border: none; padding: 0 0 10px 0; font-size: 0.9rem;">
                                        <i class="fas fa-times-circle" style="color: var(--danger); margin-right: 8px;"></i>
                                        <span>Word problems challenging for 30%</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Detailed Results View (Hidden by default) -->
                <div class="detailed-results" id="detailedView">
                    <div class="detailed-header">
                        <div class="detailed-info">
                            <div class="detailed-avatar">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael Johnson">
                            </div>
                            <div>
                                <h2>Michael Johnson</h2>
                                <p>Grade 10 - Section A | Student ID: STU-2023-045</p>
                                <p>Mathematics - Midterm Exam Results</p>
                            </div>
                        </div>
                        
                        <div class="detailed-actions">
                            <button class="btn btn-secondary" id="backToResultsBtn">
                                <i class="fas fa-arrow-left"></i> Back to Results
                            </button>
                            <button class="btn btn-primary">
                                <i class="fas fa-print"></i> Print Result
                            </button>
                            <button class="btn btn-primary">
                                <i class="fas fa-download"></i> Download PDF
                            </button>
                        </div>
                    </div>
                    
                    <!-- Subject Results -->
                    <div class="subject-results">
                        <div class="subject-card">
                            <div class="subject-header">
                                <h4>Mathematics - Midterm Exam</h4>
                                <div>
                                    <span class="grade-badge grade-a" style="font-size: 1.1rem;">A (92%)</span>
                                </div>
                            </div>
                            
                            <div class="subject-grades">
                                <div class="grade-item">
                                    <span>Total Score</span>
                                    <span class="result-value score">92/100</span>
                                </div>
                                <div class="grade-item">
                                    <span>Class Rank</span>
                                    <span class="result-value">#3 of 32</span>
                                </div>
                                <div class="grade-item">
                                    <span>Grade</span>
                                    <span class="grade-badge grade-a">A</span>
                                </div>
                                <div class="grade-item">
                                    <span>Status</span>
                                    <span class="status-indicator">
                                        <span class="status-dot passed"></span>
                                        <span>Passed</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="performance-chart">
                            <h4>Subject Breakdown</h4>
                            <div class="chart-container">
                                <div class="chart-placeholder">
                                    <i class="fas fa-chart-pie"></i>
                                    <p>Subject Breakdown Chart</p>
                                    <p style="font-size: 0.9rem;">(Chart.js would be implemented here)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Results Module v3.2</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample results data
        const sampleResults = [
            {
                id: "STU-2023-045",
                name: "Michael Johnson",
                avatar: "https://randomuser.me/api/portraits/men/45.jpg",
                grade: "10",
                section: "A",
                score: 92,
                total: 100,
                percentage: 92,
                gradeLetter: "A",
                status: "passed",
                rank: 3,
                totalStudents: 32
            },
            {
                id: "STU-2023-046",
                name: "Sarah Williams",
                avatar: "https://randomuser.me/api/portraits/women/65.jpg",
                grade: "10",
                section: "A",
                score: 85,
                total: 100,
                percentage: 85,
                gradeLetter: "B",
                status: "passed",
                rank: 8,
                totalStudents: 32
            },
            {
                id: "STU-2023-047",
                name: "James Wilson",
                avatar: "https://randomuser.me/api/portraits/men/22.jpg",
                grade: "10",
                section: "A",
                score: 78,
                total: 100,
                percentage: 78,
                gradeLetter: "C",
                status: "passed",
                rank: 15,
                totalStudents: 32
            },
            {
                id: "STU-2023-048",
                name: "Emily Davis",
                avatar: "https://randomuser.me/api/portraits/women/32.jpg",
                grade: "10",
                section: "A",
                score: 95,
                total: 100,
                percentage: 95,
                gradeLetter: "A",
                status: "passed",
                rank: 1,
                totalStudents: 32
            },
            {
                id: "STU-2023-049",
                name: "Robert Chen",
                avatar: "https://randomuser.me/api/portraits/men/55.jpg",
                grade: "10",
                section: "A",
                score: 88,
                total: 100,
                percentage: 88,
                gradeLetter: "B",
                status: "passed",
                rank: 5,
                totalStudents: 32
            },
            {
                id: "STU-2023-050",
                name: "Olivia Martinez",
                avatar: "https://randomuser.me/api/portraits/women/45.jpg",
                grade: "10",
                section: "A",
                score: 72,
                total: 100,
                percentage: 72,
                gradeLetter: "C",
                status: "passed",
                rank: 20,
                totalStudents: 32
            },
            {
                id: "STU-2023-051",
                name: "David Brown",
                avatar: "https://randomuser.me/api/portraits/men/65.jpg",
                grade: "10",
                section: "A",
                score: 65,
                total: 100,
                percentage: 65,
                gradeLetter: "D",
                status: "conditional",
                rank: 28,
                totalStudents: 32
            },
            {
                id: "STU-2023-052",
                name: "Sophia Garcia",
                avatar: "https://randomuser.me/api/portraits/women/68.jpg",
                grade: "10",
                section: "A",
                score: 98,
                total: 100,
                percentage: 98,
                gradeLetter: "A",
                status: "passed",
                rank: 2,
                totalStudents: 32
            },
            {
                id: "STU-2023-053",
                name: "William Taylor",
                avatar: "https://randomuser.me/api/portraits/men/75.jpg",
                grade: "10",
                section: "A",
                score: 52,
                total: 100,
                percentage: 52,
                gradeLetter: "F",
                status: "failed",
                rank: 32,
                totalStudents: 32
            },
            {
                id: "STU-2023-054",
                name: "Ava Anderson",
                avatar: "https://randomuser.me/api/portraits/women/55.jpg",
                grade: "10",
                section: "A",
                score: 81,
                total: 100,
                percentage: 81,
                gradeLetter: "B",
                status: "passed",
                rank: 10,
                totalStudents: 32
            }
        ];
        
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const backBtn = document.getElementById('backBtn');
        const exportBtn = document.getElementById('exportBtn');
        const printAllBtn = document.getElementById('printAllBtn');
        const applyFiltersBtn = document.getElementById('applyFiltersBtn');
        const clearFiltersBtn = document.getElementById('clearFiltersBtn');
        const resultsTableBody = document.getElementById('resultsTableBody');
        const studentCards = document.getElementById('studentCards');
        const backToResultsBtn = document.getElementById('backToResultsBtn');
        
        // View toggle elements
        const viewToggle = document.getElementById('viewToggle');
        const tableView = document.getElementById('tableView');
        const cardsView = document.getElementById('cardsView');
        const analysisView = document.getElementById('analysisView');
        const detailedView = document.getElementById('detailedView');
        
        // Filter elements
        const academicYearFilter = document.getElementById('academicYear');
        const termFilter = document.getElementById('term');
        const gradeLevelFilter = document.getElementById('gradeLevel');
        const sectionFilter = document.getElementById('section');
        const subjectFilter = document.getElementById('subject');
        const examTypeFilter = document.getElementById('examType');
        
        // Results tabs
        const resultsTabs = document.querySelectorAll('.results-tab');
        
        // State variables
        let currentView = 'table';
        let currentResultsTab = 'all';
        let filteredResults = [...sampleResults];
        let showingDetailedView = false;
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderResults();
            setupEventListeners();
            updateSummary();
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
            
            // Back button
            backBtn.addEventListener('click', () => {
                if (showingDetailedView) {
                    showMainView();
                } else {
                    window.location.href = 'staff-dashboard.html';
                }
            });
            
            // Export button
            exportBtn.addEventListener('click', exportResults);
            
            // Print all button
            printAllBtn.addEventListener('click', printAllResults);
            
            // Filter buttons
            applyFiltersBtn.addEventListener('click', applyFilters);
            clearFiltersBtn.addEventListener('click', clearFilters);
            
            // View toggle
            viewToggle.addEventListener('click', function(e) {
                if (e.target.classList.contains('view-toggle-btn')) {
                    const view = e.target.dataset.view;
                    switchView(view);
                }
            });
            
            // Results tabs
            resultsTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const resultsType = this.getAttribute('data-results');
                    switchResultsTab(resultsType);
                });
            });
            
            // Back to results button
            backToResultsBtn.addEventListener('click', showMainView);
            
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
        
        // Render results based on current view
        function renderResults() {
            if (currentView === 'table') {
                renderResultsTable();
            } else if (currentView === 'cards') {
                renderResultsCards();
            }
        }
        
        // Render results table
        function renderResultsTable() {
            resultsTableBody.innerHTML = '';
            
            if (filteredResults.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-clipboard-check" style="font-size: 2rem; margin-bottom: 15px; display: block;"></i>
                        <h4>No results found</h4>
                        <p>Try adjusting your filters or check back later</p>
                    </td>
                `;
                resultsTableBody.appendChild(emptyRow);
                return;
            }
            
            // Filter by results tab if needed
            let displayResults = [...filteredResults];
            if (currentResultsTab !== 'all') {
                displayResults = filteredResults.filter(result => result.status === currentResultsTab);
            }
            
            displayResults.forEach(result => {
                const row = createResultsTableRow(result);
                resultsTableBody.appendChild(row);
            });
        }
        
        // Create a results table row
        function createResultsTableRow(result) {
            const row = document.createElement('tr');
            row.dataset.id = result.id;
            
            // Get grade class
            let gradeClass = '';
            switch(result.gradeLetter) {
                case 'A': gradeClass = 'grade-a'; break;
                case 'B': gradeClass = 'grade-b'; break;
                case 'C': gradeClass = 'grade-c'; break;
                case 'D': gradeClass = 'grade-d'; break;
                case 'F': gradeClass = 'grade-f'; break;
            }
            
            // Get status dot class
            let statusDotClass = '';
            let statusText = '';
            switch(result.status) {
                case 'passed':
                    statusDotClass = 'passed';
                    statusText = 'Passed';
                    break;
                case 'failed':
                    statusDotClass = 'failed';
                    statusText = 'Failed';
                    break;
                case 'conditional':
                    statusDotClass = 'conditional';
                    statusText = 'Conditional';
                    break;
            }
            
            row.innerHTML = `
                <td>
                    <div class="student-info">
                        <div class="student-avatar">
                            <img src="${result.avatar}" alt="${result.name}">
                        </div>
                        <div class="student-details">
                            <h4>${result.name}</h4>
                            <p>${result.grade} - ${result.section} | ${result.id}</p>
                        </div>
                    </div>
                </td>
                <td class="score-cell">${result.score}/${result.total}</td>
                <td><span class="grade-badge ${gradeClass}">${result.gradeLetter}</span></td>
                <td>${result.percentage}%</td>
                <td>
                    <div class="status-indicator">
                        <span class="status-dot ${statusDotClass}"></span>
                        <span>${statusText}</span>
                    </div>
                </td>
                <td>#${result.rank}</td>
                <td>
                    <div class="action-buttons">
                        <button class="action-btn view" data-id="${result.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn print" data-id="${result.id}">
                            <i class="fas fa-print"></i>
                        </button>
                        <button class="action-btn download" data-id="${result.id}">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </td>
            `;
            
            // Add event listeners to action buttons
            const viewBtn = row.querySelector('.action-btn.view');
            const printBtn = row.querySelector('.action-btn.print');
            const downloadBtn = row.querySelector('.action-btn.download');
            
            viewBtn.addEventListener('click', () => viewDetailedResults(result.id));
            printBtn.addEventListener('click', () => printResult(result.id));
            downloadBtn.addEventListener('click', () => downloadResult(result.id));
            
            return row;
        }
        
        // Render results cards
        function renderResultsCards() {
            studentCards.innerHTML = '';
            
            if (filteredResults.length === 0) {
                const emptyState = document.createElement('div');
                emptyState.className = 'empty-state';
                emptyState.style.textAlign = 'center';
                emptyState.style.padding = '40px';
                emptyState.style.gridColumn = '1 / -1';
                emptyState.innerHTML = `
                    <i class="fas fa-clipboard-check" style="font-size: 3rem; color: var(--primary-light); margin-bottom: 20px;"></i>
                    <h3>No results found</h3>
                    <p>Try adjusting your filters or check back later</p>
                `;
                studentCards.appendChild(emptyState);
                return;
            }
            
            // Filter by results tab if needed
            let displayResults = [...filteredResults];
            if (currentResultsTab !== 'all') {
                displayResults = filteredResults.filter(result => result.status === currentResultsTab);
            }
            
            displayResults.forEach(result => {
                const card = createResultsCard(result);
                studentCards.appendChild(card);
            });
        }
        
        // Create a results card
        function createResultsCard(result) {
            const card = document.createElement('div');
            card.className = 'student-card';
            card.dataset.id = result.id;
            
            // Get grade class
            let gradeClass = '';
            switch(result.gradeLetter) {
                case 'A': gradeClass = 'grade-a'; break;
                case 'B': gradeClass = 'grade-b'; break;
                case 'C': gradeClass = 'grade-c'; break;
                case 'D': gradeClass = 'grade-d'; break;
                case 'F': gradeClass = 'grade-f'; break;
            }
            
            // Get status text and color
            let statusText = '';
            let statusColor = '';
            switch(result.status) {
                case 'passed':
                    statusText = 'Passed';
                    statusColor = 'var(--success)';
                    break;
                case 'failed':
                    statusText = 'Failed';
                    statusColor = 'var(--danger)';
                    break;
                case 'conditional':
                    statusText = 'Conditional';
                    statusColor = 'var(--warning)';
                    break;
            }
            
            card.innerHTML = `
                <div class="student-card-header">
                    <div class="student-card-avatar">
                        <img src="${result.avatar}" alt="${result.name}">
                    </div>
                    <div>
                        <h3>${result.name}</h3>
                        <p>${result.grade} - ${result.section} | ${result.id}</p>
                        <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;">
                            <span class="grade-badge ${gradeClass}" style="font-size: 1rem;">${result.gradeLetter} (${result.percentage}%)</span>
                            <span style="display: flex; align-items: center; gap: 5px;">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background-color: ${statusColor};"></span>
                                <span style="font-size: 0.8rem;">${statusText}</span>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="student-card-body">
                    <div class="card-results-grid">
                        <div class="result-item">
                            <div class="result-label">Score</div>
                            <div class="result-value score">${result.score}/${result.total}</div>
                        </div>
                        <div class="result-item">
                            <div class="result-label">Percentage</div>
                            <div class="result-value">${result.percentage}%</div>
                        </div>
                        <div class="result-item">
                            <div class="result-label">Class Rank</div>
                            <div class="result-value">#${result.rank} of ${result.totalStudents}</div>
                        </div>
                        <div class="result-item">
                            <div class="result-label">Status</div>
                            <div class="result-value">${statusText}</div>
                        </div>
                    </div>
                </div>
                
                <div class="student-card-footer">
                    <div>Mathematics Midterm</div>
                    <div class="action-buttons">
                        <button class="action-btn view" data-id="${result.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn print" data-id="${result.id}">
                            <i class="fas fa-print"></i>
                        </button>
                        <button class="action-btn download" data-id="${result.id}">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            `;
            
            // Add event listeners to action buttons
            const viewBtn = card.querySelector('.action-btn.view');
            const printBtn = card.querySelector('.action-btn.print');
            const downloadBtn = card.querySelector('.action-btn.download');
            
            viewBtn.addEventListener('click', () => viewDetailedResults(result.id));
            printBtn.addEventListener('click', () => printResult(result.id));
            downloadBtn.addEventListener('click', () => downloadResult(result.id));
            
            return card;
        }
        
        // Apply filters
        function applyFilters() {
            const academicYear = academicYearFilter.value;
            const term = termFilter.value;
            const gradeLevel = gradeLevelFilter.value;
            const section = sectionFilter.value;
            const subject = subjectFilter.value;
            const examType = examTypeFilter.value;
            
            // In a real app, this would filter from an API
            // For now, we'll simulate filtering
            filteredResults = sampleResults.filter(result => {
                // Grade level filter
                if (gradeLevel && result.grade !== gradeLevel) return false;
                
                // Section filter
                if (section && result.section !== section) return false;
                
                return true;
            });
            
            // Update display
            renderResults();
            updateSummary();
            
            // Show success message
            showNotification('Filters applied successfully', 'success');
        }
        
        // Clear filters
        function clearFilters() {
            academicYearFilter.value = '2023-2024';
            termFilter.value = '1';
            gradeLevelFilter.value = '10';
            sectionFilter.value = 'A';
            subjectFilter.value = 'math';
            examTypeFilter.value = 'midterm';
            
            filteredResults = [...sampleResults];
            renderResults();
            updateSummary();
            
            showNotification('Filters cleared', 'info');
        }
        
        // Update summary cards
        function updateSummary() {
            if (filteredResults.length === 0) {
                document.querySelector('.summary-card.average .summary-info h3').textContent = '0%';
                document.querySelector('.summary-card.highest .summary-info h3').textContent = '0%';
                document.querySelector('.summary-card.lowest .summary-info h3').textContent = '0%';
                document.querySelector('.summary-card.students .summary-info h3').textContent = '0';
                return;
            }
            
            // Calculate average
            const totalPercentage = filteredResults.reduce((sum, result) => sum + result.percentage, 0);
            const average = totalPercentage / filteredResults.length;
            
            // Find highest and lowest
            const highest = Math.max(...filteredResults.map(r => r.percentage));
            const lowest = Math.min(...filteredResults.map(r => r.percentage));
            
            // Update UI
            document.querySelector('.summary-card.average .summary-info h3').textContent = average.toFixed(1) + '%';
            document.querySelector('.summary-card.highest .summary-info h3').textContent = highest + '%';
            document.querySelector('.summary-card.lowest .summary-info h3').textContent = lowest + '%';
            document.querySelector('.summary-card.students .summary-info h3').textContent = filteredResults.length;
        }
        
        // Switch between views (table, cards, analysis)
        function switchView(view) {
            currentView = view;
            
            // Update active button
            document.querySelectorAll('.view-toggle-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-view="${view}"]`).classList.add('active');
            
            // Show/hide views
            tableView.style.display = 'none';
            cardsView.style.display = 'none';
            analysisView.style.display = 'none';
            detailedView.classList.remove('active');
            
            if (view === 'table') {
                tableView.style.display = 'block';
            } else if (view === 'cards') {
                cardsView.style.display = 'block';
                renderResultsCards();
            } else if (view === 'analysis') {
                analysisView.style.display = 'block';
            }
            
            showingDetailedView = false;
        }
        
        // Switch results tab
        function switchResultsTab(tab) {
            currentResultsTab = tab;
            
            // Update active tab button
            resultsTabs.forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-results="${tab}"]`).classList.add('active');
            
            // Update counts in tab buttons (simulated)
            if (tab === 'passed') {
                document.querySelector('[data-results="passed"]').textContent = `Passed (${filteredResults.filter(r => r.status === 'passed').length})`;
            } else if (tab === 'failed') {
                document.querySelector('[data-results="failed"]').textContent = `Failed (${filteredResults.filter(r => r.status === 'failed').length})`;
            } else if (tab === 'conditional') {
                document.querySelector('[data-results="conditional"]').textContent = `Conditional (${filteredResults.filter(r => r.status === 'conditional').length})`;
            }
            
            // Re-render results
            renderResults();
        }
        
        // View detailed results for a student
        function viewDetailedResults(studentId) {
            const student = filteredResults.find(s => s.id === studentId);
            if (!student) return;
            
            // Hide main views
            tableView.style.display = 'none';
            cardsView.style.display = 'none';
            analysisView.style.display = 'none';
            
            // Show detailed view
            detailedView.classList.add('active');
            showingDetailedView = true;
            
            // Update back button text
            backBtn.innerHTML = '<i class="fas fa-arrow-left"></i> Back to Results';
            
            // Update detailed view with student data
            const detailedAvatar = detailedView.querySelector('.detailed-avatar img');
            const detailedName = detailedView.querySelector('.detailed-info h2');
            const detailedInfo = detailedView.querySelector('.detailed-info p:nth-child(2)');
            const detailedSubject = detailedView.querySelector('.detailed-info p:nth-child(3)');
            
            detailedAvatar.src = student.avatar;
            detailedAvatar.alt = student.name;
            detailedName.textContent = student.name;
            detailedInfo.textContent = `Grade ${student.grade} - Section ${student.section} | Student ID: ${student.id}`;
            detailedSubject.textContent = 'Mathematics - Midterm Exam Results';
            
            // Update grade badge
            const gradeBadge = detailedView.querySelector('.subject-header .grade-badge');
            gradeBadge.textContent = `${student.gradeLetter} (${student.percentage}%)`;
            gradeBadge.className = `grade-badge grade-${student.gradeLetter.toLowerCase()}`;
            gradeBadge.style.fontSize = '1.1rem';
            
            // Update score values
            detailedView.querySelector('.grade-item:nth-child(1) .result-value').textContent = `${student.score}/${student.total}`;
            detailedView.querySelector('.grade-item:nth-child(2) .result-value').textContent = `#${student.rank} of ${student.totalStudents}`;
            
            // Update status
            const statusDot = detailedView.querySelector('.grade-item:nth-child(4) .status-dot');
            const statusText = detailedView.querySelector('.grade-item:nth-child(4) span:nth-child(2)');
            
            statusDot.className = 'status-dot ' + student.status;
            statusText.textContent = student.status.charAt(0).toUpperCase() + student.status.slice(1);
        }
        
        // Show main view (hide detailed view)
        function showMainView() {
            detailedView.classList.remove('active');
            showingDetailedView = false;
            
            // Show current view
            if (currentView === 'table') {
                tableView.style.display = 'block';
            } else if (currentView === 'cards') {
                cardsView.style.display = 'block';
            } else if (currentView === 'analysis') {
                analysisView.style.display = 'block';
            }
            
            // Reset back button
            backBtn.innerHTML = '<i class="fas fa-arrow-left"></i> Back to Dashboard';
        }
        
        // Export results
        function exportResults() {
            alert('Exporting results to Excel...');
            // In a real app, this would trigger a download
        }
        
        // Print all results
        function printAllResults() {
            alert('Opening print dialog for all results...');
            // In a real app, this would open the print dialog
        }
        
        // Print individual result
        function printResult(studentId) {
            const student = filteredResults.find(s => s.id === studentId);
            if (!student) return;
            
            alert(`Printing result for ${student.name}...`);
        }
        
        // Download individual result
        function downloadResult(studentId) {
            const student = filteredResults.find(s => s.id === studentId);
            if (!student) return;
            
            alert(`Downloading PDF result for ${student.name}...`);
        }
        
        // Show notification
        function showNotification(message, type) {
            // In a real app, this would show a toast notification
            console.log(`${type.toUpperCase()}: ${message}`);
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
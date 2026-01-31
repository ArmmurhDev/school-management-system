<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - T&T School</title>
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
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        header {
            background-color: var(--white);
            box-shadow: 0 2px 15px var(--shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-dark), var(--accent-blue));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .logo-icon i {
            font-size: 24px;
            color: var(--white);
        }
        
        .logo-text h1 {
            font-size: 1.8rem;
            margin-bottom: 3px;
        }
        
        .logo-text p {
            font-size: 0.9rem;
            color: var(--primary-medium);
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 30px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: var(--primary-dark);
            font-weight: 500;
            transition: color 0.3s;
            font-size: 1rem;
        }
        
        nav ul li a:hover {
            color: var(--accent-blue);
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-dark);
            cursor: pointer;
        }
        
        /* Page Hero */
        .page-hero {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 150px 0 80px;
            margin-top: 80px;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .page-hero::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            top: -100px;
            right: -100px;
        }
        
        .page-hero::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
            bottom: -80px;
            left: -80px;
        }
        
        .page-hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: var(--white);
            position: relative;
            z-index: 1;
        }
        
        .page-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        
        /* About Intro */
        .about-intro {
            padding: 100px 0;
            background-color: var(--white);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            display: inline-block;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title h2::after {
            content: "";
            position: absolute;
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-light), var(--accent-blue));
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        .intro-content {
            display: flex;
            align-items: center;
            gap: 60px;
            margin-bottom: 80px;
        }
        
        .intro-text {
            flex: 1;
        }
        
        .intro-text h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--primary-medium);
        }
        
        .intro-text p {
            margin-bottom: 25px;
            color: var(--text-light);
        }
        
        .intro-image {
            flex: 1;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 51, 102, 0.1);
        }
        
        .intro-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }
        
        .intro-image img:hover {
            transform: scale(1.03);
        }
        
        .mission-vision {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
            margin-top: 50px;
        }
        
        .mission-card, .vision-card {
            background-color: var(--light-bg);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.05);
            transition: transform 0.3s ease;
        }
        
        .mission-card:hover, .vision-card:hover {
            transform: translateY(-10px);
        }
        
        .mission-card h3, .vision-card h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--primary-medium);
            display: flex;
            align-items: center;
        }
        
        .mission-card h3 i, .vision-card h3 i {
            margin-right: 15px;
            background-color: var(--white);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-medium);
        }
        
        /* History Timeline */
        .history {
            padding: 100px 0;
            background-color: var(--light-bg);
        }
        
        .timeline {
            position: relative;
            max-width: 800px;
            margin: 50px auto 0;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            width: 4px;
            background-color: var(--primary-light);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
        }
        
        .timeline-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
            margin-bottom: 40px;
        }
        
        .timeline-item:nth-child(odd) {
            left: 0;
        }
        
        .timeline-item:nth-child(even) {
            left: 50%;
        }
        
        .timeline-content {
            padding: 20px 30px;
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.1);
            position: relative;
        }
        
        .timeline-content h4 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }
        
        .timeline-content p {
            color: var(--text-light);
        }
        
        .timeline-item:nth-child(odd) .timeline-content::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: var(--white);
            top: 30px;
            transform: rotate(45deg);
            box-shadow: 3px -3px 5px rgba(0, 0, 0, 0.05);
        }
        
        .timeline-item:nth-child(even) .timeline-content::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            left: -10px;
            background-color: var(--white);
            top: 30px;
            transform: rotate(45deg);
            box-shadow: -3px 3px 5px rgba(0, 0, 0, 0.05);
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: var(--primary-medium);
            border: 4px solid var(--primary-light);
            border-radius: 50%;
            top: 30px;
            right: -10px;
        }
        
        .timeline-item:nth-child(even)::after {
            left: -10px;
        }
        
        /* Our Team */
        .our-team {
            padding: 100px 0;
            background-color: var(--white);
        }
        
        .team-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-top: 50px;
        }
        
        .team-member {
            text-align: center;
            background-color: var(--light-bg);
            border-radius: 15px;
            padding: 30px 20px;
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 51, 102, 0.1);
        }
        
        .member-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 25px;
            border: 5px solid var(--white);
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.1);
        }
        
        .member-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .team-member h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }
        
        .team-member .position {
            color: var(--primary-medium);
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1rem;
        }
        
        .team-member p {
            color: var(--text-light);
            margin-bottom: 20px;
            font-size: 0.95rem;
        }
        
        .member-social {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .member-social a {
            width: 40px;
            height: 40px;
            background-color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-medium);
            transition: all 0.3s ease;
        }
        
        .member-social a:hover {
            background-color: var(--primary-medium);
            color: var(--white);
        }
        
        /* Footer */
        footer {
            background-color: var(--primary-dark);
            color: var(--white);
            padding: 70px 0 20px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 50px;
        }
        
        .footer-column h3 {
            color: var(--white);
            font-size: 1.4rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-column h3::after {
            content: "";
            position: absolute;
            width: 40px;
            height: 3px;
            background-color: var(--accent-blue);
            bottom: 0;
            left: 0;
        }
        
        .footer-column p, .footer-column a {
            color: #CCD6F6;
            margin-bottom: 15px;
            display: block;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-column a:hover {
            color: var(--white);
            padding-left: 5px;
        }
        
        .social-links {
            display: flex;
            margin-top: 20px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            transition: background-color 0.3s;
        }
        
        .social-links a:hover {
            background-color: var(--accent-blue);
        }
        
        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: #CCD6F6;
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .intro-content {
                flex-direction: column;
            }
            
            .mission-vision {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .team-container {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .timeline::before {
                left: 30px;
            }
            
            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-item:nth-child(even) {
                left: 0;
            }
            
            .timeline-item::after {
                left: 20px;
                right: auto;
            }
            
            .timeline-item:nth-child(odd) .timeline-content::after,
            .timeline-item:nth-child(even) .timeline-content::after {
                left: -10px;
                right: auto;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                padding: 15px 0;
            }
            
            nav {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                background-color: var(--white);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                transition: left 0.3s ease;
                padding: 20px 0;
            }
            
            nav.active {
                left: 0;
            }
            
            nav ul {
                flex-direction: column;
                align-items: center;
            }
            
            nav ul li {
                margin: 15px 0;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .page-hero {
                padding: 120px 0 60px;
            }
            
            .page-hero h1 {
                font-size: 2.5rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .team-container {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }
            
            .page-hero h1 {
                font-size: 2rem;
            }
            
            .mission-card, .vision-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="logo-text">
                    <h1>T&T School</h1>
                    <p>Excellence in Education</p>
                </div>
            </div>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <nav id="mainNav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="container">
            <h1>About Our School</h1>
            <p>Discover our legacy of educational excellence, our dedicated team, and our vision for shaping tomorrow's leaders</p>
        </div>
    </section>

    <!-- About Intro -->
    <section class="about-intro">
        <div class="container">
            <div class="intro-content">
                <div class="intro-text">
                    <h3>Our Story & Philosophy</h3>
                    <p>Founded in 1995, T&T School has been at the forefront of educational excellence for over 25 years. What began as a small institution with just 50 students has grown into a comprehensive educational community serving over 1,200 students from preschool through high school.</p>
                    <p>Our philosophy is rooted in the belief that education should be a transformative experience that goes beyond textbooks and tests. We strive to create an environment where students can discover their passions, develop critical thinking skills, and cultivate a lifelong love of learning.</p>
                    <p>At T&T School, we believe in holistic development that balances academic rigor with creative expression, physical well-being, and social responsibility. Our approach prepares students not just for college, but for life.</p>
                </div>
                <div class="intro-image">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="T&T School Campus">
                </div>
            </div>
            
            <div class="mission-vision">
                <div class="mission-card">
                    <h3><i class="fas fa-bullseye"></i> Our Mission</h3>
                    <p>To provide a nurturing and innovative learning environment that empowers students to achieve their full potential, develop strong character, and become responsible global citizens who contribute positively to society.</p>
                </div>
                
                <div class="vision-card">
                    <h3><i class="fas fa-eye"></i> Our Vision</h3>
                    <p>To be recognized as a leading educational institution that inspires lifelong learning, fosters creativity and critical thinking, and prepares students to thrive in an ever-changing world through academic excellence and holistic development.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- School History -->
    <section class="history">
        <div class="container">
            <div class="section-title">
                <h2>Our Journey</h2>
            </div>
            
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>1995 - Founding Years</h4>
                        <p>T&T School was established with just 50 students and 8 dedicated teachers in a small building with a vision to provide quality education to the community.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>2002 - First Expansion</h4>
                        <p>Our first major expansion with the addition of a science lab, computer center, and library. Student population grew to 300 across elementary and middle school.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>2010 - High School Program</h4>
                        <p>Launched our high school program with college preparatory curriculum. Introduced Advanced Placement courses and extracurricular clubs.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>2018 - STEM Innovation Center</h4>
                        <p>Opened state-of-the-art STEM Innovation Center with robotics lab, 3D printing facilities, and dedicated spaces for collaborative projects.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>2023 - Recognition & Growth</h4>
                        <p>Recognized as a "School of Excellence" by the State Education Board. Current enrollment exceeds 1,200 students with plans for a new performing arts center.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="our-team">
        <div class="container">
            <div class="section-title">
                <h2>Meet Our Leadership Team</h2>
                <p>Dedicated professionals committed to educational excellence</p>
            </div>
            
            <div class="team-container">
                <div class="team-member">
                    <div class="member-photo">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Dr. Sarah Williams">
                    </div>
                    <h3>Dr. Sarah Williams</h3>
                    <div class="position">Head of School</div>
                    <p>With over 20 years in educational leadership, Dr. Williams holds a Ph.D. in Educational Administration and is passionate about innovative teaching methodologies.</p>
                    <div class="member-social">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
                
                <div class="team-member">
                    <div class="member-photo">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w-600&q=80" alt="Mr. David Chen">
                    </div>
                    <h3>Mr. David Chen</h3>
                    <div class="position">Academic Director</div>
                    <p>Former university professor with 15+ years experience in curriculum development. Specializes in STEM education and student assessment strategies.</p>
                    <div class="member-social">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
                
                <div class="team-member">
                    <div class="member-photo">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Ms. Priya Sharma">
                    </div>
                    <h3>Ms. Priya Sharma</h3>
                    <div class="position">Director of Student Affairs</div>
                    <p>Dedicated to student wellbeing and holistic development. Leads our counseling department and extracurricular programs with compassion and expertise.</p>
                    <div class="member-social">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>T&T School</h3>
                    <p>Providing quality education since 1995. We are committed to nurturing young minds and preparing them for a successful future.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <a href="index.html">Home</a>
                    <a href="about.html">About Us</a>
                    <a href="academics.html">Academics</a>
                    <a href="admissions.html">Admissions</a>
                    <a href="contact.html">Contact</a>
                </div>
                
                <div class="footer-column">
                    <h3>Programs</h3>
                    <a href="#">Early Childhood</a>
                    <a href="#">Elementary School</a>
                    <a href="#">Middle School</a>
                    <a href="#">High School</a>
                    <a href="#">STEM Program</a>
                    <a href="#">Arts & Music</a>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Education Avenue, Knowledge City</p>
                    <p><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                    <p><i class="fas fa-envelope"></i> info@ttschool.edu</p>
                    <p><i class="fas fa-clock"></i> Mon-Fri: 8:00 AM - 5:00 PM</p>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2023 T&T School. All Rights Reserved. | Designed with <i class="fas fa-heart" style="color: #ff6b6b;"></i> for Education</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mainNav = document.getElementById('mainNav');
        
        mobileMenuBtn.addEventListener('click', () => {
            mainNav.classList.toggle('active');
            const icon = mobileMenuBtn.querySelector('i');
            if (mainNav.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
        
        // Close mobile menu when clicking a link
        document.querySelectorAll('#mainNav a').forEach(link => {
            link.addEventListener('click', () => {
                mainNav.classList.remove('active');
                const icon = mobileMenuBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
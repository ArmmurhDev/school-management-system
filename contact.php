<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T&T School - Contact Us</title>
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
        
        nav ul li a.active {
            color: var(--accent-blue);
            font-weight: 600;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-dark);
            cursor: pointer;
        }
        
        /* Contact Hero */
        .contact-hero {
            background: linear-gradient(135deg, var(--light-bg) 0%, #E3F2FD 100%);
            padding: 150px 0 60px;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }
        
        .contact-hero::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(77, 143, 204, 0.1) 0%, rgba(30, 136, 229, 0.05) 100%);
            top: -100px;
            right: -100px;
        }
        
        .contact-hero::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(0, 51, 102, 0.1) 0%, rgba(0, 80, 158, 0.05) 100%);
            bottom: -80px;
            left: -80px;
        }
        
        .contact-hero .container {
            position: relative;
            z-index: 1;
        }
        
        .contact-hero h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .contact-hero p {
            font-size: 1.2rem;
            color: var(--text-light);
            text-align: center;
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Contact Section */
        .contact-section {
            padding: 80px 0;
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
        
        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }
        
        /* Contact Form */
        .contact-form-container {
            background-color: var(--light-bg);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 51, 102, 0.08);
        }
        
        .contact-form-container h3 {
            font-size: 1.8rem;
            margin-bottom: 25px;
            color: var(--primary-medium);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .form-control {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-light);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: var(--white);
            padding: 14px 32px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 80, 158, 0.2);
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 80, 158, 0.3);
        }
        
        /* Contact Info */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        .info-card {
            background-color: var(--light-bg);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 51, 102, 0.08);
        }
        
        .info-card h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--primary-medium);
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
            background-color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0, 51, 102, 0.1);
        }
        
        .info-icon i {
            color: var(--primary-medium);
            font-size: 1.2rem;
        }
        
        .info-text h4 {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        
        .info-text p {
            color: var(--text-light);
        }
        
        .hours-list {
            list-style: none;
        }
        
        .hours-list li {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .hours-list li:last-child {
            border-bottom: none;
        }
        
        /* FAQ Section */
        .faq-section {
            padding: 80px 0;
            background-color: var(--light-bg);
        }
        
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .faq-item {
            background-color: var(--white);
            margin-bottom: 15px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.08);
            transition: all 0.3s ease;
        }
        
        .faq-question {
            padding: 25px 30px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .faq-question h3 {
            font-size: 1.2rem;
            color: var(--primary-dark);
            margin: 0;
        }
        
        .faq-question i {
            color: var(--primary-medium);
            transition: transform 0.3s;
        }
        
        .faq-answer {
            padding: 0 30px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }
        
        .faq-answer p {
            padding-bottom: 25px;
            color: var(--text-light);
        }
        
        .faq-item.active .faq-question {
            background-color: var(--light-bg);
        }
        
        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }
        
        .faq-item.active .faq-answer {
            max-height: 300px;
        }
        
        /* Map Section */
        .map-section {
            padding: 0 0 80px;
        }
        
        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 51, 102, 0.15);
            height: 400px;
        }
        
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
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
            .contact-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .contact-hero h1 {
                font-size: 2.5rem;
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
            
            .contact-hero {
                padding: 120px 0 40px;
            }
            
            .contact-hero h1 {
                font-size: 2rem;
            }
            
            .contact-form-container, .info-card {
                padding: 25px;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .footer-content {
                grid-template-columns: 1fr;
            }
            
            .contact-hero h1 {
                font-size: 1.8rem;
            }
            
            .contact-hero p {
                font-size: 1rem;
            }
            
            .info-item {
                flex-direction: column;
            }
            
            .info-icon {
                margin-bottom: 10px;
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
                    <li><a href="contact.php" class="active">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contact Hero -->
    <section class="contact-hero">
        <div class="container">
            <h1>Get In Touch With Us</h1>
            <p>We're here to answer your questions and help you with any inquiries about admissions, programs, or school activities.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="section-title">
                <h2>Contact Information</h2>
            </div>
            
            <div class="contact-content">
                <!-- Contact Form -->
                <div class="contact-form-container">
                    <h3>Send Us a Message</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <select id="subject" class="form-control" required>
                                <option value="">Select a subject</option>
                                <option value="admissions">Admissions Inquiry</option>
                                <option value="academics">Academic Programs</option>
                                <option value="tuition">Tuition and Fees</option>
                                <option value="tours">School Tours</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Your Message *</label>
                            <textarea id="message" class="form-control" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
                
                <!-- Contact Info -->
                <div class="contact-info">
                    <div class="info-card">
                        <h3>Contact Details</h3>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-text">
                                <h4>Our Address</h4>
                                <p>123 Education Avenue<br>Knowledge City, KC 10101</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-text">
                                <h4>Phone Number</h4>
                                <p>+1 (555) 123-4567</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-text">
                                <h4>Email Address</h4>
                                <p>info@ttschool.edu</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <h3>Office Hours</h3>
                        <ul class="hours-list">
                            <li><span>Monday - Friday</span><span>8:00 AM - 5:00 PM</span></li>
                            <li><span>Saturday</span><span>9:00 AM - 2:00 PM</span></li>
                            <li><span>Sunday</span><span>Closed</span></li>
                            <li><span>Holidays</span><span>Closed</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
            </div>
            
            <div class="faq-container">
                <div class="faq-item active">
                    <div class="faq-question">
                        <h3>What is the admission process at T&T School?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Our admission process includes submitting an application form, student transcripts, recommendation letters, and an entrance assessment. After reviewing the documents, we schedule an interview with the student and parents. Admissions are granted on a rolling basis, but we recommend applying at least 6 months before the desired start date.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What are the tuition fees and payment options?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Tuition fees vary by grade level and program. We offer several payment options including annual, semi-annual, and monthly payment plans. Financial aid and scholarships are available for qualifying students. Please contact our admissions office for specific fee structures and financial assistance options.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Do you offer transportation services?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, we provide safe and reliable transportation services covering most areas of the city. Our buses are equipped with GPS tracking, seat belts, and are operated by trained drivers and monitors. Transportation fees are separate from tuition and are based on distance and route.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What extracurricular activities are available?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We offer a wide range of extracurricular activities including sports teams, music programs, drama club, robotics, debate team, art classes, and various academic clubs. Activities vary by season and grade level. We believe in holistic development and encourage all students to participate in at least one extracurricular activity.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How do you support students with special needs?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Our school has a dedicated Learning Support Department with trained special education teachers. We provide individualized education plans (IEPs), accommodations, and support services for students with learning differences. We work closely with parents and specialists to ensure every student receives the support they need to succeed.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What safety measures are in place at the school?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Student safety is our top priority. Our campus features secure entry points with visitor management systems, CCTV surveillance, and trained security personnel. We conduct regular safety drills and have comprehensive emergency response protocols. All staff members undergo background checks and safety training.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <div class="section-title">
                <h2>Find Our Campus</h2>
            </div>
            
            <div class="map-container">
                <!-- Replace with your actual Google Maps embed code -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.177858804427!2d-73.98784468459418!3d40.70555167933207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a315cdf4c9b%3A0x8b934de5cae6f7a!2sEducation%20Ave%2C%20New%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1629990000000!5m2!1sen!2s" allowfullscreen="" loading="lazy"></iframe>
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
                    <a href="contact.html">Contact</a>
                    <a href="#admissions">Admissions</a>
                    <a href="#academics">Academics</a>
                    <a href="#programs">Programs</a>
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
        
        // FAQ Accordion
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            
            question.addEventListener('click', () => {
                // Close all other FAQ items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
            });
        });
        
        // Contact Form Submission
        const contactForm = document.getElementById('contactForm');
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            // Basic validation
            if (!name || !email || !subject || !message) {
                alert('Please fill in all required fields.');
                return;
            }
            
            // In a real application, you would send this data to a server
            // For now, we'll just show a success message
            alert('Thank you for your message, ' + name + '! We will get back to you soon at ' + email + '.');
            
            // Reset form
            contactForm.reset();
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
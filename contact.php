<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T&T School - Excellence in Education</title>
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
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--light-bg) 0%, #E3F2FD 100%);
            padding: 150px 0 100px;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(77, 143, 204, 0.1) 0%, rgba(30, 136, 229, 0.05) 100%);
            top: -100px;
            right: -100px;
        }
        
        .hero::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(0, 51, 102, 0.1) 0%, rgba(0, 80, 158, 0.05) 100%);
            bottom: -80px;
            left: -80px;
        }
        
        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }
        
        .hero-text {
            flex: 1;
            max-width: 600px;
        }
        
        .hero-text h2 {
            font-size: 3rem;
            line-height: 1.2;
            margin-bottom: 20px;
            color: var(--primary-dark);
        }
        
        .hero-text p {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 30px;
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
        
        .hero-image {
            flex: 1;
            text-align: center;
        }
        
        .hero-image img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 51, 102, 0.15);
        }
        
        /* About Section */
        .about {
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
        
        .about-content {
            display: flex;
            align-items: center;
            gap: 60px;
        }
        
        .about-text {
            flex: 1;
        }
        
        .about-text h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--primary-medium);
        }
        
        .about-text p {
            margin-bottom: 25px;
            color: var(--text-light);
        }
        
        .about-features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 30px;
        }
        
        .feature-item {
            display: flex;
            align-items: flex-start;
        }
        
        .feature-icon {
            width: 40px;
            height: 40px;
            background-color: var(--light-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .feature-icon i {
            color: var(--primary-medium);
            font-size: 1.2rem;
        }
        
        .about-image {
            flex: 1;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 51, 102, 0.1);
        }
        
        .about-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }
        
        .about-image img:hover {
            transform: scale(1.03);
        }
        
        /* Testimonials Section */
        .testimonials {
            padding: 100px 0;
            background-color: var(--light-bg);
        }
        
        .testimonial-slider {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .testimonial-item {
            background-color: var(--white);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 51, 102, 0.08);
            margin: 0 15px;
            position: relative;
        }
        
        .testimonial-item::before {
            content: "\201C";
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 4rem;
            color: var(--primary-light);
            opacity: 0.3;
            font-family: serif;
        }
        
        .testimonial-content {
            margin-bottom: 25px;
            font-size: 1.1rem;
            color: var(--text-light);
            font-style: italic;
            line-height: 1.8;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 3px solid var(--primary-light);
        }
        
        .author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .author-info h4 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .author-info p {
            color: var(--primary-medium);
            font-size: 0.9rem;
        }
        
        .testimonial-controls {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
        
        .testimonial-dots {
            display: flex;
        }
        
        .dot {
            width: 12px;
            height: 12px;
            background-color: #ccc;
            border-radius: 50%;
            margin: 0 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .dot.active {
            background-color: var(--primary-medium);
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
            .hero-content {
                flex-direction: column;
                text-align: center;
            }
            
            .hero-text {
                margin-bottom: 50px;
            }
            
            .hero-text h2 {
                font-size: 2.5rem;
            }
            
            .about-content {
                flex-direction: column;
            }
            
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
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
            
            .hero {
                padding: 120px 0 80px;
            }
            
            .hero-text h2 {
                font-size: 2rem;
            }
            
            .about-features {
                grid-template-columns: 1fr;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .footer-content {
                grid-template-columns: 1fr;
            }
            
            .testimonial-item {
                padding: 30px 20px;
            }
            
            .hero-text h2 {
                font-size: 1.8rem;
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

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h2>Shaping Future Leaders Through Quality Education</h2>
                    <p>At T&T School, we provide a nurturing environment that fosters intellectual curiosity, creativity, and character development for students of all ages.</p>
                    <a href="#admissions" class="btn">Enroll Now</a>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="T&T School Students">
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="section-title">
                <h2>About Our School</h2>
            </div>
            
            <div class="about-content">
                <div class="about-text">
                    <h3>Our Mission & Vision</h3>
                    <p>Founded in 1995, T&T School has been at the forefront of educational excellence for over 25 years. We believe in holistic development that balances academic rigor with creative expression and physical well-being.</p>
                    <p>Our experienced faculty and state-of-the-art facilities provide an environment where students can explore their potential and develop into well-rounded individuals ready to face the challenges of the future.</p>
                    
                    <div class="about-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <div>
                                <h4>Academic Excellence</h4>
                                <p>Consistently ranked among top schools in the region</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h4>Expert Faculty</h4>
                                <p>Highly qualified and dedicated teaching staff</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div>
                                <h4>Modern Facilities</h4>
                                <p>Well-equipped labs, libraries, and sports facilities</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div>
                                <h4>Inclusive Community</h4>
                                <p>Welcoming environment for students from all backgrounds</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="T&T School Campus">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>What Parents & Students Say</h2>
            </div>
            
            <div class="testimonial-slider">
                <div class="testimonial-item active">
                    <div class="testimonial-content">
                        <p>T&T School has provided an exceptional educational experience for my daughter. The teachers are dedicated, the curriculum is challenging yet engaging, and the school community is wonderfully supportive. I've seen remarkable growth in her confidence and academic abilities.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Sarah Johnson">
                        </div>
                        <div class="author-info">
                            <h4>Sarah Johnson</h4>
                            <p>Parent of Grade 8 Student</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-item">
                    <div class="testimonial-content">
                        <p>As a student at T&T School for the past 6 years, I can confidently say this institution has shaped me into who I am today. The opportunities for extracurricular activities alongside academic pursuits have helped me discover my passion for robotics and engineering.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen">
                        </div>
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <p>Grade 11 Student</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-item">
                    <div class="testimonial-content">
                        <p>The transition to T&T School was seamless for our family. The staff went above and beyond to ensure our son felt welcome and supported. His academic performance has improved significantly, and he's more excited about learning than ever before.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Priya Patel">
                        </div>
                        <div class="author-info">
                            <h4>Priya Patel</h4>
                            <p>Parent of Grade 5 Student</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-controls">
                    <div class="testimonial-dots">
                        <span class="dot active" data-slide="0"></span>
                        <span class="dot" data-slide="1"></span>
                        <span class="dot" data-slide="2"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
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
                    <a href="#home">Home</a>
                    <a href="#about">About Us</a>
                    <a href="#academics">Academics</a>
                    <a href="#admissions">Admissions</a>
                    <a href="#testimonials">Testimonials</a>
                    <a href="#contact">Contact</a>
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
        
        // Testimonial Slider
        const dots = document.querySelectorAll('.dot');
        const testimonials = document.querySelectorAll('.testimonial-item');
        
        // Function to show a specific testimonial
        function showTestimonial(index) {
            // Hide all testimonials
            testimonials.forEach(testimonial => {
                testimonial.style.display = 'none';
            });
            
            // Remove active class from all dots
            dots.forEach(dot => {
                dot.classList.remove('active');
            });
            
            // Show selected testimonial and activate its dot
            testimonials[index].style.display = 'block';
            dots[index].classList.add('active');
        }
        
        // Add click event to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showTestimonial(index);
            });
        });
        
        // Auto-rotate testimonials every 5 seconds
        let currentTestimonial = 0;
        function autoRotateTestimonials() {
            currentTestimonial = (currentTestimonial + 1) % testimonials.length;
            showTestimonial(currentTestimonial);
        }
        
        // Start auto rotation
        let testimonialInterval = setInterval(autoRotateTestimonials, 5000);
        
        // Pause auto rotation when user interacts with dots
        dots.forEach(dot => {
            dot.addEventListener('mouseenter', () => {
                clearInterval(testimonialInterval);
            });
            
            dot.addEventListener('mouseleave', () => {
                testimonialInterval = setInterval(autoRotateTestimonials, 5000);
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
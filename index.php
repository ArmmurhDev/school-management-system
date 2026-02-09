<?php
    $pageTitle = "T&T School - Excellence in Education";
    $activePage = "home";
    include 'include/header.php';
?>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h2>Shaping Future Leaders Through Quality Education</h2>
                    <p>At T&T School, we provide a nurturing environment that fosters intellectual curiosity, creativity, and character development for students of all ages.</p>
                    <a href="auth/login.php" class="btn">Enroll Now</a>
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

    <script>
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
    </script>

<?php include 'include/footer.php'; ?>
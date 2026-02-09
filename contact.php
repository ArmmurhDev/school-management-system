<?php
    $pageTitle = "T&T School - Contact Us";
    $activePage = "contact";
    include 'include/header.php';
?>

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

    <script>
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
    </script>

<?php include 'include/footer.php'; ?>
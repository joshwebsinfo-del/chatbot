<?php include 'includes/header.php'; ?>

    <!-- Contact Hero -->
    <div class="hero-header text-center position-relative d-flex align-items-center justify-content-center" style="margin-top: -80px; min-height: 40vh;">
        <div class="position-absolute w-100 h-100 bg-dark opacity-50 top-0 start-0"></div>
        <div class="container position-relative z-index-1 fade-up pt-5">
            <h1 class="display-4 fw-bold mb-3 text-white">Get in Touch</h1>
            <p class="lead text-white-50">We'd love to hear from you. Reach out to our administration office.</p>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mb-5 py-4">
        <div class="row shadow-lg rounded-4 overflow-hidden bg-white fade-up delay-1">
            
            <div class="col-lg-5 text-white p-5 d-flex flex-column justify-content-center position-relative" style="background: linear-gradient(135deg, var(--dark) 0%, var(--primary) 100%);">
                <div class="position-absolute w-100 h-100 top-0 start-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,1) 1px, transparent 0); background-size: 20px 20px;"></div>
                
                <div class="position-relative z-index-1">
                    <h3 class="fw-bold mb-4">Contact Information</h3>
                    <p class="text-white-50 mb-5 pb-4 border-bottom border-light border-opacity-10 lh-lg">Fill out the form and our team will get back to you within 24 hours.</p>

                    <div class="d-flex align-items-center mb-5 fade-up delay-2">
                        <div class="bg-white bg-opacity-10 text-white rounded-circle d-flex align-items-center justify-content-center border border-white border-opacity-25" style="width: 50px; height: 50px;">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-1 small text-white-50 text-uppercase tracking-wider">Call Us Directly</p>
                            <h6 class="mb-0 fw-bold fs-5">0789932832</h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-5 fade-up delay-3">
                        <div class="bg-white bg-opacity-10 text-white rounded-circle d-flex align-items-center justify-content-center border border-white border-opacity-25" style="width: 50px; height: 50px;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-1 small text-white-50 text-uppercase tracking-wider">Send an Email</p>
                            <h6 class="mb-0 fw-bold fs-5">info@eagles.edu</h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-5 fade-up delay-4">
                        <div class="bg-white bg-opacity-10 text-white rounded-circle d-flex align-items-center justify-content-center border border-white border-opacity-25" style="width: 50px; height: 50px;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-1 small text-white-50 text-uppercase tracking-wider">Visit Campus</p>
                            <h6 class="mb-0 fw-bold fs-5"><a href="https://maps.google.com/?q=Masasa+North,+Kwekwe,+Zimbabwe" target="_blank" class="text-white text-decoration-none hover-text-white transition-hover d-inline-block">Masasa North, Kwekwe <i class="fas fa-external-link-alt ms-1" style="font-size: 0.8rem;"></i></a></h6>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top border-light border-opacity-10 fade-up delay-5">
                        <p class="small text-white-50 text-uppercase tracking-wider mb-3">Connect With Us</p>
                        <div class="d-flex gap-3">
                            <a href="https://wa.me/263789932832" target="_blank" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center transition-hover" style="width: 45px; height: 45px; border-color: rgba(255,255,255,0.2);">
                                <i class="fab fa-whatsapp fs-5"></i>
                            </a>
                            <a href="https://facebook.com/eaglessecondary" target="_blank" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center transition-hover" style="width: 45px; height: 45px; border-color: rgba(255,255,255,0.2);">
                                <i class="fab fa-facebook-f fs-5"></i>
                            </a>
                            <a href="https://twitter.com/eaglessecondary" target="_blank" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center transition-hover" style="width: 45px; height: 45px; border-color: rgba(255,255,255,0.2);">
                                <i class="fab fa-twitter fs-5"></i>
                            </a>
                            <a href="https://instagram.com/eaglessecondary" target="_blank" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center transition-hover" style="width: 45px; height: 45px; border-color: rgba(255,255,255,0.2);">
                                <i class="fab fa-instagram fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 p-5 bg-white">
                <h3 class="fw-bold text-dark mb-4">Send us a Message</h3>
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Message feature is simulated.');">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label class="form-label text-muted small fw-bold text-uppercase">Full Name</label>
                            <input type="text" class="form-control bg-light border-0 py-3 rounded-3" placeholder="e.g. John Doe" required style="box-shadow: none;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold text-uppercase">Email Address</label>
                            <input type="email" class="form-control bg-light border-0 py-3 rounded-3" placeholder="e.g. john@example.com" required style="box-shadow: none;">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold text-uppercase">Subject / Inquiry Type</label>
                        <select class="form-select bg-light border-0 py-3 rounded-3 text-muted" style="box-shadow: none; cursor: pointer;">
                            <option>Admissions & Enrollment</option>
                            <option>Tuition & Fees</option>
                            <option>General Support</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="form-label text-muted small fw-bold text-uppercase">Your Message</label>
                        <textarea class="form-control bg-light border-0 py-3 rounded-3" rows="5" placeholder="How can we help you...?" required style="box-shadow: none; resize: none;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow w-100 fw-bold bg-gradient-primary border-0 transition-hover"><i class="fas fa-paper-plane me-2"></i> Send Message</button>
                    
                    <div class="text-center mt-4">
                        <p class="small text-muted mb-0">Need an answer right now? Try asking our <a href="#" class="text-primary fw-bold text-decoration-none border-bottom border-primary pb-1" onclick="openChat()">Virtual Assistant</a>.</p>
                    </div>
                </form>
            </div>
            
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

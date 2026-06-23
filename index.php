<?php include 'includes/header.php'; ?>

    <!-- Deep Hero Section -->
    <div class="position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--dark) 0%, var(--primary) 100%); min-height: 80vh; display: flex; align-items: center; margin-top: -80px; padding-top: 80px;">
        <!-- Background Pattern -->
        <div class="position-absolute w-100 h-100 opacity-25" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.2) 1px, transparent 0); background-size: 30px 30px;"></div>
        
        <div class="container position-relative z-index-1 my-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 pe-lg-5">
                    <div class="badge bg-white text-primary text-wrap mb-4 px-3 py-2 rounded-pill shadow-sm fade-up" style="letter-spacing: 1px;">
                        <i class="fas fa-star text-warning me-1"></i> Excellence in Education
                    </div>
                    <h1 class="display-3 fw-bold text-white mb-4 fade-up delay-1" style="line-height: 1.2;">Elevate Your Future with Eagles Secondary.</h1>
                    <p class="lead text-white-50 mb-5 fade-up delay-2" style="font-size: 1.2rem;">Soaring to excellence. Provide your child with the best education. Have questions? Our advanced AI assistant is here to help 24/7.</p>
                    <div class="d-flex flex-wrap gap-3 fade-up delay-3">
                        <button class="btn btn-light btn-lg px-4 py-3 rounded-pill fw-bold text-primary shadow-lg transition-hover d-flex align-items-center" onclick="openChat()">
                            Ask our Assistant <i class="fas fa-comment-dots ms-2 fs-5"></i>
                        </button>
                        <a href="admissions.php" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill fw-medium transition-hover">Apply Now</a>
                    </div>
                </div>
                <!-- 3D Flipping Premium Image Card (4 Images) -->
                <div class="col-lg-6 position-relative text-center d-none d-lg-block fade-up delay-4">
                    <div class="flipper-container">
                        <div class="flipper">
                            <!-- Front Face -->
                            <div class="flipper-face flipper-front">
                                <div class="w-100 h-100 position-relative img-slider-front">
                                    <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=2071&auto=format&fit=crop" class="flipper-img img-1 position-absolute top-0 start-0" alt="Students in Classroom">
                                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop" class="flipper-img img-3 position-absolute top-0 start-0" alt="Beautiful Architecture">
                                </div>
                                <!-- Glass Overlay -->
                                <div class="glass-card position-absolute p-3 rounded-4 text-start" style="bottom: 20px; left: 20px; right: 20px; z-index: 20;">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-graduation-cap text-primary fs-4 me-3"></i>
                                        <h5 class="fw-bold m-0 text-dark" style="font-size: 1.1rem;">Top Tier Results</h5>
                                    </div>
                                    <p class="small text-muted mb-0">Unmatched academic excellence and state-of-the-art facilities.</p>
                                </div>
                            </div>
                            <!-- Back Face -->
                            <div class="flipper-face flipper-back">
                                <div class="w-100 h-100 position-relative img-slider-back">
                                    <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc?q=80&w=2070&auto=format&fit=crop" class="flipper-img img-2 position-absolute top-0 start-0" alt="School Corridors">
                                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop" class="flipper-img img-4 position-absolute top-0 start-0" alt="Students Collaborating">
                                </div>
                                <!-- Glass Overlay -->
                                <div class="glass-card position-absolute p-3 rounded-4 text-start" style="bottom: 20px; left: 20px; right: 20px; z-index: 20;">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-atom text-success fs-4 me-3"></i>
                                        <h5 class="fw-bold m-0 text-dark" style="font-size: 1.1rem;">Global Community</h5>
                                    </div>
                                    <p class="small text-muted mb-0">Connecting diverse bright minds to shape the future.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Wave -->
        <svg class="position-absolute bottom-0 w-100" style="height: 60px;" preserveAspectRatio="none" viewBox="0 0 1440 74" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 24C320 -18 640 4 1440 74H0V24Z" fill="var(--light)"/>
        </svg>
    </div>

    <!-- Features Section -->
    <div class="container py-5 my-5">
        <div class="row text-center mb-5 fade-up">
            <div class="col-12">
                <h2 class="fw-bold text-dark mb-3">Why Choose Eagles?</h2>
                <p class="text-muted lead mx-auto" style="max-width: 600px;">Discover the benefits that make us the leading educational institution in the region.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 fade-up delay-1">
                <div class="card h-100 border-0 rounded-4 shadow-sm transition-hover p-4 bg-white text-center">
                    <div class="icon-glow bg-primary text-white rounded-4 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 70px; height: 70px;">
                        <i class="fas fa-laptop-code fs-2"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">Modern Facilities</h4>
                    <p class="text-muted">State-of-the-art computer labs, science centers, and sports complexes designed for holistic learning.</p>
                </div>
            </div>
            <div class="col-md-4 fade-up delay-2">
                <div class="card h-100 border-0 rounded-4 shadow-sm transition-hover p-4 bg-white text-center text-white" style="background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%) !important;">
                    <div class="bg-white text-primary rounded-4 d-inline-flex align-items-center justify-content-center mx-auto mb-4 shadow" style="width: 70px; height: 70px;">
                        <i class="fas fa-chalkboard-teacher fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Expert Faculty</h4>
                    <p class="text-white-50">Dedicated educators and mentors with decades of combined experience shaping tomorrow's leaders.</p>
                </div>
            </div>
            <div class="col-md-4 fade-up delay-3">
                <div class="card h-100 border-0 rounded-4 shadow-sm transition-hover p-4 bg-white text-center">
                    <div class="icon-glow bg-accent text-white rounded-4 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 70px; height: 70px; background-color: var(--accent);">
                        <i class="fas fa-robot fs-2"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">Smart Support</h4>
                    <p class="text-muted">Our AI-driven chatbot instantly answers parents' and students' queries anytime, ensuring seamless communication.</p>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

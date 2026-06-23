<?php include 'includes/header.php'; ?>

    <!-- Admissions Hero -->
    <div class="hero-header text-center position-relative d-flex align-items-center justify-content-center" style="margin-top: -80px; min-height: 40vh;">
        <div class="position-absolute w-100 h-100 bg-dark opacity-50 top-0 start-0"></div>
        <div class="container position-relative z-index-1 fade-up pt-5">
            <h1 class="display-4 fw-bold mb-3 text-white">Admissions Information</h1>
            <p class="lead text-white-50">Join the Eagles family. We are now accepting applications for the 2026-2027 academic year.</p>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mb-5 py-4">
        <div class="row g-5">
            <div class="col-lg-8 fade-up delay-1">
                <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                    <div class="card-body p-5">
                        <h3 class="fw-bold border-bottom pb-3 mb-4 text-dark" style="border-color: rgba(0,0,0,0.05) !important;">Admission Process</h3>
                        <p class="text-muted mb-5 lh-lg">We are thrilled you are considering Eagles Secondary School for your child's education. Follow these simple steps to enroll:</p>
                        
                        <div class="d-flex mb-5 position-relative">
                            <div class="position-absolute bg-primary opacity-25" style="width: 2px; height: 100%; top: 40px; left: 24px;"></div>
                            <div class="flex-shrink-0 position-relative z-index-1">
                                <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg icon-glow" style="width: 50px; height: 50px; font-size: 1.2rem; font-weight: bold;">1</div>
                            </div>
                            <div class="flex-grow-1 ms-4 mt-1">
                                <h5 class="fw-bold text-dark">Submit Application <span class="badge bg-success bg-opacity-10 text-success small ms-2 align-middle border border-success border-opacity-25 rounded-pill px-2 py-1">Open Now</span></h5>
                                <p class="text-muted lh-lg mt-2 mb-0">Download and fill out the Official Application Form. Submit it to the admissions office along with previous academic transcripts.</p>
                            </div>
                        </div>

                        <div class="d-flex mb-5 position-relative">
                            <div class="position-absolute bg-primary opacity-25" style="width: 2px; height: 100%; top: 40px; left: 24px;"></div>
                            <div class="flex-shrink-0 position-relative z-index-1">
                                <div class="bg-white text-primary border border-2 border-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; font-size: 1.2rem; font-weight: bold;">2</div>
                            </div>
                            <div class="flex-grow-1 ms-4 mt-1">
                                <h5 class="fw-bold text-dark">Entrance Examination</h5>
                                <p class="text-muted lh-lg mt-2 mb-0">All prospective students must sit for a Mathematics and English proficiency test to evaluate their academic standing.</p>
                            </div>
                        </div>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 position-relative z-index-1">
                                <div class="bg-white text-primary border border-2 border-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; font-size: 1.2rem; font-weight: bold;">3</div>
                            </div>
                            <div class="flex-grow-1 ms-4 mt-1">
                                <h5 class="fw-bold text-dark">Interview & Final Decision</h5>
                                <p class="text-muted lh-lg mt-2 mb-0">Successful applicants will be invited for a brief interview alongside their parents/guardians, followed by an official acceptance letter.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 bg-white mb-4 text-center transition-hover fade-up delay-2">
                    <div class="card-body p-5">
                        <div class="icon-glow bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 70px; height: 70px;">
                            <i class="fas fa-file-pdf fs-2"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Application Form</h5>
                        <p class="small text-muted mb-4 lh-lg">Download the 2026/2027 entry form.</p>
                        <a href="assets/docs/Admissions_Form.pdf" download class="btn btn-outline-danger w-100 rounded-pill fw-semibold py-2 d-flex align-items-center justify-content-center"><i class="fas fa-download me-2"></i> Download PDF</a>
                    </div>
                </div>

                <div class="card border-0 shadow-lg rounded-4 text-center text-white bg-gradient-primary transition-hover fade-up delay-3">
                    <div class="card-body p-5">
                        <div class="bg-white text-primary rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-4 shadow" style="width: 70px; height: 70px;">
                            <i class="fas fa-question-circle fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Got Questions?</h5>
                        <p class="small text-white-50 mb-4 lh-lg">Are you unsure about the fees or required documents?</p>
                        <button class="btn btn-light text-primary w-100 rounded-pill fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center transition-hover" onclick="openChat()"><i class="fas fa-comment-dots me-2"></i> Ask our Assistant</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

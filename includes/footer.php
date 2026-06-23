    <!-- Chatbot Widget -->
    <div id="chatbot-container" class="chatbot-container d-none">
        <div class="chatbot-header text-white">
            <div class="d-flex align-items-center">
                <div class="header-avatar bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 40px; height: 40px;">
                    <i class="fas fa-robot fs-5"></i>
                </div>
                <div>
                    <h5 class="m-0 fw-bold fs-6 tracking-wide">Eagles Assistant</h5>
                    <small class="text-white-50 d-flex align-items-center" style="font-size: 0.7rem;">
                        <span class="text-success me-1">●</span> Online & Ready
                    </small>
                </div>
            </div>
            <button id="close-chat" class="btn btn-sm text-white p-0 border-0 fs-4 hover-opacity-100" style="opacity: 0.7;"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="chatbot-body p-4" id="chatbot-body">
            <div class="text-center mb-4">
                <small class="text-muted bg-white px-3 py-1 rounded-pill shadow-sm border" style="font-size: 0.7rem;">Today</small>
            </div>
            
            <div class="bot-message d-flex align-items-end">
                <div class="bot-avatar"><i class="fas fa-robot"></i></div>
                <div class="message-content">
                    Hello! I'm the Eagles Secondary School Assistant. I can answer questions about admissions, fees, transport, uniforms, and more. How can I help you today? 👋
                </div>
            </div>
            
            <!-- Quick Action Buttons -->
            <div class="quick-replies d-flex flex-wrap gap-2 mb-3" style="padding-left: 45px;">
                <button class="btn btn-sm btn-outline-primary rounded-pill shadow-sm chat-quick-btn fw-bold bg-white" data-query="How do I apply?">📝 Apply Now</button>
                <button class="btn btn-sm btn-outline-primary rounded-pill shadow-sm chat-quick-btn fw-bold bg-white" data-query="What are the school fees?">💰 View Fees</button>
                <button class="btn btn-sm btn-outline-primary rounded-pill shadow-sm chat-quick-btn fw-bold bg-white" data-query="Where is the school located?">📍 Location</button>
            </div>
        </div>
        
        <div class="chatbot-footer chat-input-area">
            <form id="chat-form">
                <input type="text" id="user-input" class="form-control bg-white text-dark" placeholder="Type your message..." required autocomplete="off" style="border:1px solid rgba(0,0,0,0.15); background-color:#ffffff; color:#111;" />
                <button type="submit" class="btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Floating Chat Button -->
    <button id="chatbot-trigger" class="btn rounded-circle shadow-lg d-flex align-items-center justify-content-center position-fixed pulse-animation text-white border-0" style="width: 65px; height: 65px; bottom: 30px; right: 30px; z-index: 999; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
        <i class="fas fa-comment-dots fs-2"></i>
    </button>

    <footer class="text-light py-5 mt-5 bg-gradient-dark">
        <div class="container mt-4">
            <div class="row gx-5">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4 class="fw-bold mb-4 text-white"><i class="fas fa-graduation-cap me-2 text-primary"></i> Eagles Secondary</h4>
                    <p class="text-white-50 small pe-lg-4 lh-lg">Providing world-class education focused on academic excellence, character building, and holistic student development for over a decade. Experience the difference with our state-of-the-art facilities and dedicated faculty.</p>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-4 text-white">Quick Links</h5>
                    <ul class="list-unstyled text-white-50 small lh-lg">
                        <li class="mb-2"><a href="admissions.php" class="text-decoration-none text-white-50 hover-text-white transition-hover d-inline-block"><i class="fas fa-angle-right me-2 text-primary"></i> Admissions Info</a></li>
                        <li class="mb-2"><a href="academics.php" class="text-decoration-none text-white-50 hover-text-white transition-hover d-inline-block"><i class="fas fa-angle-right me-2 text-primary"></i> Academic Curriculum</a></li>
                        <li class="mb-2"><a href="contact.php" class="text-decoration-none text-white-50 hover-text-white transition-hover d-inline-block"><i class="fas fa-angle-right me-2 text-primary"></i> Contact Us</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-white-50 hover-text-white transition-hover d-inline-block"><i class="fas fa-angle-right me-2 text-primary"></i> Student Portal</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-4 text-white">Contact Us</h5>
                    <ul class="list-unstyled text-white-50 small lh-lg">
                        <li class="mb-3 d-flex align-items-start"><i class="fas fa-map-marker-alt mt-1 me-3 text-primary fs-5"></i> <span><a href="https://maps.google.com/?q=Masasa+North,+Kwekwe,+Zimbabwe" target="_blank" class="text-white-50 text-decoration-none hover-text-white transition-hover d-inline-block">Masasa North, Kwekwe<br>Zimbabwe <i class="fas fa-external-link-alt ms-1" style="font-size: 0.75rem;"></i></a></span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-phone-alt me-3 text-primary fs-5"></i> <span>0789932832</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-envelope me-3 text-primary fs-5"></i> <span>info@eagles.edu</span></li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary my-5 opacity-25">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-white-50 small">
                <p class="mb-2 mb-md-0">&copy; <?php echo date('Y'); ?> <span class="text-white fw-semibold">Eagles Secondary School</span>. All rights reserved.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white-50 hover-text-white"><i class="fab fa-facebook fs-5"></i></a>
                    <a href="#" class="text-white-50 hover-text-white"><i class="fab fa-twitter fs-5"></i></a>
                    <a href="#" class="text-white-50 hover-text-white"><i class="fab fa-instagram fs-5"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/script.js"></script>
    <style>
        .hover-text-white:hover { color: white !important; }
        .text-success.glow { text-shadow: 0 0 8px rgba(25, 135, 84, 0.8); }
    </style>
</body>
</html>

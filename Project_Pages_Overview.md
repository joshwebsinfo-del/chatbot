# Eagles Secondary School Chatbot - Pages Overview

This document provides a visual and technical overview of the primary pages in the Eagles Secondary School Chatbot application.

---

## 1. Home Page (`index.php`)
The entry point of the application, featuring a deep hero section and a floating chatbot button.

### Visual
![Home Page](file:///c:/Users/JOSHWEBS/Desktop/CHATBOT1/screenshots/index_page.png)

### Key Code Snippet
```php
<!-- Hero Section with AI Assistant Trigger -->
<div class="position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--dark) 0%, var(--primary) 100%); min-height: 80vh;">
    <h1 class="display-3 fw-bold text-white mb-4">Elevate Your Future with Eagles Secondary.</h1>
    <button class="btn btn-light btn-lg px-4 py-3 rounded-pill fw-bold text-primary shadow-lg" onclick="openChat()">
        Ask our Assistant <i class="fas fa-comment-dots ms-2 fs-5"></i>
    </button>
</div>
```

---

## 2. Academics Page (`academics.php`)
Displays the school's curriculum and co-curricular activities.

### Visual
![Academics Page](file:///c:/Users/JOSHWEBS/Desktop/CHATBOT1/screenshots/academics_page.png)

### Key Code Snippet
```php
<div class="row mt-5 g-4 text-start">
    <div class="col-md-3">
        <div class="card bg-white shadow-sm border-0 h-100 transition-hover rounded-4">
            <i class="fas fa-square-root-alt fs-1 text-primary mb-4 icon-glow"></i>
            <h5 class="fw-bold text-dark">Mathematics</h5>
            <p class="small text-muted mb-0 lh-lg">Advanced Calculus, Geometry, Algebra, and Statistics.</p>
        </div>
    </div>
    <!-- ... Other subjects ... -->
</div>
```

---

## 3. Admissions Page (`admissions.php`)
Provides information on the enrollment process and downloadable forms.

### Visual
![Admissions Page](file:///c:/Users/JOSHWEBS/Desktop/CHATBOT1/screenshots/admissions_page.png)

### Key Code Snippet
```php
<div class="d-flex mb-5 position-relative">
    <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px;">1</div>
    <div class="flex-grow-1 ms-4 mt-1">
        <h5 class="fw-bold text-dark">Submit Application</h5>
        <p class="text-muted lh-lg mt-2 mb-0">Download and fill out the Official Application Form. Submit it to the admissions office.</p>
    </div>
</div>
```

---

## 4. Contact Page (`contact.php`)
Allows users to send messages and find campus contact details.

### Visual
![Contact Page](file:///c:/Users/JOSHWEBS/Desktop/CHATBOT1/screenshots/contact_page.png)

### Key Code Snippet
```php
<form action="#" method="POST" onsubmit="event.preventDefault(); alert('Message feature is simulated.');">
    <input type="text" class="form-control bg-light border-0 py-3 rounded-3" placeholder="Full Name" required>
    <input type="email" class="form-control bg-light border-0 py-3 rounded-3" placeholder="Email Address" required>
    <textarea class="form-control bg-light border-0 py-3 rounded-3" rows="5" placeholder="How can we help you...?" required></textarea>
    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow w-100 fw-bold">Send Message</button>
</form>
```

---

## 5. Admin Login (`admin/login.php`)
Secure access portal for administrators.

### Visual
![Admin Login](file:///c:/Users/JOSHWEBS/Desktop/CHATBOT1/screenshots/admin_login_page.png)

### Key Code Snippet
```php
<form action="login_process.php" method="POST">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Access Dashboard</button>
</form>
```

---

## 6. Admin Dashboard (`admin/dashboard.php`)
Core management interface for the chatbot knowledge base and lead tracking.

### Visual
![Admin Dashboard](file:///c:/Users/JOSHWEBS/Desktop/CHATBOT1/screenshots/admin_dashboard_page.png)

### Key Code Snippet
```php
<!-- FAQ List Table -->
<table class="table table-hover align-middle mb-0 border-0">
    <thead>
        <tr>
            <th>Trigger Phrase (User)</th>
            <th>Bot Response</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $faqs_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['question']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['answer'])); ?></td>
                <td>
                    <!-- Edit/Delete Actions -->
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
```

---

## 7. Chatbot Interface
The interactive virtual assistant that handles user queries, lead generation, and automated responses.

### Visual
![Chatbot Interface](file:///c:/Users/JOSHWEBS/Desktop/CHATBOT1/screenshots/chatbot_interface.png)

### Key Code Snippets

#### Frontend UI (HTML/CSS)
```html
<div id="chatbot-container" class="chatbot-container">
    <div class="chatbot-header">
        <h5 class="m-0 fw-bold">Eagles Assistant</h5>
        <small class="text-success">● Online & Ready</small>
    </div>
    <div class="chatbot-body" id="chatbot-body">
        <!-- Messages appear here -->
    </div>
    <div class="chatbot-footer">
        <form id="chat-form">
            <input type="text" id="user-input" placeholder="Type your message...">
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>
</div>
```

#### Backend Logic (PHP)
```php
// Intent Interception & Database Lookup
if (strpos($lower_q, 'apply') !== false || strpos($lower_q, 'enroll') !== false) {
    $_SESSION['awaiting_name'] = true;
    echo "Let's start your application. Could you please type your full legal name?";
    exit;
}

// Predictive NLP Algorithm (Fuzzy Search)
$stmt = $conn->prepare("SELECT answer FROM faq WHERE ? LIKE CONCAT('%', question, '%') LIMIT 1");
$stmt->bind_param("s", $user_question);
$stmt->execute();
// ... returns matched answer ...
```

---
*Generated by Antigravity AI*


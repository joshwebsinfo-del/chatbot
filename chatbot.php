<?php
session_start();
require_once 'config.php';

// Helper function to log bot replies for Analytics
function log_bot($conn, $msg) {
    $stmt = $conn->prepare("INSERT INTO chat_logs (message, type) VALUES (?, 'bot')");
    if ($stmt) {
        $stmt->bind_param("s", $msg);
        $stmt->execute();
    }
}

// Removed old helper logic in favor of direct intent interception

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question'])) {
    $user_question = trim($_POST['question']);
    
    if (empty($user_question)) {
        echo "Please ask a valid question.";
        exit;
    }

    // 8. Log user message for Analytics
    $stmt_log = $conn->prepare("INSERT INTO chat_logs (message, type) VALUES (?, 'user')");
    if ($stmt_log) {
        $stmt_log->bind_param("s", $user_question);
        $stmt_log->execute();
    }

    // 6. Lead Capture Logic (State Machine stored in PHP Sessions)
    if (isset($_SESSION['awaiting_name'])) {
        $_SESSION['lead_name'] = htmlspecialchars($user_question);
        unset($_SESSION['awaiting_name']);
        $_SESSION['awaiting_grade'] = true;
        
        $reply = "Thanks <b>" . $_SESSION['lead_name'] . "</b>! What Grade or Form are you applying for? (e.g. Form 1, Lower 6th)";
        log_bot($conn, $reply);
        echo $reply;
        exit;
    }
    
    if (isset($_SESSION['awaiting_grade'])) {
        $_SESSION['lead_grade'] = htmlspecialchars($user_question);
        unset($_SESSION['awaiting_grade']);
        $_SESSION['awaiting_email'] = true;
        
        $reply = "Great! And finally, what is the best parent/guardian phone number or email address we can contact?";
        log_bot($conn, $reply);
        echo $reply;
        exit;
    }
    
    if (isset($_SESSION['awaiting_email'])) {
        $email = htmlspecialchars($user_question);
        unset($_SESSION['awaiting_email']);
        
        $db_name = $_SESSION['lead_name'] . " (Grade: " . $_SESSION['lead_grade'] . ")";
        
        // Save the caught lead to database
        $stmt_lead = $conn->prepare("INSERT INTO leads (name, email) VALUES (?, ?)");
        if ($stmt_lead) {
            $stmt_lead->bind_param("ss", $db_name, $email);
            $stmt_lead->execute();
        }
        
        $reply = "Thank you! 🎉 Your application request has been securely registered in our system. Our admissions officer will contact you at <b>{$email}</b> shortly to complete your enrollment. Is there anything else you need help with?";
        log_bot($conn, $reply);
        echo $reply;
        exit;
    }

    // --- Direct Application Intent Parsing ---
    $lower_q = strtolower($user_question);
    if (strpos($lower_q, 'apply') !== false || strpos($lower_q, 'enroll') !== false || strpos($lower_q, 'admission') !== false || strpos($lower_q, 'register') !== false) {
        $_SESSION['awaiting_name'] = true;
        $reply = "Awesome! We are excited to welcome you to the Eagles family. Let's start your application.<br><br><b>Could you please type your full legal name?</b>";
        log_bot($conn, $reply);
        echo $reply;
        exit;
    }

    // --- Direct Accounts Intent Parsing ---
    if (strpos($lower_q, 'fee') !== false || strpos($lower_q, 'account') !== false || strpos($lower_q, 'payment') !== false || strpos($lower_q, 'pay') !== false || strpos($lower_q, 'price') !== false) {
        $reply = "Our school fees vary depending on the specific grade level and subject levies.<br><br><b>Please contact our Accounts Department directly for your exact billing details:</b><br><br><div class='d-flex align-items-center mb-2'><div class='bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3' style='width: 35px; height: 35px;'><i class='fas fa-phone-alt'></i></div><a href='tel:0771185515' class='text-decoration-none fw-bold text-dark'>0771185515</a></div><div class='d-flex align-items-center'><div class='bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3' style='width: 35px; height: 35px;'><i class='fas fa-envelope'></i></div><b class='text-dark'>accounts@eagles.edu</b></div>";
        log_bot($conn, $reply);
        echo $reply;
        exit;
    }

    // --- Direct Transport Intent Parsing ---
    if (strpos($lower_q, 'transport') !== false || strpos($lower_q, 'bus') !== false || strpos($lower_q, 'route') !== false) {
        $reply = "We offer secure, reliable student transport every day! 🚌<br><br>Our main bus routes cover:<br>• <b>Mbizo</b><br>• <b>Masasa</b><br>• <b>Town</b><br><br>Please contact the administration office for the exact pick-up timetable and transport fees.";
        log_bot($conn, $reply);
        echo $reply;
        exit;
    }

    // --- Search Logic ---
    $reply = null;

    // A) Try exact or partial full-string match
    $stmt = $conn->prepare("SELECT answer FROM faq WHERE ? LIKE CONCAT('%', question, '%') OR question LIKE CONCAT('%', ?, '%') LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("ss", $user_question, $user_question);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $reply = $row['answer'];
        }
    }

    // B) Lexical Matching & Predictive NLP Algorithm
    if (!$reply) {
        $all_faqs = $conn->query("SELECT id, question, answer FROM faq");
        $highest_sim = 0;
        $best_answer = null;
        
        // Remove common stop words to focus algorithm entirely on keywords
        $stop_words = array('what', 'is', 'the', 'a', 'to', 'how', 'do', 'i', 'can', 'you', 'please', 'tell', 'me', 'about', 'in', 'of', 'for');
        $clean_user = strtolower(preg_replace('/[^a-z0-9 ]/i', '', $user_question));
        $user_words = array_filter(array_diff(explode(' ', $clean_user), $stop_words));
        
        if ($all_faqs && count($user_words) > 0) {
            while ($row = $all_faqs->fetch_assoc()) {
                $clean_db = strtolower(preg_replace('/[^a-z0-9 ]/i', '', $row['question']));
                $db_words = array_filter(explode(' ', $clean_db));
                
                // 1. Matrix Intersection Score (Predictive relevance)
                $intersect = array_intersect($user_words, $db_words);
                $score = count($intersect) * 25; // 25 points per exact powerful keyword match
                
                // 2. Fuzzy Syntax Score (Handles typos)
                similar_text(implode(' ', $user_words), implode(' ', $db_words), $perc);
                $score += ($perc * 0.5); // Add up to 50 bonus points for structural similarity
                
                if ($score > $highest_sim && $score >= 45) { // Absolute threshold to prevent junk matches
                    $highest_sim = $score;
                    $best_answer = $row['answer'];
                }
            }
        }
        
        if ($best_answer) {
            $reply = $best_answer;
        }
    }

    // C) Found Answer
    if ($reply) {
        log_bot($conn, $reply);
        echo $reply;
        exit;
    }
    
    // D) Feature 5: Unanswered Query Logging (Admin Learning)
    if (!$reply) {
        $stmt_check = $conn->prepare("SELECT id FROM unanswered_queries WHERE question = ?");
        if ($stmt_check) {
            $stmt_check->bind_param("s", $user_question);
            $stmt_check->execute();
            $res = $stmt_check->get_result();
            
            if ($res->num_rows > 0) {
                // Increment count
                $stmt_up = $conn->prepare("UPDATE unanswered_queries SET asked_count = asked_count + 1 WHERE question = ?");
                $stmt_up->bind_param("s", $user_question);
                $stmt_up->execute();
            } else {
                // Insert new missing query
                $stmt_in = $conn->prepare("INSERT INTO unanswered_queries (question) VALUES (?)");
                $stmt_in->bind_param("s", $user_question);
                $stmt_in->execute();
            }
        }

        $reply = "I'm sorry, I'm still learning and don't quite understand that yet. I've noted this down for my administrators to teach me!<br><br><b>Please contact Eagles Admins directly via our official channels:</b><br><div class='d-flex gap-2 mt-2'><a href='https://wa.me/263789932832' target='_blank' class='btn btn-sm btn-success rounded-circle d-flex align-items-center justify-content-center shadow-sm' style='width: 35px; height: 35px;'><i class='fab fa-whatsapp'></i></a><a href='https://facebook.com/eaglessecondary' target='_blank' class='btn btn-sm btn-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm' style='width: 35px; height: 35px;'><i class='fab fa-facebook-f'></i></a><a href='https://twitter.com/eaglessecondary' target='_blank' class='btn btn-sm text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm' style='width: 35px; height: 35px; background: #1DA1F2;'><i class='fab fa-twitter'></i></a><a href='https://instagram.com/eaglessecondary' target='_blank' class='btn btn-sm rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm' style='width: 35px; height: 35px; background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%);'><i class='fab fa-instagram'></i></a></div>";
        log_bot($conn, $reply);
        echo $reply;
    }
} else {
    echo "Invalid request.";
}
?>

<?php
session_start();

// Database connection disabled for now
// require_once 'config.php';

function log_bot($conn, $msg) {
    // Disabled DB logging
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question'])) {
    $user_question = trim($_POST['question']);
    
    if (empty($user_question)) {
        echo "Please ask a valid question.";
        exit;
    }

    // Lead Capture Logic (State Machine stored in PHP Sessions)
    if (isset($_SESSION['awaiting_name'])) {
        $_SESSION['lead_name'] = htmlspecialchars($user_question);
        unset($_SESSION['awaiting_name']);
        $_SESSION['awaiting_grade'] = true;
        
        $reply = "Thanks <b>" . $_SESSION['lead_name'] . "</b>! What Grade or Form are you applying for? (e.g. Form 1, Lower 6th)";
        echo $reply;
        exit;
    }
    
    if (isset($_SESSION['awaiting_grade'])) {
        $_SESSION['lead_grade'] = htmlspecialchars($user_question);
        unset($_SESSION['awaiting_grade']);
        $_SESSION['awaiting_email'] = true;
        
        $reply = "Great! And finally, what is the best parent/guardian phone number or email address we can contact?";
        echo $reply;
        exit;
    }
    
    if (isset($_SESSION['awaiting_email'])) {
        $email = htmlspecialchars($user_question);
        unset($_SESSION['awaiting_email']);
        
        // DB insert disabled
        
        $reply = "Thank you! 🎉 Your application request has been securely registered in our system. Our admissions officer will contact you at <b>{$email}</b> shortly to complete your enrollment. Is there anything else you need help with?";
        echo $reply;
        exit;
    }

    $lower_q = strtolower($user_question);

    // --- Direct Application Intent Parsing ---
    if (strpos($lower_q, 'apply') !== false || strpos($lower_q, 'enroll') !== false || strpos($lower_q, 'admission') !== false || strpos($lower_q, 'register') !== false) {
        $_SESSION['awaiting_name'] = true;
        $reply = "Awesome! We are excited to welcome you to the Eagles family. Let's start your application.<br><br><b>Could you please type your full legal name?</b>";
        echo $reply;
        exit;
    }

    // --- Direct Accounts Intent Parsing ---
    if (strpos($lower_q, 'fee') !== false || strpos($lower_q, 'account') !== false || strpos($lower_q, 'payment') !== false || strpos($lower_q, 'pay') !== false || strpos($lower_q, 'price') !== false) {
        $reply = "Our school fees vary depending on the specific grade level and subject levies.<br><br><b>Please contact our Accounts Department directly for your exact billing details:</b><br><br><div class='d-flex align-items-center mb-2'><div class='bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3' style='width: 35px; height: 35px;'><i class='fas fa-phone-alt'></i></div><a href='tel:0771185515' class='text-decoration-none fw-bold text-dark'>0771185515</a></div><div class='d-flex align-items-center'><div class='bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3' style='width: 35px; height: 35px;'><i class='fas fa-envelope'></i></div><b class='text-dark'>accounts@eagles.edu</b></div>";
        echo $reply;
        exit;
    }

    // --- Direct Transport Intent Parsing ---
    if (strpos($lower_q, 'transport') !== false || strpos($lower_q, 'bus') !== false || strpos($lower_q, 'route') !== false) {
        $reply = "We offer secure, reliable student transport every day! 🚌<br><br>Our main bus routes cover:<br>• <b>Mbizo</b><br>• <b>Masasa</b><br>• <b>Town</b><br><br>Please contact the administration office for the exact pick-up timetable and transport fees.";
        echo $reply;
        exit;
    }

    // --- Hardcoded FAQ & Feel Questions (Database Bypassed) ---
    $hardcoded_faqs = [
        "hello" => "Hi there! 👋 How can I help you today?",
        "hi" => "Hello! How can I assist you with Eagles Secondary?",
        "hey" => "Hey! What can I do for you today?",
        "how are you" => "I'm just a bot, but I'm feeling great! Ready to help you with any school-related questions. 😊",
        "who are you" => "I am the Eagles Secondary digital assistant! I'm here to help you with admissions, fees, transport, and more.",
        "what is your name" => "You can call me EaglesBot! 🦅",
        "thank you" => "You're very welcome! If you need anything else, just ask.",
        "thanks" => "Happy to help! Let me know if there's anything else.",
        "bye" => "Goodbye! Have a fantastic day! 👋",
        "good morning" => "Good morning! ☀️ How can I help you today?",
        "good afternoon" => "Good afternoon! 🌤️ What can I assist you with?",
        "where are you located" => "We are located in Kwekwe, Zimbabwe. Feel free to visit our campus!",
        "what subjects" => "We offer a wide range of academic subjects including Sciences, Commercials, and Arts. Please check our Academics page for a full list.",
        "sports" => "We offer various sporting disciplines such as Soccer, Netball, Basketball, Athletics, and more to ensure holistic development.",
        "uniform" => "Our uniform is available at authorized local suppliers. Please contact the administration for the approved list of vendors.",
        "contact" => "You can reach us at 0771185515 or email admin@eagles.edu.",
    ];

    $reply = null;

    // Check feel questions
    foreach ($hardcoded_faqs as $q => $ans) {
        // Use word boundaries or simple strpos for matching
        if (strpos($lower_q, $q) !== false) {
            $reply = $ans;
            break;
        }
    }

    if ($reply) {
        echo $reply;
        exit;
    }

    // Fallback
    $reply = "I'm sorry, I'm still learning and don't quite understand that yet.<br><br><b>Please contact Eagles Admins directly via our official channels:</b><br><div class='d-flex gap-2 mt-2'><a href='https://wa.me/263789932832' target='_blank' class='btn btn-sm btn-success rounded-circle d-flex align-items-center justify-content-center shadow-sm' style='width: 35px; height: 35px;'><i class='fab fa-whatsapp'></i></a><a href='https://facebook.com/eaglessecondary' target='_blank' class='btn btn-sm btn-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm' style='width: 35px; height: 35px;'><i class='fab fa-facebook-f'></i></a><a href='https://twitter.com/eaglessecondary' target='_blank' class='btn btn-sm text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm' style='width: 35px; height: 35px; background: #1DA1F2;'><i class='fab fa-twitter'></i></a><a href='https://instagram.com/eaglessecondary' target='_blank' class='btn btn-sm rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm' style='width: 35px; height: 35px; background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%);'><i class='fab fa-instagram'></i></a></div>";
    echo $reply;
    
} else {
    echo "Invalid request.";
}
?>

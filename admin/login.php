<?php
session_start();
// require_once '../config.php';

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (!empty($username) && !empty($password)) {
        if ($username === 'admin' && $password === 'password') {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = 1;
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid username or password';
        }
    } else {
        $error = 'Please fill all fields';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Eagles Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-decoration-none d-flex align-items-center" href="../index.php">
                <i class="fas fa-arrow-left me-2"></i><span>Back to Site</span>
            </a>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header text-white text-center py-4 border-0" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                        <div class="bg-white text-primary rounded-circle d-inline-flex justify-content-center align-items-center mb-3 shadow" style="width: 70px; height: 70px;">
                            <i class="fas fa-user-shield fs-2"></i>
                        </div>
                        <h4 class="mb-0 fw-bold">Admin Portal</h4>
                        <p class="text-white-50 small mb-0">Eagles Secondary School</p>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <?php if ($error): ?>
                            <div class="alert alert-danger py-2 border-0 shadow-sm d-flex align-items-center text-sm">
                                <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" name="username" class="form-control bg-light border-start-0 py-2 ps-0" placeholder="admin" required autofocus>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted small">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" name="password" class="form-control bg-light border-start-0 py-2 ps-0" placeholder="••••••••" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm rounded-3">Access Dashboard</button>
                        </form>
                        <div class="mt-4 text-center">
                            <hr class="text-muted opacity-25">
                            <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Testing demo: admin / password</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

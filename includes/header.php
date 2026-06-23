<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Eagles Secondary School - Excellence in Education. Holistic student development and world-class academic curriculum.">
    <meta name="theme-color" content="#4f46e5">
    <title>Eagles Secondary School</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-header {
            background: linear-gradient(rgba(15, 23, 42, 0.7), rgba(79, 70, 229, 0.7)), url('https://images.unsplash.com/photo-1523050853063-bd8012fec046?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 120px 0;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <?php 
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <!-- Glassmorphic Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark glass-nav sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div class="bg-white rounded p-1 me-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                    <i class="fas fa-graduation-cap text-primary fs-4"></i>
                </div>
                <span class="fs-4 fw-bold">Eagles Secondary</span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link fw-medium <?php echo ($current_page == 'index.php') ? 'active text-white' : ''; ?>" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium <?php echo ($current_page == 'admissions.php') ? 'active text-white' : ''; ?>" href="admissions.php">Admissions</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium <?php echo ($current_page == 'academics.php') ? 'active text-white' : ''; ?>" href="academics.php">Academics</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium <?php echo ($current_page == 'contact.php') ? 'active text-white' : ''; ?>" href="contact.php">Contact</a></li>
                    <li class="nav-item ms-lg-4 mt-3 mt-lg-0">
                        <a class="btn btn-light text-primary px-4 py-2 fw-semibold rounded-pill shadow-sm transition-hover d-flex align-items-center w-100" href="admin/login.php">
                            <i class="fas fa-lock me-2 fs-6"></i> Admin Portal
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<?php
session_start();
require_once '../config.php';

// Check auth
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$message = '';

// Handle Add FAQ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $question = trim($_POST['question']);
    $answer = trim($_POST['answer']);
    
    if (!empty($question) && !empty($answer)) {
        $stmt = $conn->prepare("INSERT INTO faq (question, answer) VALUES (?, ?)");
        $stmt->bind_param("ss", $question, $answer);
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success alert-dismissible fade show shadow-sm text-sm border-0 mt-3'><i class='fas fa-check-circle me-2'></i> FAQ added successfully.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
        } else {
            $message = "<div class='alert alert-danger mt-3'><i class='fas fa-exclamation-triangle me-2'></i> Error adding FAQ.</div>";
        }
    }
}

// Handle Edit FAQ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $question = trim($_POST['question']);
    $answer = trim($_POST['answer']);
    
    if (!empty($id) && !empty($question) && !empty($answer)) {
        $stmt = $conn->prepare("UPDATE faq SET question = ?, answer = ? WHERE id = ?");
        $stmt->bind_param("ssi", $question, $answer, $id);
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success alert-dismissible fade show shadow-sm text-sm border-0 mt-3'><i class='fas fa-check-circle me-2'></i> FAQ updated successfully.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
        } else {
            $message = "<div class='alert alert-danger mt-3'>Error updating FAQ.</div>";
        }
    }
}

// Handle Delete FAQ
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM faq WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $message = "<div class='alert alert-success alert-dismissible fade show shadow-sm text-sm border-0 mt-3'><i class='fas fa-check-circle me-2'></i> FAQ deleted successfully.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}

// Fetch all FAQs
$faqs_result = $conn->query("SELECT * FROM faq ORDER BY id DESC");
$total_faqs = $faqs_result->num_rows;

// Premium Features Data Fetch
$unanswered = [];
$leads = [];
$total_messages = 0;

$check = $conn->query("SHOW TABLES LIKE 'unanswered_queries'");
$has_premium = ($check && $check->num_rows > 0);

if ($has_premium) {
    // Delete Unanswered
    if (isset($_GET['del_un'])) {
        $id = $_GET['del_un'];
        $stmt = $conn->prepare("DELETE FROM unanswered_queries WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: dashboard.php");
        exit;
    }
    
    $u_res = $conn->query("SELECT * FROM unanswered_queries ORDER BY asked_count DESC");
    if($u_res) while($r = $u_res->fetch_assoc()) $unanswered[] = $r;
    
    $l_res = $conn->query("SELECT * FROM leads ORDER BY id DESC");
    if($l_res) while($r = $l_res->fetch_assoc()) $leads[] = $r;
    
    $m_res = $conn->query("SELECT COUNT(*) as c FROM chat_logs");
    if ($m_res) {
        $m_row = $m_res->fetch_assoc();
        $total_messages = $m_row['c'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Eagles Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', system-ui, sans-serif; }
        .sidebar { min-height: calc(100vh - 66px); }
        .table-hover tbody tr:hover { background-color: #f1f5f9; }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom border-primary" style="background: #1a1e23; border-width: 4px !important;">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="bg-primary text-white rounded p-2 me-2 shadow-sm">
                    <i class="fas fa-robot fs-5"></i>
                </div>
                <span class="fw-bold tracking-wide">EaglesBot Admin</span>
            </a>
            <div class="d-flex align-items-center">
                <div class="badge bg-success-subtle text-success border border-success me-3 px-3 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-circle me-1" style="font-size: 8px;"></i> System Online
                </div>
                <!-- Profile Dropdown -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=0d6efd&color=fff" alt="mdo" width="35" height="35" class="rounded-circle shadow-sm">
                        <span class="d-none d-sm-inline mx-2 fw-semibold">Administrator</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2 rounded-3 text-small" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="../index.php" target="_blank"><i class="fas fa-external-link-alt text-muted me-2"></i>View Portal</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger fw-semibold" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-xl-2 bg-white sidebar py-4 border-end shadow-sm d-none d-md-block px-3">
                <p class="text-uppercase text-muted fw-bold mb-3 px-3 fs-7" style="letter-spacing: 1px; font-size: 0.75rem;">Main Navigation</p>
                <ul class="nav flex-column gap-1">
                    <li class="nav-item">
                        <a class="nav-link active bg-primary text-white rounded-3 px-3 py-2 fw-medium shadow-sm" href="dashboard.php">
                            <i class="fas fa-layer-group me-2"></i> Knowledge Base
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary rounded-3 px-3 py-2 hover-bg-light transition-all" href="../index.php" target="_blank">
                            <i class="fas fa-globe me-2"></i> Public View
                        </a>
                    </li>
                </ul>
                
                <div class="mt-auto pt-5 mt-5">
                    <div class="bg-light rounded-3 p-3 border">
                        <p class="mb-1 fw-semibold text-dark fs-6"><i class="fas fa-chart-pie me-2 text-primary"></i>Stats</p>
                        <hr class="my-2 border-secondary opacity-25">
                        <p class="mb-0 small text-muted d-flex justify-content-between">
                            Active FAQs <span class="badge bg-primary rounded-pill"><?php echo $total_faqs; ?></span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-xl-10 py-5 px-md-5 bg-light" style="min-height: 100vh;">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
                    <div>
                        <h2 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">FAQ Management Dashboard</h2>
                        <p class="text-muted mb-0">Add, edit, or remove knowledge base items to train the assistant.</p>
                    </div>
                    <button class="btn btn-primary shadow rounded-pill px-4 py-3 mt-3 mt-md-0 fw-bold d-flex align-items-center transition-hover" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus-circle me-2 fs-5"></i> Create New Entry
                    </button>
                </div>

                <?php echo $message; ?>

                <ul class="nav nav-pills mt-4 mb-4" id="dashboardTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold px-4 rounded-pill me-2" id="kb-tab" data-bs-toggle="pill" data-bs-target="#kb" type="button" role="tab">📚 Knowledge Base</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold px-4 rounded-pill me-2" id="unanswered-tab" data-bs-toggle="pill" data-bs-target="#unanswered" type="button" role="tab">
                            ❓ Unanswered Queries
                            <?php if(count($unanswered)>0): ?><span class="badge bg-danger ms-1"><?php echo count($unanswered); ?></span><?php endif; ?>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold px-4 rounded-pill me-2" id="leads-tab" data-bs-toggle="pill" data-bs-target="#leads" type="button" role="tab">
                            👥 Admission Leads
                            <?php if(count($leads)>0): ?><span class="badge bg-primary ms-1"><?php echo count($leads); ?></span><?php endif; ?>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold px-4 rounded-pill" id="analytics-tab" data-bs-toggle="pill" data-bs-target="#analytics" type="button" role="tab">📈 Analytics Dashboard</button>
                    </li>
                </ul>

                <div class="tab-content" id="dashboardTabsContent">
                    <!-- Knowledge Base Tab -->
                    <div class="tab-pane fade show active" id="kb" role="tabpanel">
                        <div class="card shadow border-0 rounded-4 overflow-hidden">
                            <div class="card-header bg-white py-4 border-bottom d-flex align-items-center justify-content-between px-4">
                                <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                    <i class="fas fa-brain text-primary me-3 fs-4 p-2 bg-primary bg-opacity-10 rounded-circle"></i> 
                                    Knowledge Base Entities
                                </h5>
                                <div class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill fw-bold">
                                    <?php echo $total_faqs; ?> Active Item(s)
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0 border-0">
                                        <thead class="bg-light text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">
                                            <tr>
                                                <th class="px-5 py-4 border-0" width="8%">ID</th>
                                                <th class="py-4 border-0" width="35%">Trigger Phrase (User)</th>
                                                <th class="py-4 border-0" width="42%">Bot Response</th>
                                                <th class="text-center py-4 border-0" width="15%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($total_faqs > 0): ?>
                                                <?php while($row = $faqs_result->fetch_assoc()): ?>
                                                    <tr>
                                                        <td class="px-4 fw-bold text-muted"> <span class="bg-light px-2 py-1 rounded border">#<?php echo $row['id']; ?></span> </td>
                                                        <td class="text-dark fw-medium lh-sm" style="font-size: 0.95rem;">
                                                            <i class="fas fa-comment-dots text-primary opacity-50 me-2 mt-1 float-start"></i> 
                                                            <?php echo htmlspecialchars($row['question']); ?>
                                                        </td>
                                                        <td class="text-muted lh-sm" style="font-size: 0.9rem;">
                                                            <i class="fas fa-reply text-success opacity-50 me-2 mt-1 float-start"></i>  
                                                            <?php echo nl2br(htmlspecialchars($row['answer'])); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group shadow-sm rounded-3">
                                                                <button class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>" title="Edit"><i class="fas fa-edit"></i></button>
                                                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-light border text-danger" onclick="return confirm('WARNING: Are you sure you want to delete this FAQ entry permanently?');" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Edit Modal for each FAQ -->
                                                    <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content border-0 shadow-lg rounded-4">
                                                                <div class="modal-header bg-light border-0 px-4 py-3 rounded-top-4">
                                                                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-pen text-primary me-2"></i>Edit Logic</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <form method="POST">
                                                                    <div class="modal-body p-4 bg-white">
                                                                        <input type="hidden" name="action" value="edit">
                                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                        
                                                                        <div class="mb-4">
                                                                            <label class="form-label fw-bold text-muted small text-uppercase">Query Phrase</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-quote-left text-muted"></i></span>
                                                                                <input type="text" name="question" class="form-control bg-light border-start-0 py-2 fs-6" value="<?php echo htmlspecialchars($row['question']); ?>" required>
                                                                            </div>
                                                                            <div class="form-text">What the user might ask.</div>
                                                                        </div>
                                                                        
                                                                        <div class="mb-2">
                                                                            <label class="form-label fw-bold text-muted small text-uppercase">Bot Answer</label>
                                                                            <textarea name="answer" class="form-control bg-light fs-6" rows="4" required><?php echo htmlspecialchars($row['answer']); ?></textarea>
                                                                            <div class="form-text">The response returned to the user.</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer bg-light border-0 px-4 py-3 rounded-bottom-4">
                                                                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-primary px-4 fw-semibold rounded-pill shadow-sm">Save Rules</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-center py-5">
                                                        <h5 class="fw-bold text-dark mt-3">No Data Found</h5>
                                                        <p class="text-muted">The knowledge base is empty.</p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Unanswered Queries Tab -->
                    <div class="tab-pane fade" id="unanswered" role="tabpanel">
                        <div class="card shadow border-0 rounded-4 overflow-hidden">
                            <div class="card-header bg-white py-4 border-bottom d-flex align-items-center">
                                <h5 class="mb-0 fw-bold text-dark">
                                    <i class="fas fa-question-circle text-danger me-2"></i> Failed Queries
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0 border-0">
                                        <thead class="bg-light text-muted small fw-bold text-uppercase">
                                            <tr>
                                                <th class="px-4 py-3">Logged Question</th>
                                                <th class="py-3">Times Asked</th>
                                                <th class="py-3">Date First Logged</th>
                                                <th class="text-center py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(count($unanswered)>0): ?>
                                                <?php foreach($unanswered as $u): ?>
                                                    <tr>
                                                        <td class="px-4 fw-bold text-dark"><i class="fas fa-exclamation-circle text-warning me-2"></i> "<?php echo htmlspecialchars($u['question']); ?>"</td>
                                                        <td><span class="badge bg-danger rounded-pill px-3 py-1"><?php echo $u['asked_count']; ?></span></td>
                                                        <td class="text-muted small"><?php echo $u['created_at']; ?></td>
                                                        <td class="text-center">
                                                            <a href="?del_un=<?php echo $u['id']; ?>" class="btn btn-sm btn-outline-danger" title="Dismiss"><i class="fas fa-times"></i> Ignore</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr><td colspan="4" class="text-center py-4 text-muted">No unanswered queries. Great job!</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admission Leads Tab -->
                    <div class="tab-pane fade" id="leads" role="tabpanel">
                        <div class="card shadow border-0 rounded-4 overflow-hidden">
                            <div class="card-header bg-white py-4 border-bottom d-flex align-items-center">
                                <h5 class="mb-0 fw-bold text-dark">
                                    <i class="fas fa-users text-primary me-2"></i> Form Captures (Leads)
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0 border-0">
                                        <thead class="bg-light text-muted small fw-bold text-uppercase">
                                            <tr>
                                                <th class="px-4 py-3">ID</th>
                                                <th class="py-3">Full Name</th>
                                                <th class="py-3">Email Address</th>
                                                <th class="py-3">Date Captured</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(count($leads)>0): ?>
                                                <?php foreach($leads as $l): ?>
                                                    <tr>
                                                        <td class="px-4 text-muted">#<?php echo $l['id']; ?></td>
                                                        <td class="fw-bold text-dark"><i class="fas fa-user-circle text-primary me-2"></i> <?php echo htmlspecialchars($l['name']); ?></td>
                                                        <td><a href="mailto:<?php echo htmlspecialchars($l['email']); ?>"><?php echo htmlspecialchars($l['email']); ?></a></td>
                                                        <td class="text-muted small"><?php echo $l['created_at']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr><td colspan="4" class="text-center py-4 text-muted">No leads captured yet.</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Analytics Dashboard Tab -->
                    <div class="tab-pane fade" id="analytics" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card shadow border-0 rounded-4 bg-primary text-white p-4 h-100 banner-card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-white-50 small text-uppercase fw-bold mb-1">Total Messages Handled</p>
                                            <h2 class="display-4 fw-bold mb-0"><?php echo $total_messages; ?></h2>
                                        </div>
                                        <i class="fas fa-comments fs-1 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card shadow border-0 rounded-4 bg-success text-white p-4 h-100 banner-card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-white-50 small text-uppercase fw-bold mb-1">Identified Inquiries</p>
                                            <h2 class="display-4 fw-bold mb-0"><?php echo count($leads); ?></h2>
                                        </div>
                                        <i class="fas fa-user-check fs-1 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <p class="text-center text-muted small mt-5 mb-0">&copy; <?php echo date('Y'); ?> Eagles Secondary School System. Data handled locally.</p>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header text-white px-4 py-3 border-0" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                    <h5 class="modal-title fw-bold"><i class="fas fa-plus-circle me-2 opacity-75"></i>New Flow Logic</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <!-- Progress indicator line -->
                <div style="height: 3px; width: 100%; background: #fff; opacity: 0.2"></div>
                <form method="POST">
                    <div class="modal-body p-4 bg-white">
                        <input type="hidden" name="action" value="add">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Query Phrase</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-quote-left text-muted"></i></span>
                                <input type="text" name="question" class="form-control bg-light border-start-0 py-2 fs-6" placeholder="e.g. What are the school fees?" required autofocus>
                            </div>
                            <div class="form-text">Try to use common phrases.</div>
                        </div>
                        
                        <div class="mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase">Bot Answer</label>
                            <textarea name="answer" class="form-control bg-light fs-6" rows="4" placeholder="e.g. Please contact the accounts office via accounts@eagles.edu." required></textarea>
                            <div class="form-text">Line breaks will be preserved. HTML not recommended.</div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0 px-4 py-3">
                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary px-4 fw-semibold rounded-pill shadow-sm">Save & Activate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

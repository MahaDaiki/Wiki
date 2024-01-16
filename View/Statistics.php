<?php 
session_start();
$_SESSION['admin_role'] = true;
if (!isset($_SESSION['admin_role']) || $_SESSION['admin_role'] !== true) {
    header("Location: index.php?action=Authentification"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">

    <!-- Custom Styles -->
    <style>
        .sidebar-dark-primary {
            background-color: #D0B8A8 !important;
        }

        .navbar-dark {
            background-color: #7D6E83 !important;
        }

        .nav-sidebar .nav-item .nav-link {
            color: #7D6E83 !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i>=</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?action=Logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">WIKI</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- User Panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                    <img class="profile-image img-fluid rounded" src="View\Assets\Imgs\pngwing.com.png" alt="Profile Image">
                    </div>
                    <div class="info">
                        <h3class="d-block"> <?php echo $_SESSION['username'] ?> </h3>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php?action=Admindashboardd" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?action=Statistiques" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Statistics</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/index.php" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>Manage Wikis</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
    

        <div class="content-wrapper">
            <!-- Main Content -->
            <div class="content">
                <div class="container">
                    <h1>Statistics</h1>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="user-statistics">
                                <h2>Wikis Per User</h2>
                                <canvas id="userChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="category-statistics">
                                <h2>Wikis Per Category</h2>
                                <canvas id="categoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
            <footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 Your Website. All Rights Reserved.</p>
  </footer>
    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

var userChartCanvas = document.getElementById('userChart').getContext('2d');
var userChart = new Chart(userChartCanvas, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_keys($userData)) ?>,
        datasets: [{
            label: 'Wiki Count',
            data: <?= json_encode(array_values($userData)) ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


var categoryChartCanvas = document.getElementById('categoryChart').getContext('2d');
var categoryChart = new Chart(categoryChartCanvas, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_keys($categoryData)) ?>,
        datasets: [{
            label: 'Wiki Count',
            data: <?= json_encode(array_values($categoryData)) ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>

</body>
</html>

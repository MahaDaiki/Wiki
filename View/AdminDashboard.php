<?php 
session_start();

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
                        <img src="https://via.placeholder.com/150" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">User Name</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Statistics</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>Manage</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="wrapper" style="background:#f3e3d4 !important">

            <div class="content-wrapper" style="background:#f3e3d4 !important">

                <section class="content">
                    <div class="row ">
                        <!-- Category Table -->
                        <div class="col-md-6 mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Categories</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn " data-toggle="modal"
                                            data-target="#addCategoryModal">+</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($Category as $cat): ?>
                                                <tr>
                                                    <td>
                                                        <?= $cat->getCat_id() ?>
                                                    </td>
                                                    <td>
                                                        <?= $cat->getCategory_name() ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modifyCategoryModal<?= $cat->getCat_id() ?>">Modify</button>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryModal<?= $cat->getCat_id() ?>">Delete</button>

                                                        
                                                    </td>
                                                </tr>
                                                <!-- Modify Category Modal -->
                                                <div class="modal fade" id="modifyCategoryModal<?= $cat->getCat_id() ?>" tabindex="-1" role="dialog"
        aria-labelledby="modifyCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyCategoryModalLabel">Modify Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post"
                    action="index.php?action=ModifyCategory&cat_id=<?= $cat->getCat_id() ?>"class="card">
                        <div class="form-group">
                            <label for="modifiedCategoryName">Category Name</label>
                            <input type="text" class="form-control" id="modifiedCategoryName"
                                name="modifiedCategoryName"  value="<?= $cat->getCategory_name() ?>" required>
                        </div>
                        <button type="submit" class="btn btn-warning btn-sm">Modify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->

<!-- Delete Category Modal -->
<div class="modal fade" id="deleteCategoryModal<?= $cat->getCat_id() ?>" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this category? '<?= $cat->getCategory_name() ?>'</p>
            </div>
            <div class="modal-footer">
                <form action="index.php?action=DeleteCategory&cat_id=<?= $cat->getCat_id() ?>" method="post" >
                <button type="button" class="btn btn-secondary btn_sm " data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-sm">Delete</button></form>
            </div>
        </div>
    </div>
</div>

                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Tag Table -->
                        <div class="col-md-6 mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tags</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn " data-toggle="modal"
                                            data-target="#addTagModal">+</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>

                                            <tr>
                                                <th>ID</th>
                                                <th>Tag</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($Tags as $tag): ?>
                                                <tr>
                                                    <td>
                                                        <?= $tag->getTag_id() ?>
                                                    </td>
                                                    <td>
                                                        <?= $tag->getTag() ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modifyTagModal<?= $tag->getTag_id() ?>">Modify</button>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteTagModal<?= $tag->getTag_id()?>">Delete</button>
                                                    </td>
                                                </tr>
                                                
                                                <div class="modal fade" id="modifyTagModal<?= $tag->getTag_id() ?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="modifyTagModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modifyTagModalLabel">Modify Tag
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post"
                                                                    action="index.php?action=ModifyTag&tag_id=<?= $tag->getTag_id() ?>"
                                                                    class="card">
                                                                    <div class="form-group">
                                                                        <label for="modifiedTagName">Tag Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="modifiedTagName" name="modifiedTagName"
                                                                            value="<?= $tag->getTag() ?>" required>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-warning btn-sm">Modify</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
<!-- Delete Category Modal -->
<div class="modal fade" id="deleteTagModal<?= $tag->getTag_id() ?>" tabindex="-1" role="dialog" aria-labelledby="deleteTagModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTagModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Tag? '<?= $tag->getTag() ?>'</p>
            </div>
            <div class="modal-footer">
                <form action="index.php?action=DeleteTag&tag_id=<?= $tag->getTag_id() ?>" method="post" >
                <button type="button" class="btn btn-secondary btn_sm " data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-sm">Delete</button></form>
            </div>
        </div>
    </div>
</div>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                </section>
            </div>
        </div>
    </div>
    </div>
    <!-- Category Modal -->
    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php?action=AddCategory" class="card">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Add Tag Modal -->
    <div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTagModalLabel">Add Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php?action=AddTag" class="card">
                        <div class="form-group">
                            <label for="tagName">Tag Name</label>
                            <input type="text" class="form-control" id="Tag" name="Tag">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   




    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start(); 
$title = "ADD WIKI";
ob_start();


if (!isset($_SESSION['auteur_role']) || $_SESSION['auteur_role'] !== true) {
    header("Location: index.php?action=Authentification"); 
   
}
?>

<h1 class="display-3 text-center  mt-2" style="color:#8c7387">ADD A WIKI</h1>
<div class="container mt-5 p-4 mb-3" style="background-color: #777474; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <form action="index.php?action=WikisAdd" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input type="text" class="form-control" id="Title" name="Title" required maxlength="200">
        </div>

        <div class="mb-3">
            <label for="Wiki-content" class="form-label">Content</label>
            <textarea class="form-control" id="Wiki-content" name="content" rows="6" ></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Category" class="form-label">Category</label>
                <select class="form-select" id="Category" name="Category" required>
                    <?php foreach ($Category as $Cat): ?>
                        <option><?= $Cat->getCategory_name() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="Tags" class="form-label">Tags</label>
                <div class="mb-3">
                    <?php foreach ($Tags as $T): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tag<?= $T->getTag_id() ?>" name="Tags[]" value="<?= $T->getTag() ?>">
                            <label class="form-check-label" for="tag<?= $T->getTag_id() ?>">
                                <?= $T->getTag() ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="Image" class="form-label">Image</label>
            <input type="file" class="form-control" id="Image" name="Image" accept="image/*">
        </div>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn  btn-rounded" style="background-color: #7D6E83;">Submit</button>
        </div>
  
</div>
  </form>
<?php $content = ob_get_clean(); ?>
<?php include_once 'View\layout.php'; ?>

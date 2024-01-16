<?php
session_start(); 
$title = "Modify WIKI";
ob_start();
?>

<h1 class="display-3 text-center mt-2" style="color:#8c7387">Modify Your WIKI</h1>

<div class="container mt-5 p-4 mb-3" style="background-color: #777474; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <form action="index.php?action=handleModifyWiki&Wiki_id=<?= $wikis->getWiki_id() ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="<?= $_SESSION['user_id'] ?>" name="user_id">

        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input type="text" class="form-control" id="Title" name="new_Title" value="<?= $wikis->getTitle() ?>">
        </div>

        <div class="mb-3">
            <label for="Wiki-content" class="form-label">Content</label>
            <textarea class="form-control" id="Wiki-content" name="new_content" rows="6"><?= $wikis->getContent() ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Category" class="form-label">Category</label>
                <select class="form-select" id="Category" name="new_Category" required>
                    <?php foreach ($Category as $Cat): ?>
                        <option value="<?= $Cat->getCat_id() ?>" <?= ($Cat->getCat_id() == $wikis->getCat_id()) ? 'selected' : '' ?>>
                            <?= $Cat->getCategory_name() ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="Tags" class="form-label">Tags</label>
                <div class="mb-3 d-flex flex-wrap">
                    <?php foreach ($Tags as $T): ?>
                        <div class="form-check me-3 mb-2"> 
                            <input class="form-check-input" type="checkbox" name="new_Tags[]" value="<?= $T->getTag_id() ?>" <?= (in_array($T->getTag(), $taginwiki)) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="tag<?= $T->getTag_id() ?>"><?= $T->getTag() ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="Image" class="form-label">Image</label>
            <div class="d-flex align-items-center">
                <img src="<?= $wikis->getImage() ?>" alt="Current Image" style="max-width: 200px; max-height: 200px; margin-right: 10px;">
                <input type="file" class="form-control" id="Image" name="new_Image" accept="image/*" style="flex: 1;" value="<?= $wikis->getImage() ?>">
            </div>
        </div>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn btn-rounded" style="background-color: #7D6E83;">Submit</button>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'View/layout.php'; ?>

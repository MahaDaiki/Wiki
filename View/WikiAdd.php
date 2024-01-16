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
        <input type="hidden" value="<?=$_SESSION['user_id']?>" name="user_id">
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
    
            <input type="text" class="form-control" id="Title" name="Title" required >
            <span id="titleError" style="color: red;"></span>
        </div>

        <div class="mb-3">
            <label for="Wiki-content" class="form-label">Content</label>
            <textarea class="form-control" id="Wiki-content" name="content" rows="6" ></textarea>
            <span id="contentError" style="color: red;"></span>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Category" class="form-label">Category</label>
                <select class="form-select" id="Category" name="Category" required>
                    <?php foreach ($Category as $Cat): ?>
                        <option value="<?= $Cat->getCat_id() ?>"><?= $Cat->getCategory_name() ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="categoryError" style="color: red;"></span>
            </div>

            <div class="col-md-6 mb-3">
    <label for="Tags" class="form-label">Tags</label>
    <div class="mb-3 d-flex flex-wrap">
        <?php foreach ($Tags as $T): ?>
            <div class="form-check me-3 mb-2">
                <input class="form-check-input" type="checkbox" id="tag<?= $T->getTag_id() ?>" name="Tags[]" value="<?= $T->getTag_id() ?>">
                <label class="form-check-label" for="tag<?= $T->getTag_id() ?>">
                    <?= $T->getTag() ?>
                </label>
            </div>
        <?php endforeach; ?>
        <span id="tagsError" style="color: red;"></span>
    </div>
</div>
        </div>


        <div class="mb-3">
            <label for="Image" class="form-label">Image</label>
            <input type="file" class="form-control" id="Image" name="Image" accept="image/*">
            <span id="imageError" style="color: red;"></span>
        </div>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn  btn-rounded" style="background-color: #7D6E83;">Submit</button>
        </div>
  
</div>
  </form>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add event listeners for input fields
        document.getElementById('Title').addEventListener('input', validateField);
        document.getElementById('Wiki-content').addEventListener('input', validateField);
        document.getElementById('Category').addEventListener('input', validateField);

        // Add event listener for the Submit button
        document.getElementById('submitBtn').addEventListener('click', validateBeforeSubmit);
    });

    function validateField(event) {
        // Get the input field and its value
        const field = event.target;
        const fieldValue = field.value.trim();

        // Get the corresponding error message element
        const errorElement = document.getElementById(`${field.id}Error`);

        // Check if the field is empty
        if (fieldValue === '') {
            errorElement.textContent = 'This field is required.';
        } else {
            errorElement.textContent = ''; // Clear the error message
        }
    }

    function validateBeforeSubmit(event) {
        // Check all required fields before form submission
        const titleField = document.getElementById('Title');
        const contentField = document.getElementById('Wiki-content');
        const categoryField = document.getElementById('Category');

        // Check if any of the required fields is empty
        if (titleField.value.trim() === '') {
            document.getElementById('titleError').textContent = 'This field is required.';
            event.preventDefault(); // Prevent form submission if any required field is empty
        }

        if (contentField.value.trim() === '') {
            document.getElementById('contentError').textContent = 'This field is required.';
            event.preventDefault();
        }

        if (categoryField.value.trim() === '') {
            document.getElementById('categoryError').textContent = 'This field is required.';
            event.preventDefault();
        }
    }
</script>



<?php $content = ob_get_clean(); ?>
<?php include_once 'View\layout.php'; ?>

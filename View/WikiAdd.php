
<?php
$title = "ADD WIKI";
ob_start();
?>


<form  class="container" action="process_Wiki.php" method="post">
    <label for="Title">Title</label>
<input type="text" id="Title" name="Title">
 <label for="Wiki-content">Content</label>
  <textarea id="Wiki-content" name="Wiki-content"></textarea>
  <label for="">ctgr</label>
  <select class="form-select" id="Category" name="Category" required>
                <?php foreach ($Category as $Cat): ?>
                <option> 
                    <?= $Cat->getCategory_name() ?>
                </option>
                <?php endforeach; ?>
            </select>
 <select class="form-select" id="Tags" name="Tags" required>
                <?php foreach ($Tags as $T): ?>
                <option>
                    <?= $T->getTag()?>
                </option>
                <?php endforeach; ?>
            </select>
  <button type="submit">Submit</button>
</form>



<?php $content = ob_get_clean(); ?>
<?php include_once 'View\layout.php'; ?>
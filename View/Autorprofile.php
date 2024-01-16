
<?php

$title = "Profile";
ob_start();
$_SESSION['auteur_role'] = true;
?>

<style>
    .profile-container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .profile-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

 

    .wikis h2 {
        font-size: 18px;
        padding: 10px;
    }



    .wikis .text-right {
        padding: 10px;
        text-align: right;
    }

    .wikis-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        
    }

    .wikis {
        width: 60%; 
        margin-bottom: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

 
</style>
<div class="container profile-container mt-4">
    <div class="row">
        <div class="col-lg-4">
            <img class="profile-image img-fluid rounded" src="View\Assets\Imgs\pngwing.com.png" alt="Profile Image">
        </div>
        <div class="col-lg-8">
            <h2 class="mt-3">Welcome, <?php echo $_SESSION['username']; ?></h2>
           
            
        </div>
    </div>
</div>
<div class="container text-center mt-3">
    <a href="index.php?action=WikisAdd" class="btn " style="background: #7D6E83;">Add Wiki</a>
</div>

<div class="container mt-3">
    <div class="row">
        <?php foreach ($wikibyid as $id): ?>
            <div class="col-lg-6 mb-3">
                <div class="card article-card wikis">
                    <h2 class="text-center"><?= $id->getTitle() ?></h2>
                    <img src="<?= $id->getImage() ?>" alt="Article Image" class="card-img-top">
                    <div class="card-footer">
                        <div class="categories">Categories:
                            <span class="category-badge badge badge-pill badge-secondary"><?= $id->getCat_id() ?></span>
                        </div>
                        <div class="tags">Tags:
                            <?php foreach ($id->getTags() as $tag): ?>
                                <span class="tag-badge badge badge-pill badge-primary"><?= $tag->getTag() ?></span>
                            <?php endforeach; ?>
                            <div class="text-right">
                                <p><?= $id->getDate_created() ?></p>
                                <p>
                                    <a href="index.php?action=Modifywiki&Wiki_id=<?= $id->getWiki_id() ?>" class="btn " style="background: #7D6E83;"> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $id->getWiki_id()?>">Delete</button>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteModal<?= $id->getWiki_id() ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this WIKI? '<?= $id->getTitle() ?>'</p>
            </div>
            <div class="modal-footer">
                <form action="index.php?action=DeleteWiki&wiki_id=<?= $id->getWiki_id() ?>" method="post">
                    <button type="button" class="btn btn-secondary btn_sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

        <?php endforeach; ?>
    </div>
</div>



<?php $content = ob_get_clean(); ?>
<?php include_once 'View\layout.php'; ?>


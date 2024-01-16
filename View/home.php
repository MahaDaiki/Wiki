<?php
$title = "Home";
ob_start();
session_start();
// var_dump($tags);
// exit;
?>
<style>

   

    
    .search-box {
        font-size: 20px;
        border: solid 0.3em #000000;
        display: inline-block;
        position: relative;
        border-radius: 2.5em;
    }

    .search-box input[type=text] {
        font-family: inherit;
        font-weight: bold;
        width: 1.5em;
        height: 2.5em;
        padding: 0.3em 2.1em 0.3em 0.4em;
        border: none;
        box-sizing: border-box;
        border-radius: 2.5em;
        transition: width 800ms cubic-bezier(0.68, -0.55, 0.27, 1.55) 150ms;
    }

    .search-box input[type=text]:focus {
        outline: none;
    }

    .search-box input[type=text]:focus,
    .search-box input[type=text]:not(:placeholder-shown) {
        width: 18em;
        transition: width 800ms cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }

    .search-box input[type=text]:focus+button[type=reset],
    .search-box input[type=text]:not(:placeholder-shown)+button[type=reset] {
        transform: rotate(-45deg) translateY(0);
        transition: transform 150ms ease-out 800ms;
    }

    .search-box input[type=text]:focus+button[type=reset]:after,
    .search-box input[type=text]:not(:placeholder-shown)+button[type=reset]:after {
        opacity: 1;
        transition: top 150ms ease-out 950ms, right 150ms ease-out 950ms, opacity 150ms ease 950ms;
    }

    .search-box button[type=reset] {
        background-color: transparent;
        width: 1.4em;
        height: 1.4em;
        border: 0;
        padding: 0;
        outline: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0.55em;
        right: 0.55em;
        transform: rotate(-45deg) translateY(2.2em);
        transition: transform 150ms ease-out 150ms;
    }

    .search-box button[type=reset]:before,
    .search-box button[type=reset]:after {
        content: "";
        background-color: #000000;
        width: 0.3em;
        height: 1.4em;
        position: absolute;
    }

    .search-box button[type=reset]:after {
        transform: rotate(90deg);
        opacity: 0;
        transition: transform 150ms ease-out, opacity 150ms ease-out;
    }
</style>

<div class="container">
    <div class="">
        <img width="100%" height="500vh" src="View/Assets/Imgs/bck.jpg" alt="Background Image">
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-8">
        <h1 class="mt-4 mb-4 container">Latest Articles</h1>
        <?php foreach ($wiki as $w): ?>
            <div class="col-9 col-sm-8 card article-card wikis" id=<?= $w->getWiki_id() ?>>
                <h2 class="text-center">
                    <?= $w->getTitle() ?>
                </h2>
                <!-- <div class="overlay"></div>  -->
                <img src="<?= $w->getImage() ?>" alt="Article Image" class="card-img-top">
                <!-- <div class="card-body">
                </div> -->
                <div class="card-footer">
                    <div class="categories">Category:
                        <span class="category-badge badge badge-pill badge-secondary">
                            <?= $w->getCat_id() ?>
                        </span>
                    </div>
                    <div class="tags">Tags:
                        <?php foreach ($w->getTags() as $tag): ?>
                            <span class="tag-badge badge badge-pill badge-primary">
                                <?= $tag->getTag() ?>
                            </span>
                        <?php endforeach; ?> 
                        <div class=text-right>
                            <p> <?= $w->getDate_created() ?>
                            <p>
                                <a href="index.php?action=Displaydetail&Wiki_id=<?= $w->getWiki_id() ?>"> click for the full
                                    article -></a>
                                
                                  <?php if (isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === true): ?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $w->getWiki_id()?>">Archieve</button>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal<?= $w->getWiki_id() ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to Archieve this WIKI? '<?= $w->getTitle() ?>'</p>
            </div>
            <div class="modal-footer">
                <form action="index.php?action=ArchieveWiki&wiki_id=<?= $w->getWiki_id() ?>" method="post">
                    <button type="button" class="btn btn-secondary btn_sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

        <?php endforeach; ?>
    </div>

    <div class="col-lg-4">
        <form class="search-box">
            <input type="text"  id="input-search" placeholder=" " />
            <button type="reset"></button>
        </form>

        <h2 class="mt-4 mb-3">Categories</h2>
        <div class=" col-10">
            <?php foreach ($cats as $c): ?>
                <a href="#" class="category-badge badge badge-pill badge-secondary"><?= $c->getCategory_name() ?></a>
            <?php endforeach; ?>
        </div>

        <h2 class="mt-4 mb-3 ">Tags</h2>

        <div class=" col-10">
            <?php foreach ($tgs as $t): ?>
                <a href="#" class="tag-badge badge badge-pill badge-primary">
                    <?= $t->getTag() ?>
                </a>
                
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'View\layout.php'; ?>
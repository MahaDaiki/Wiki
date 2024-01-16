<?php


$title = " WIKI Details";
ob_start();
?>
<style>
.article-details {
            max-width: 800px;
            margin: 0 auto;
        }

        .article-details img {
            width: 100%;
            height: auto;
        }

        .categories, .tags {
            list-style-type: none;
            padding: 0;
        }

        .categories a, .tags a {
            text-decoration: none;
            margin-right: 10px;
        }

        .category-badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .tag-badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #28a745;
            color: #fff;
            border-radius: 20px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="">
    <img width="100%" height="250vh" src="View/Assets/Imgs/bck.jpg" alt="Background Image">
    </div>
</div>
    <div class="article-details mb-5">
 
        
        <h1 class="mt-4 mb-4"><?= $wikid->getTitle()?></h1>
        <img src="<?=$wikid->getImage()?>" alt="Article Image" class="img-fluid mb-4">
        <p> <?= $wikid->getContent()?></p>
       
        <div class="categories">Category: <span class="category-badge"><?= $wikid->getCat_id()?></span>.
        <div class="tags">Tags: 
        <?php foreach ($wikid->getTags() as $tag): ?>
                                <span class="tag-badge badge badge-pill badge-primary"><?= $tag->getTag() ?></span>
                            <?php endforeach; ?>
    </div> <h2 class=text-right>-<?= $wikid->getUser_id()?></h2>
    <div class="text-right">
    <a href="/index.php?"> More Wikis -></a></div>
</div>
        </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php include_once 'View\layout.php'; ?>
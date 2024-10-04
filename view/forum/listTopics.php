<?php

    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>
<div class="topic-category">
    <h1><?= $category->getName() ?></h1>
</div>


<?php 
foreach($topics as $topic )
{ ?><div class="topics-container">
        <div class="topic">
            <div class="topic-title">
                <a href="index.php?ctrl=post&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?>
            </div>
            <div class="topic-user">
                </a><span class="start">start by</span>
                <span class="user"><?= $topic->getUser()?></span>
            </div>
            <div class="topic-date">
                <?= $topic->getCreationDate() ?>
            </div>
            <div class="topic-statut">
                <?php 
                if ($topic->getClosed()): ?>
                <span class="lock">
                    <img src="public/img/lock.png" alt="logo de cadenas">
                </span>
                <?php 
                else: ?>
                <a href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId() ?>">
                    <img src="public/img/key.png" alt="logo de clés">
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php }
?>

<form action="index.php?ctrl=topic&action=addTopic&id=<?= $category->getId() ?>" method="POST">
    <input type="text" name="title" placeholder="Titre ici...">
    <textarea name="content" id="txtarea" cols="100" rows="3" placeholder="Votre texte ici..."></textarea>
    <input type="submit" value="add Topic">
</form>


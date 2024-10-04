<?php 

$topic = $result["data"]["topic"];
$posts = $result["data"]["posts"];


?>

<div class="post-topic">
    <h1><?= $topic->getTitle() ?></h1>
</div>

<?php 

foreach ($posts as $post) : ?>
    <div class="post-container">
        <div class="post-header">
            <span class="post-user"><?= $post->getUser() ?></span>
            <span class="post-date"><?= $post->getFormattedCreationDate() ?></span>
        </div>
        <div class="post-content">
            <p><?= $post->getContent() ?></p>
        </div>
    </div>
<?php endforeach ?>



<form action="index.php?ctrl=post&action=addPost&id=<?= $topic->getId() ?>" method="POST">

    <textarea name="content" id="txtarea" cols="100" rows="5" placeholder="Votre texte ici..."></textarea>
    <input type="submit" value="Envoyer">
</form>
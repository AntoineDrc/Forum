<?php

    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<?php 
foreach($topics as $topic ){ ?>
    <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?><br></a> start by <?= $topic->getUser() . " le " . $topic->getCreationDate() ?></p>
<?php }
?>

<form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId() ?>" method="POST">
    <input type="text" name="title" placeholder="Titre ici...">
    <textarea name="content" id="txtarea" cols="100" rows="3" placeholder="Votre texte ici..."></textarea>
    <input type="submit" value="add Topic">
</form>


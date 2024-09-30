<?php 

$topic = $result["data"]["topic"];
$posts = $result["data"]["posts"];


?>

<h1>Liste des posts</h1>

<?php 

echo $topic->getTitle() . "<br><br>";

foreach ($posts as $post)
{
    echo $post->getUser() . " " . $post->getCreationDate() . "<br>" . $post->getContent();
}

?>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST">

    <textarea name="content" id="txtarea" cols="100" rows="5" placeholder="Votre texte ici..."></textarea>
    <input type="submit" value="Envoyer">
</form>
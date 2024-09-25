<?php 

$topic = $result["data"]["topic"];
$posts = $result["data"]["posts"];


?>

<h1>Liste des posts</h1>

<?php 

foreach ($posts as $post)
{
    echo $post->getContent();
}

?>

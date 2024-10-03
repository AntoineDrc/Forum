<?php
    $categories = $result["data"]['categories']; 
?>

<h1>DRAGON BALL | DRAGON BALL Z | DRAGON BALL GT | DRAGON BALL SUPER</h1>

<?php
foreach($categories as $category ){ ?>
    <p><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></p>
<?php }


  

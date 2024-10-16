<?php

use App\Session;

$topic = $result["data"]["topic"];
$posts = $result["data"]["posts"];


?>

<div class="post-topic">
    <h1><?= $topic->getTitle() ?></h1>
</div>

<?php 

if ($posts):
foreach ($posts as $post) : ?>
    <div class="post-container">
        <div class="post-header">
            <?php if ($post->getUser()): ?>
                <span class="post-user"><?= $post->getUser() ?></span>
                <?php else: ?>
                <span class="post-user">Anonyme</span>
            <?php endif ?>
            <span class="post-date"><?= $post->getFormattedCreationDate() ?></span>
            <?php if (Session::isAdmin()): ?>
                <div class="post-action">
                    <a href="index.php?ctrl=post&action=deletePost&id=<?= $post->getId() ?>" class="delete-post">
                        <img class="trash" src="public/img/trash.png" alt="logo de corbeille">
                    </a>
                </div>
                <?php endif; ?>
        </div>
        <div class="post-center">
            <!-- <img src="public/img/Vegeta.jpg" alt="image Vegeta"> -->
            <div class="post-content">
                <p><?= $post->getContent() ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; 
else:?>
<p class="post-null">Aucun post pour ce topic pour l'instant</p>
<?php endif; ?>


    

<?php $user = Session::getUser(); 
if ($user && !$user->getIsbanned() && !$topic->getClosed())
{ ?>
<div class="addForm">
    <div class="form-container">
    <img src="public/img/avatar.png" alt="">
        <form action="index.php?ctrl=post&action=addPost&id=<?= $topic->getId() ?>" method="POST">
            <textarea name="content" id="txtarea" cols="100" rows="5" placeholder="Votre texte ici..."></textarea>
            <input type="submit" value="Envoyer">
        </form>
    </div>
    <?php } 
elseif ($user && $topic->getClosed())
{ ?>
    <p class="mess">Ce topic est clos, vous ne pouvez pas ecrire de post</p>
    <?php } 
elseif ($user && $user->getIsBanned())
{ ?>
    <p class="mess">Vous êtes banni, vous ne pouvez pas ecrire de post</p>
    <?php } 
else 
{?>
    <p class="mess">Vous devez être connecté pour pouvoir poster</p>
<?php } ?>

</div>
 

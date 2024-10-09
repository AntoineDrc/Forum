<?php

use App\Session;

    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>
<div class="topic-name">
    <div class="h1-secondary">
        <h1><?= $category->getName() ?></h1>
    </div>
        <a href="#addTopic">
            <button type="button">Post Thread</button>
        </a>
</div>

<div class="topics">
    <div class="topic">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Subject / Start by</th>
                    <th>Creation Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($topics as $topic ) { ?>
                    <tr>
                        <td>
                            <img src="public/img/document.png" alt="">
                        </td>
                        <!-- Topic Title -->
                        <td>
                            <div class="topic-title">
                                <a href="index.php?ctrl=post&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                                    <?= $topic->getTitle() ?>
                                </a>
                            </div>
                            <div class="topic-user">
                                <span class="start">start by</span>
                                <?php if ($topic->getUser()): ?>
                                    <span class="user"><?= $topic->getUser() ?></span>
                                <?php else: ?>
                                    <span class="user">Anonyme</span>
                                <?php endif; ?>
                                
                            </div>
                        </td>

                        <!-- Creation Date -->
                        <td>
                            <div class="topic-date">
                                <?= $topic->getFormattedCreationDate() ?>
                            </div>
                        </td>

                        <!-- Status: Locked or Unlocked -->
                        <td>
                            <div class="topic-statut">
                                <?php 
                                // Récupère l'ID user
                                $user = Session::getUser();
                                $topicOwner = $topic->getUser(); // Récupère l'utilisateur du topic
                                if ($user && !$user->getIsBanned() && $topicOwner && ($user->getId() === $topicOwner->getId() || Session::isAdmin()))
                                { ?>
                                    <?php if ($topic->getClosed()): ?>
                                        <a href="index.php?ctrl=topic&action=unlockTopic&id=<?= $topic->getId() ?>">
                                            <img src="public/img/lock.png" alt="Locked">
                                        </a>
                                    <?php else: ?>
                                        <a href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId() ?>">
                                            <img src="public/img/key.png" alt="Unlocked">
                                        </a>
                                    <?php endif;
                                } ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php 
    $user = Session::getUser();
    if ($user && !$user->getIsbanned())
    { ?>
    <div class="addForm">
        <div class="form-container">
            <img src="public/img/avatar.png" alt="">
            <form action="index.php?ctrl=topic&action=addTopic&id=<?= $category->getId() ?>" id="addTopic" method="POST">
                <input type="text" name="title" placeholder="Titre ici...">
                <textarea name="content" id="txtarea" cols="100" rows="3" placeholder="Votre texte ici..."></textarea>
                <input type="submit" value="Post thread">
            </form>
        </div>
    </div>
    <?php } ?>
</div>

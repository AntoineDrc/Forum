<?php 

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class PostController extends AbstractController implements ControllerInterface
{
    // Méthode qui liste tout les posts d'un topic spécifique
    public function listPostsByTopic($id)
    {
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);

        return
        [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "meta_description" => "Liste des posts par topic : " . $topic,
            "data" => 
            [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    // Méthode qui récupère les données du formulaire dans "listPosts" afin d'ajouter un nouveau poste
    public function addPost()
    {
        $content = filter_input(INPUT_POST,"content", FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
        $topicId = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT) ?? null;

        if ($content && $topicId)
        {
            $userId = 2; // Utilisateur temporaire

            $postManager = new PostManager();
            $postManager->add
            ([
                'content' => $content,
                'creationDate' => date('Y-m-d H:i:s'),
                'user_id' => $userId,
                'topic_id' => $topicId
            ]);
            
            // Redirige vers la liste des posts du topic
            $this->redirectTo("post","listPostsByTopic", $topicId);
        }
    }
}
?>

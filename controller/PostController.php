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

        // Redirection en cas d'erreur
        if (!$topic)
        {
            $_SESSION['error'] = "Le topic demandé n'éxiste pas";
            header("Location: index.php?ctrl=forum&action=index");
            exit();
        }
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

        $user = Session::getUser();

        if (!$user)
        {
            $_SESSION["error"] = "Vous devez être connecté pour poster";
            header("Location: index.php?ctrl=security&action=login");
            exit();
        }

        $content = filter_input(INPUT_POST,"content", FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
        $topicId = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT) ?? null;

        // Vérifie si l'utilisateur est banni, et si c'est le cas, envoie un message d'erreur et redirige vers la page d'accueil
        if ($user->getIsbanned())
        {
            $_SESSION['error'] = "Vous êtes banni et ne pouvez pas poster";
            header("Location:index.php?ctrl=forum&action=index");
            exit();
        }
        
        if ($topicId)
        {
            $topicManager = new TopicManager();
            $topicStatus = $topicManager->getStatus($topicId);

            // Si le topic est clos, redirige avec message d'erreur
            if ($topicStatus && $topicStatus['closed'] === 1)
            {
                $_SESSION["error"] = "Le topic est clos, vous ne pouvez pas ajouter de nouveaux post";
                header("Location: index.php?ctrl=forum&action=index");
                exit();
            }
        }

        if ($content)
        {
            $userId = $user->getId(); 

            $postManager = new PostManager();
            $postManager->add
            ([
                'content' => $content,
                'creationDate' => date('Y-m-d H:i'),
                'user_id' => $userId,
                'topic_id' => $topicId
            ]);
            
            // Redirige vers la liste des posts du topic
            $this->redirectTo("post","listPostsByTopic", $topicId);
        }
    }

    // Méthode pour supprimer un post 
    public function deletePost($id)
    {
        // Vérifie si l'utilistaeur est admin
        if (Session::isAdmin())
        {
            $postManager = new PostManager();

            // Récupère le post
            $post = $postManager->findOneById($id);

            if ($post)
            {
                $postManager->delete($id);

                // Affiche un message
                $_SESSION['success'] = "Le post a été supprimé avec succès";
            }
            else 
            {
                $_SESSION['error'] = "Le post n'existe pas";
            }
        }

        // Redirige vers la page tu Topic
        $this->redirectTo("post", "listPostsByTopic", $post->getTopic()->getId());
    }
}
?>

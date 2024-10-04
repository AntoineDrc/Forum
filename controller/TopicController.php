<?php 

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use model\Managers\PostManager;

class TopicController extends AbstractController implements ControllerInterface
{
    public function listTopicsByCategory($id) 
    {

        $topicManager = new TopicManager();

        // Récupère l'Id du topic
        $topicId = $topicManager->topicExist($id);

        // Retourne une erreur et redirige à l'acceuil si le topic n'existe pas 
        if (!$topicId)
        {
            $_SESSION['error'] = "Le topic demandé n'existe pas";
            header("Location: index.php?ctrl=forum&action=index");
            exit();
        }

        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    // Méthode qui récupères les données du formulaire dans "listTopics" afin d'ajouter un nouveau topic
    public function addTopic()
    {
        $user = Session::getUser();

        if (!$user)
        {
            $_SESSION['error'] = "Vous devez être connecté pour ajouter un topic";
            header("Location: index.php?ctrl=security&action=login");
            exit();
        }

        $title = filter_input(INPUT_POST,"title", FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
        $content = filter_input(INPUT_POST,"content", FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
        $categoryId = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT) ?? null;

        if ($title && $content && $categoryId)
        {
            $userId = $user->getId();

            $topicManager = new TopicManager();

            // Ajoute un nouveau topic
            $topicId = $topicManager->add
            ([
                'title' => $title,
                'creationDate' => date('Y-m-d H:i:s'),
                'user_id' => $userId,
                'category_id' => $categoryId
            ]);

            $postManager = new PostManager();
            $postManager->add
            ([
                'content' => $content,
                'creationDate' => date('Y-m-d H:i:s'),
                'user_id' => $userId,
                'topic_id' => $topicId

            ]);

            // Redirige vers la liste des topics par catégorie
            $this->redirectTo("topic","listTopicsByCategory", $categoryId);
        }
    }

    // Méthode pour verrouiller un topic
    public function lockTopic($id)
    {
        $topicManager = new TopicManager();
        
        // Récupère le topic à verrouiller
        $topic = $topicManager->findOneById($id);

        if ($topic)
        {
            // Change le status du topic (0 = ouvert : 1 = fermé)
            $newStatus = $topic->getClosed() ? 0 : 1;

            // Met à jour le status du topic
            $topicManager->updateTopicStatus($id, $newStatus);

            // Redirige vers la liste des topics
            $this->redirectTo("topic", "listTopicsByCategory", $topic->getCategory()->getId());
        }
        else
        {
            $_SESSION['error'] = "Le topic demandé n'éxiste pas";
            $this->redirectTo("forum", "index");
        }


    }
}
?>

<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\PostManager;
use Model\Managers\TopicManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() 
    {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "ASC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopicsByCategory($id) 
    {

        $topicManager = new TopicManager();
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
            $this->redirectTo("forum","listPostsByTopic", $topicId);
        }
    }

    // Méthode qui récupères les données du formulaire dans "listTopics" afin d'ajouter un nouveau topic
    public function addTopic()
    {
        $title = filter_input(INPUT_POST,"title", FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
        $content = filter_input(INPUT_POST,"content", FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
        $categoryId = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT) ?? null;

        if ($title && $content && $categoryId)
        {
            $userId = 2;

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
            $this->redirectTo("forum","listTopicsByCategory", $categoryId);
        }
    }
}
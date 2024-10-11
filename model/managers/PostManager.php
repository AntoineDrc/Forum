<?php 

namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager
{
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct()
    {
        parent::connect();
    }

    // Récupère tout les posts d'un topic spécifique
    public function findPostsByTopic($id)
    {
        $sql = 
            "
            SELECT * 
            FROM " . $this->tableName . "
            WHERE topic_id = :id
            ORDER BY creationDate ASC
            ";

        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  
            $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    // Méthode pour ajouter un post à un topic
    public function add($data)
    { 
        $sql = 
            "
            INSERT INTO post (content, creationDate, user_id, topic_id)
            VALUES (:content, :creationDate, :user_id, :topic_id)
            ";

        DAO::insert($sql, $data);
    }

    
    // Rend anonyme les posts d'un utilisateut supprimé
    public function anonimyzePostsByUser($id)
    {
        $sql = 
        "
            UPDATE post
            SET user_id = NULL
            WHERE user_id = :userId
        ";

        DAO::update($sql, ["userId" => $id]);
    }
}


?>

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
            JOIN topic ON topic.id_topic = post.topic_id
            WHERE post.topic_id = :id
            ";

        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  
            $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    
}
?>

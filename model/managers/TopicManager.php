<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) 
    {

        $sql = "
                SELECT *
                FROM " . $this->tableName . "
                WHERE category_id = :id
                ORDER BY creationDate DESC";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  
            $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    // Méthode pour ajouter un topic
    public function add($data)
    {
        $sql = 
        "
            INSERT INTO topic (title, creationDate, user_id, category_id)
            VALUES (:title, :creationDate, :user_id, :category_id)
        ";

        DAO::insert($sql, $data);

        // Récupère l'ID du dernier enregistrement
        return DAO::getDb()->lastInsertId();
    }

    // Vérifie si un topic exist
    public function topicExist($id)
    {
        $sql = 
        "
            SELECT *
            FROM topic
            WHERE id_topic = :id
        ";

        $result = DAO::select($sql, ['id'=>$id], false);
        return $result;
    }

    // Méthode pour mettre à jour le status d'un topic
    public function updateTopicStatus($id, $status)
    {
        $sql = 
        "
            UPDATE topic
            SET closed = :status
            WHERE id_topic = :id
        ";

        DAO::update($sql, ['status' => $status, 'id' => $id]);
    }

    // Méthode pour obetnir le status d'un topic specifique
    public function getStatus($id)
    {
        $sql = 
        "
            SELECT closed
            FROM topic
            WHERE id_topic = :id
        ";

        return DAO::select($sql, ["id" => $id], false);
    }

    // Rend anonyme les topics d'un utilisateut supprimé
    public function anonimyzeTopicByUser($id)
    {
        $sql = 
        "
            UPDATE topic
            SET user_id = NULL
            WHERE user_id = :userId
        ";

        DAO::update($sql, ["userId" => $id]);
    }

    // Méthode pour supprimer un topic 
    public function deleteTopic($id)
    {
        $sql = 
        "
            DELETE FROM topic
            WHERE id_topic = :id
        ";

        DAO::delete($sql, ['id' => $id]);
    }
}
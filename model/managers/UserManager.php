<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;


class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    // Méthode pour vérifier un pseudo déja existant
    public function userNameExist($userName)
    {
        $sql = 
        "
            SELECT *
            FROM $this->tableName   
            WHERE userName = :userName
        ";

        return DAO::select($sql, ['userName' => $userName], false);
    }


    // Méthode pour ajouter un utilisateur
    public function addUser($data)
    {
        $sql = 
        "
            INSERT INTO user (userName, password, mail)
            VALUES (:userName, :password, :mail)
        ";

        DAO::insert($sql, $data);
    }
}
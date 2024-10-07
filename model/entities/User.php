<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity{

    private $id;
    private $userName;
    private $password;
    private $mail;
    private $registrationDate;
    private $role;

    private $isBanned;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate)
    {
        // Vérifie si la date est une chaîne de caractères 
        if (is_string($registrationDate)) {
            // Convertit en objet DateTime si la date est au format string
            $this->registrationDate = new \DateTime($registrationDate);
        } elseif ($registrationDate instanceof \DateTime) {
            // Si un objet DateTime, on l'assigne directement
            $this->registrationDate = $registrationDate;
        }
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function getIsBanned()
    {
        return $this->isBanned;
    }

    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    
    // Méthode pour récupérer la date formatée 
    public function getFormattedRegistrationDate()
    {
        if ($this->registrationDate instanceof \DateTime) {
            // Format personnalisé : 'd F Y at H:i'
            return $this->registrationDate->format('d F Y \a\t H:i');
        }

        return null; // Si registrationDate n'est pas défini ou incorrect
    }
    
    public function __toString() 
    {
        return $this->userName ?? '';
    }

}
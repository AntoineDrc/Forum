<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Topic extends Entity{

    private $id;
    private $title;
    private $creationDate;  
    private $user;
    private $category;
    private $closed;

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

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    
    public function getCategory()
    {
        return $this->category;
    }
    
    public function setCategory($category)
    {
        $this->category = $category;
        
        return $this;
    }
    
    public function getCreationDate()
    {
        return $this->creationDate;
    }
    
    public function setCreationDate($creationDate)
    {
        // Vérifie si la date est une chaîne de caractères 
        if (is_string($creationDate)) {
            // Convertit en objet DateTime si la date est au format string
            $this->creationDate = new \DateTime($creationDate);
        } elseif ($creationDate instanceof \DateTime) {
            // Si objet DateTime, on l'assigne directement
            $this->creationDate = $creationDate;
        }

        return $this;
    }
    
    public function getClosed()
    {
        return $this->closed;
    }
    
    public function setClosed($closed)
    {
        $this->closed = $closed;
        
        return $this;
    }

    public function __toString(){
        return $this->title;
    }

    // Méthode pour récupérer la date formatée 
    public function getFormattedCreationDate()
    {
        if ($this->creationDate instanceof \DateTime) {
            // Format personnalisé : 'd F Y at H:i'
            return $this->creationDate->format('d F Y \a\t H:i');
        }

        return null; // Si creationDate n'est pas défini ou incorrect
    }
}
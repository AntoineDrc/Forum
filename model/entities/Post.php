<?php 
namespace Model\Entities;

use App\Entity;

final class Post extends Entity
{
    private $id;
    private $content;
    private $creationDate;
    private $user;
    private $topic;

    // Constructeur en utilisant la méthode hydrate() de app/Entity
    public function __construct($data)
    {
        $this->hydrate($data);
    }

    // Getters / setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

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
            // Convertit en objet DateTime si la date est au format chaîne
            $this->creationDate = new \DateTime($creationDate);
        } elseif ($creationDate instanceof \DateTime) {
            // Si déjà un objet DateTime, on l'assigne directement
            $this->creationDate = $creationDate;
        }

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getTopic()
    {
        return $this->topic;
    }

    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    public function __toString()
    {
        return $this->content;
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



?>

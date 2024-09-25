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
        $this->creationDate = $creationDate;

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
}



?>

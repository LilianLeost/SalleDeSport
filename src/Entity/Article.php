<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $articleName;

    /**
     * @ORM\Column(type="text")
     */
    private $articleContent;

    /**
     * @return mixed
     */
    public function getArticleContent()
    {
        return $this->articleContent;
    }

    /**
     * @param mixed $articleContent
     * @return Article
     */
    public function setArticleContent($articleContent)
    {
        $this->articleContent = $articleContent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRubriques()
    {
        return $this->rubriques;
    }

    /**
     * @param mixed $rubriques
     * @return Article
     */
    public function setRubriques($rubriques)
    {
        $this->rubriques = $rubriques;
        return $this;
    }


    /**
     * @ORM\ManyToOne(targetEntity=Rubriques::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rubriques;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getArticleName()
    {
        return $this->articleName;
    }

    /**
     * @param mixed $articleName
     * @return Article
     */
    public function setArticleName($articleName)
    {
        $this->articleName = $articleName;
        return $this;
    }

}

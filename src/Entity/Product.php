<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $reference;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vegan;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bio;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cereale;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $source;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $code_barre;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getVegan(): ?bool
    {
        return $this->vegan;
    }

    public function setVegan(bool $vegan): self
    {
        $this->vegan = $vegan;

        return $this;
    }

    public function getBio(): ?bool
    {
        return $this->bio;
    }

    public function setBio(bool $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getCereale(): ?bool
    {
        return $this->cereale;
    }

    public function setCereale(bool $cereale): self
    {
        $this->cereale = $cereale;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getCodeBarre()
    {
        return $this->code_barre;
    }

    public function setCodeBarre($code_barre): self
    {
        $this->code_barre = $code_barre;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}

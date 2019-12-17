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
     * @Assert\Length(
     *     max = 100,
     *     maxMessage = "La réference ne doit pas excéder {{ limit }} caractères.")
     * @Assert\NotBlank
     */
    private $reference;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vegan;

    /**
     * @ORM\Column(type="boolean")
     */
    private $organic;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cereal;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $source;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $barCode;

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

    public function getOrganic(): ?bool
    {
        return $this->organic;
    }

    public function setOrganic(bool $organic): self
    {
        $this->organic = $organic;

        return $this;
    }

    public function getCereal(): ?bool
    {
        return $this->cereal;
    }

    public function setCereal(bool $cereal): self
    {
        $this->cereal = $cereal;

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

    public function getBarCode()
    {
        return $this->barCode;
    }

    public function setBarCode($barCode): self
    {
        $this->barCode = $barCode;

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

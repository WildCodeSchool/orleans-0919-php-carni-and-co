<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Type(type="bool")
     */
    private $vegan;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $organic;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $cereal;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $source;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Le code bar ne doit pas excéder {{ limit }} caractères.")
     */
    private $barCode;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Le lien de l'image ne doit pas excéder {{ limit }} caractères.")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Animal", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Food", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $food;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Bring", cascade={"persist", "remove"})
     */
    private $bring;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", inversedBy="products")
     */
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

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

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getFood(): ?Food
    {
        return $this->food;
    }

    public function setFood(?Food $food): self
    {
        $this->food = $food;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBring(): ?Bring
    {
        return $this->bring;
    }

    public function setBring(?Bring $bring): self
    {
        $this->bring = $bring;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredients): self
    {
        if (!$this->ingredients->contains($ingredients)) {
            $this->ingredients[] = $ingredients;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredients): self
    {
        if ($this->ingredients->contains($ingredients)) {
            $this->ingredients->removeElement($ingredients);
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 * @UniqueEntity("name")
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\Length(
     *     max = 80,
     *     maxMessage = "Le nom de l'ingrédient ne doit pas excéder {{ limit }} caractères.")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Type(type="bool")
     */
    private $precisedType;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Type(type="bool")
     */
    private $precisedPart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\LessThanOrEqual(
     *     value = 20,
     *     message = "La note ne doit pas excéder {{ compared_value }}."
     * )
     * @Assert\PositiveOrZero(
     *     message = "La note doit être positive."
     * )
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Origin", inversedBy="ingredients")
     */
    private $origin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shape", inversedBy="ingredients")
     */
    private $shape;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NutrientType", inversedBy="ingredients")
     */
    private $nutrientType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", mappedBy="ingredient")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrecisedType(): ?bool
    {
        return $this->precisedType;
    }

    public function setPrecisedType(?bool $precisedType): self
    {
        $this->precisedType = $precisedType;

        return $this;
    }

    public function getPrecisedPart(): ?bool
    {
        return $this->precisedPart;
    }

    public function setPrecisedPart(?bool $precisedPart): self
    {
        $this->precisedPart = $precisedPart;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getOrigin(): ?Origin
    {
        return $this->origin;
    }

    public function setOrigin(?Origin $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getShape(): ?Shape
    {
        return $this->shape;
    }

    public function setShape(?Shape $shape): self
    {
        $this->shape = $shape;

        return $this;
    }

    public function getNutrientType(): ?NutrientType
    {
        return $this->nutrientType;
    }

    public function setNutrientType(?NutrientType $nutrientType): self
    {
        $this->nutrientType = $nutrientType;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addIngredient($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $product->removeIngredient($this);
        }

        return $this;
    }
}

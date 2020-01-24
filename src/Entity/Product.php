<?php

namespace App\Entity;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Vich\Uploadable
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
     * @ORM\Column(type="string", length=255 ,nullable=true)
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "La source ne doit pas excéder {{ limit }} caractères.")
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     *
     * @Vich\UploadableField(mapping="pictures", fileNameProperty="image")
     *
     * @var File|null
     * @Assert\File(
     *    maxSize = "500k",
     *    maxSizeMessage = "L'image ne doit pas faire plus de {{ limit }} mega-octets.",
     *    mimeTypes = {"image/gif", "image/jpeg", "image/png", "image/svg+xml", "image/webp"},
     *    mimeTypesMessage = "Format d'image non reconnu. Veuillez choisir une nouvelle image."
     *)
     */
    private $imageFile;

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
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTimeInterface
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Composition", mappedBy="product")
     */
    private $compositions;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\LessThanOrEqual(
     *     value = 20,
     *     message = "La note ne doit pas excéder {{ compared_value }}."
     * )
     * @Assert\PositiveOrZero(
     *     message = "La note doit être positive."
     * )
     */
    private $note;

    public function __construct()
    {
        $this->compositions = new ArrayCollection();
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

    /**
     * @param File|UploadedFile $imageFile
     * @throws Exception
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    public function setBring(Bring $bring): self
    {
        $this->bring = $bring;

        return $this;
    }

    /**
     * @return Collection|Composition[]
     */
    public function getCompositions(): Collection
    {
        return $this->compositions;
    }

    public function addComposition(Composition $composition): self
    {
        if (!$this->compositions->contains($composition)) {
            $this->compositions[] = $composition;
            $composition->setProduct($this);
        }

        return $this;
    }

    public function removeComposition(Composition $composition): self
    {
        if ($this->compositions->contains($composition)) {
            $this->compositions->removeElement($composition);
            // set the owning side to null (unless already changed)
            if ($composition->getProduct() === $this) {
                $composition->setProduct(null);
            }
        }

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
}

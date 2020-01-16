<?php

namespace App\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 * @Vich\Uploadable
 */
class Animal
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
     *     maxMessage = "Le nom de l'animal ne doit pas excéder {{ limit }} caractères.")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     ** @Assert\NotBlank()
     */
    private $description;

    /**
     *
     * @Vich\UploadableField(mapping="pictures", fileNameProperty="image")
     *
     * @var File|null
     * @Assert\File(
     *    maxSize = "200k",
     *    maxSizeMessage = "L'image ne doit pas faire plus de {{ limit }} mega-octets.",
     *    mimeTypes = {"image/gif", "image/jpeg", "image/png", "image/svg+xml", "image/webp"},
     *    mimeTypesMessage = "Format d'image non reconnu. Veuillez choisir une nouvelle image."
     *)
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     ** @Assert\NotBlank()
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="animal", orphanRemoval=true)
     */
    private $products;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTimeImmutable
     */
    private $updatedAt;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $product->setAnimal($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getAnimal() === $this) {
                $product->setAnimal(null);
            }
        }

        return $this;
    }
}

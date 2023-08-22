<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Supplier::class, inversedBy="books")
     */
    private $supplier;

    /**
     * @ORM\OneToMany(targetEntity=BorrowBook::class, mappedBy="book")
     */
    private $borrowBooks;

    public function __construct()
    {
        $this->borrowBooks = new ArrayCollection();
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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * @return Collection<int, BorrowBook>
     */
    public function getBorrowBooks(): Collection
    {
        return $this->borrowBooks;
    }

    public function addBorrowBook(BorrowBook $borrowBook): self
    {
        if (!$this->borrowBooks->contains($borrowBook)) {
            $this->borrowBooks[] = $borrowBook;
            $borrowBook->setBook($this);
        }

        return $this;
    }

    public function removeBorrowBook(BorrowBook $borrowBook): self
    {
        if ($this->borrowBooks->removeElement($borrowBook)) {
            // set the owning side to null (unless already changed)
            if ($borrowBook->getBook() === $this) {
                $borrowBook->setBook(null);
            }
        }

        return $this;
    }

    public function __toString() 
    {
        return (string) $this->name; 
    }
}

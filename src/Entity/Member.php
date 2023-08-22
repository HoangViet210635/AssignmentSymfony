<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 */
class Member
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
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;

    /**
     * @ORM\OneToMany(targetEntity=BorrowBook::class, mappedBy="member")
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

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
            $borrowBook->setMember($this);
        }

        return $this;
    }

    public function removeBorrowBook(BorrowBook $borrowBook): self
    {
        if ($this->borrowBooks->removeElement($borrowBook)) {
            // set the owning side to null (unless already changed)
            if ($borrowBook->getMember() === $this) {
                $borrowBook->setMember(null);
            }
        }

        return $this;
    }

    public function __toString() 
    {
        return (string) $this->name; 
    }
}

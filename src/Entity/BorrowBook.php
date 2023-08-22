<?php

namespace App\Entity;

use App\Repository\BorrowBookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BorrowBookRepository::class)
 */
class BorrowBook
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="borrowBooks")
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="borrowBooks")
     */
    private $book;

    /**
     * @ORM\Column(type="date")
     */
    private $borrowDate;

    /**
     * @ORM\Column(type="date")
     */
    private $returnDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getBorrowDate(): ?\DateTimeInterface
    {
        return $this->borrowDate;
    }

    public function setBorrowDate(\DateTimeInterface $borrowDate): self
    {
        $this->borrowDate = $borrowDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    public function __toString() 
    {
        return (string) $this->name; 
    }
}

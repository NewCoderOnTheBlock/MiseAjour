<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaiementRepository")
 */
class Paiement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="bigint")
     * @Assert\Length(min=12,  max=19  )
     */
    private $numeroCarte;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8 , max=255)
     */
    private $nomCarte;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCarte;

    /**
     * @ORM\Column(type="integer")
     */
    private $cvcCarte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNumeroCarte(): ?int
    {
        return $this->numeroCarte;
    }

    public function setNumeroCarte(int $numeroCarte): self
    {
        $this->numeroCarte = $numeroCarte;

        return $this;
    }

    public function getNomCarte(): ?string
    {
        return $this->nomCarte;
    }

    public function setNomCarte(string $nomCarte): self
    {
        $this->nomCarte = $nomCarte;

        return $this;
    }

    public function getDateCarte(): ?\DateTimeInterface
    {
        return $this->dateCarte;
    }

    public function setDateCarte(\DateTimeInterface $dateCarte): self
    {
        $this->dateCarte = $dateCarte;

        return $this;
    }

    public function getCvcCarte(): ?int
    {
        return $this->cvcCarte;
    }

    public function setCvcCarte(int $cvcCarte): self
    {
        $this->cvcCarte = $cvcCarte;

        return $this;
    }
}

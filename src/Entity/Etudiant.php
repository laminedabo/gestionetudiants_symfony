<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naiss;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @ORM\OneToOne(targetEntity=EtudiantBoursier::class, inversedBy="etudiant", cascade={"persist", "remove"})
     */
    private $boursier;

    /**
     * @ORM\OneToOne(targetEntity=EtudiantLoge::class, inversedBy="etudiant", cascade={"persist", "remove"})
     */
    private $loge;

    /**
     * @ORM\OneToOne(targetEntity=EtudiantNonBoursier::class, inversedBy="etudiant", cascade={"persist", "remove"})
     */
    private $non_loge;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->date_naiss;
    }

    public function setDateNaiss(\DateTimeInterface $date_naiss): self
    {
        $this->date_naiss = $date_naiss;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getBoursier(): ?EtudiantBoursier
    {
        return $this->boursier;
    }

    public function setBoursier(?EtudiantBoursier $boursier): self
    {
        $this->boursier = $boursier;

        return $this;
    }

    public function getLoge(): ?EtudiantLoge
    {
        return $this->loge;
    }

    public function setLoge(?EtudiantLoge $loge): self
    {
        $this->loge = $loge;

        return $this;
    }

    public function getNonLoge(): ?EtudiantNonBoursier
    {
        return $this->non_loge;
    }

    public function setNonLoge(?EtudiantNonBoursier $non_loge): self
    {
        $this->non_loge = $non_loge;

        return $this;
    }
}

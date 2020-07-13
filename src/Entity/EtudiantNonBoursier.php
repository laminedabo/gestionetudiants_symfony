<?php

namespace App\Entity;

use App\Repository\EtudiantNonBoursierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantNonBoursierRepository::class)
 */
class EtudiantNonBoursier
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
    private $adresse;

    /**
     * @ORM\OneToOne(targetEntity=Etudiant::class, mappedBy="non_loge", cascade={"persist", "remove"})
     */
    private $etudiant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        // set (or unset) the owning side of the relation if necessary
        $newNon_loge = null === $etudiant ? null : $this;
        if ($etudiant->getNonLoge() !== $newNon_loge) {
            $etudiant->setNonLoge($newNon_loge);
        }

        return $this;
    }
}

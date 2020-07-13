<?php

namespace App\Entity;

use App\Repository\EtudiantBoursierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantBoursierRepository::class)
 */
class EtudiantBoursier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $motant_bourse;

    /**
     * @ORM\OneToOne(targetEntity=Etudiant::class, mappedBy="boursier", cascade={"persist", "remove"})
     */
    private $etudiant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotantBourse(): ?int
    {
        return $this->motant_bourse;
    }

    public function setMotantBourse(int $motant_bourse): self
    {
        $this->motant_bourse = $motant_bourse;

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
        $newBoursier = null === $etudiant ? null : $this;
        if ($etudiant->getBoursier() !== $newBoursier) {
            $etudiant->setBoursier($newBoursier);
        }

        return $this;
    }
}

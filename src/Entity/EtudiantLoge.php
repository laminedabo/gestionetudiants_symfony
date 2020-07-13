<?php

namespace App\Entity;

use App\Repository\EtudiantLogeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantLogeRepository::class)
 */
class EtudiantLoge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Etudiant::class, mappedBy="loge", cascade={"persist", "remove"})
     */
    private $etudiant;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="etudiantLoges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chambre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        // set (or unset) the owning side of the relation if necessary
        $newLoge = null === $etudiant ? null : $this;
        if ($etudiant->getLoge() !== $newLoge) {
            $etudiant->setLoge($newLoge);
        }

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }
}

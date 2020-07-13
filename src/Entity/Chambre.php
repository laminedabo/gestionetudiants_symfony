<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
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
    private $num_chambre;

    /**
     * @ORM\ManyToOne(targetEntity=Batiment::class, inversedBy="chambres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $num_bat;

    /**
     * @ORM\OneToMany(targetEntity=EtudiantLoge::class, mappedBy="chambre")
     */
    private $etudiantLoges;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $type;

    public function __construct()
    {
        $this->etudiantLoges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumChambre(): ?int
    {
        return $this->num_chambre;
    }

    public function setNumChambre(int $num_chambre): self
    {
        $this->num_chambre = $num_chambre;

        return $this;
    }

    public function getNumBat(): ?Batiment
    {
        return $this->num_bat;
    }

    public function setNumBat(?Batiment $num_bat): self
    {
        $this->num_bat = $num_bat;

        return $this;
    }

    /**
     * @return Collection|EtudiantLoge[]
     */
    public function getEtudiantLoges(): Collection
    {
        return $this->etudiantLoges;
    }

    public function addEtudiantLoge(EtudiantLoge $etudiantLoge): self
    {
        if (!$this->etudiantLoges->contains($etudiantLoge)) {
            $this->etudiantLoges[] = $etudiantLoge;
            $etudiantLoge->setChambre($this);
        }

        return $this;
    }

    public function removeEtudiantLoge(EtudiantLoge $etudiantLoge): self
    {
        if ($this->etudiantLoges->contains($etudiantLoge)) {
            $this->etudiantLoges->removeElement($etudiantLoge);
            // set the owning side to null (unless already changed)
            if ($etudiantLoge->getChambre() === $this) {
                $etudiantLoge->setChambre(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}

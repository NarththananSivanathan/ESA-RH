<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $salaire = null;

    #[ORM\Column(length: 255)]
    private ?string $etude_min = null;

    #[ORM\Column(length: 255)]
    private ?string $experience_min = null;

    #[ORM\Column(length: 255)]
    private ?string $type_contrat = null;

    #[ORM\Column(length: 255)]
    private ?string $nb_heure = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $prerequis = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?Entreprise $idEntreprise = null;

    #[ORM\OneToMany(targetEntity: Candidature::class, mappedBy: 'idOffre')]
    private Collection $candidatures;

    public function __construct()
    {
        $this->candidatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(?string $salaire): static
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getEtudeMin(): ?string
    {
        return $this->etude_min;
    }

    public function setEtudeMin(string $etude_min): static
    {
        $this->etude_min = $etude_min;

        return $this;
    }

    public function getExperienceMin(): ?string
    {
        return $this->experience_min;
    }

    public function setExperienceMin(string $experience_min): static
    {
        $this->experience_min = $experience_min;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->type_contrat;
    }

    public function setTypeContrat(string $type_contrat): static
    {
        $this->type_contrat = $type_contrat;

        return $this;
    }

    public function getNbHeure(): ?string
    {
        return $this->nb_heure;
    }

    public function setNbHeure(string $nb_heure): static
    {
        $this->nb_heure = $nb_heure;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrerequis(): ?string
    {
        return $this->prerequis;
    }

    public function setPrerequis(string $prerequis): static
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    public function getIdEntreprise(): ?Entreprise
    {
        return $this->idEntreprise;
    }

    public function setIdEntreprise(?Entreprise $idEntreprise): static
    {
        $this->idEntreprise = $idEntreprise;

        return $this;
    }

    /**
     * @return Collection<int, Candidature>
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): static
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures->add($candidature);
            $candidature->setIdOffre($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): static
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getIdOffre() === $this) {
                $candidature->setIdOffre(null);
            }
        }

        return $this;
    }
}

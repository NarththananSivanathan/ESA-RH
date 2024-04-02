<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
class Candidature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $statut_candidature = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?Offre $idOffre = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?Candidat $idCandidat = null;

    #[ORM\Column(options:['default' => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeImmutable $date_candidature = null;

    public function __construct()
    {
        $this->date_candidature = new \DateTimeImmutable();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatutCandidature(): ?string
    {
        return $this->statut_candidature;
    }

    public function setStatutCandidature(string $statut_candidature): static
    {
        $this->statut_candidature = $statut_candidature;

        return $this;
    }

    public function getIdOffre(): ?Offre
    {
        return $this->idOffre;
    }

    public function setIdOffre(?Offre $idOffre): static
    {
        $this->idOffre = $idOffre;

        return $this;
    }

    public function getIdCandidat(): ?Candidat
    {
        return $this->idCandidat;
    }

    public function setIdCandidat(?Candidat $idCandidat): static
    {
        $this->idCandidat = $idCandidat;

        return $this;
    }

    public function getDateCandidature(): ?\DateTimeImmutable
    {
        return $this->date_candidature;
    }

    public function setDateCandidature(?\DateTimeImmutable $date_candidature): void
    {
        $this->date_candidature = $date_candidature;
    }
}

<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
class Candidature
{
    public const STATUT_PENDING = "pending";
    public const STATUT_ACCEPTED = "accepted";
    public const STATUT_REFUSED = "refused";
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $statut_candidature = self::STATUT_PENDING;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?Offre $idOffre = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?Candidat $idCandidat = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $message = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CV = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lettre_de_motivation = null;


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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getCV(): ?string
    {
        return $this->CV;
    }

    public function setCV(?string $CV): static
    {
        $this->CV = $CV;

        return $this;
    }

    public function getLettreDeMotivation(): ?string
    {
        return $this->lettre_de_motivation;
    }

    public function setLettreDeMotivation(?string $lettre_de_motivation): static
    {
        $this->lettre_de_motivation = $lettre_de_motivation;

        return $this;
    }
}

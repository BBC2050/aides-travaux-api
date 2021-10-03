<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Traits\HasConditionsTrait;
use App\Entity\Traits\HasValeursTrait;
use App\Repository\DispositifRepository;

/**
 * @UniqueEntity(fields={"code", "secteur"})
 * @ORM\Entity(repositoryClass=DispositifRepository::class)
 * @ORM\Table(name="api_dispositif")
 * @Vich\Uploadable
 */
class Dispositif
{
    use HasConditionsTrait, HasValeursTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    #[Groups(groups: ['dispositif:read'])]
    private ?int $id = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $dateUpload = null;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="datetime")
     */
    #[Groups(groups: ['dispositif:read', 'dispositif:write'])]
    private ?\DateTimeInterface $dateDebut = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    #[Groups(groups: ['dispositif:read', 'dispositif:write'])]
    private ?\DateTimeInterface $dateFin = null;

    /**
     * Code interne
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=40)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['dispositif:read', 'dispositif:write'])]
    private ?string $code = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['dispositif:read', 'dispositif:write'])]
    private ?string $nom = null;

    /**
     * Norme RFC7764
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=2000)
     * 
     * @ORM\Column(type="text")
     */
    #[Groups(groups: ['dispositif:read', 'dispositif:write'])]
    private ?string $description = null;

    /**
     * @Assert\NotBlank
     * @Assert\Choice(choices=Dispositif::TYPES)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['dispositif:read', 'dispositif:write'])]
    private ?string $type = null;

    /**
     * @Assert\NotNull
     * @Assert\Type("bool")
     * 
     * @ORM\Column(type="boolean")
     */
    #[Groups(groups: ['dispositif:read', 'dispositif:write'])]
    private ?bool $active = false;

    /**
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=Secteur::class)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    #[Groups(groups: ['secteur:read', 'dispositif:write'])]
    private ?Secteur $secteur = null;

    /**
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=Distributeur::class)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    #[Groups(groups: ['distributeur:read', 'dispositif:write'])]
    private ?Distributeur $distributeur = null;

    /**
     * Liste des zones éligibles au dispositif
     * 
     * @var Collection|Zone[]
     * 
     * @Assert\Valid
     * 
     * @ORM\OneToMany(targetEntity=Zone::class, mappedBy="dispositif", cascade={"persist", "remove"})
     */
    #[Groups(groups: ['zone:read', 'zone:write'])]
    private Collection $zones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $logoPath = null;

    #[Groups(groups: ['dispositif:read'])]
    private ?string $logoUrl = null;

    /**
     * @Assert\NotBlank(groups={"create"})
     * @Assert\File(maxSize = "25k")
     * @Assert\Image(
     *      minWidth = 80,
     *      maxWidth = 80,
     *      minHeight = 80,
     *      maxHeight = 80
     * )
     * 
     * @Vich\UploadableField(mapping="dispositifs", fileNameProperty="logoPath")
     */
    private ?File $file = null;

    /**
     * Liste des offres
     * 
     * @var Collection|Offre[]
     * 
     * @Assert\Valid
     * 
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="dispositif", cascade={"persist", "remove"})
     */
    private Collection $offres;

    /**
     * Liste des conditions applicables à chaque offre et au global
     * 
     * @var Collection|Condition[]
     * 
     * @Assert\Valid
     * 
     * @ORM\ManyToMany(targetEntity=Condition::class, orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_dispositif_condition")
     */
    #[Groups(groups: ['condition:read', 'condition:write'])]
    protected Collection $conditions;

    /**
     * Liste des valeurs applicables à chaque offre et au global pour les plafonds et planchers
     * 
     * @var Collection|Valeur[]
     * 
     * @Assert\Valid(groups={"Default", "dispositif"})
     * 
     * @ORM\ManyToMany(targetEntity=Valeur::class, orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_dispositif_valeur")
     */
    #[Groups(groups: ['valeur:read', 'valeur:write'])]
    protected Collection $valeurs;

    /**
     * Liste des dispositifs non cumulables
     * 
     * @var Collection|Dispositif[]
     * 
     * @ORM\ManyToMany(targetEntity=Dispositif::class, orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_dispositif_exclusion")
     */
    #[Groups(groups: ['dispositif:read', 'dispositif:write'])]
    private Collection $exclusions;

    /** 
     * Liste des types de dispositif autorisés
     * 
     * @var array
     */
    public const TYPES = [
        'prime', 'avance', 'exoneration', 'autres'
    ];

    // Getters & Setters

    public function __construct()
    {
        $this->zones = new ArrayCollection();
        $this->offres = new ArrayCollection();
        $this->conditions = new ArrayCollection();
        $this->valeurs = new ArrayCollection();
        $this->exclusions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateUpload(): ?\DateTimeInterface
    {
        return $this->dateUpload;
    }

    public function setDateUpload(?\DateTimeInterface $dateUpload): self
    {
        $this->dateUpload = $dateUpload;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }
    
    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getDistributeur(): ?Distributeur
    {
        return $this->distributeur;
    }

    public function setDistributeur(?Distributeur $distributeur): self
    {
        $this->distributeur = $distributeur;

        return $this;
    }

    public function getZones(): array
    {
        return $this->zones->getValues();
    }

    /**
     * @return Collection|Zone[]
     */
    public function getZonesCollection(): Collection
    {
        return $this->zones;
    }

    public function addZone(Zone $zone): self
    {
        if (!$this->zones->contains($zone)) {
            $this->zones[] = $zone;
            $zone->setDispositif($this);
        }

        return $this;
    }

    public function removeZone(Zone $zone): self
    {
        if ($this->zones->removeElement($zone)) {
            // set the owning side to null (unless already changed)
            if ($zone->getDispositif() === $this) {
                $zone->setDispositif(null);
            }
        }

        return $this;
    }

    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    public function setLogoPath(?string $logoPath): self
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getOffres(): array
    {
        return $this->offres->getValues();
    }

    /**
     * @return Collection|Offre[]
     */
    public function getOffresCollection(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setDispositif($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getDispositif() === $this) {
                $offre->setDispositif(null);
            }
        }

        return $this;
    }

    public function getExclusions(): array
    {
        return $this->exclusions->getValues();
    }

    public function getExclusionsCollection(): Collection
    {
        return $this->exclusions;
    }

    public function addExclusion(Dispositif $dispositif): self
    {
        if (!$this->exclusions->contains($dispositif)) {
            $this->exclusions[] = $dispositif;
        }

        return $this;
    }

    public function removeExclusion(Dispositif $dispositif): self
    {
        if ($this->exclusions->contains($dispositif)) {
            $this->exclusions->removeElement($dispositif);
        }

        return $this;
    }

    // Validation

    /**
     * Les valeurs globales ne peuvent accépter les variables intermédiaires et les variables de travaux 
     * 
     * @Assert\IsTrue
     */
    public function isValeursValid(): bool
    {
        foreach ($this->valeurs as $valeur) {
            if ($valeur->getGlobale() === true) {
                foreach ($valeur->getVariables() as $variable) {
                    if (\in_array(\substr($variable, 0, 2), ['$T', '$I'])) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * @Assert\Date
     */
    public function isDateDebutValid(): ?string
    {
        return $this->dateDebut ? $this->dateDebut->format('Y-m-d') : null;
    }

    /**
     * @Assert\Date
     */
    public function isDateFinValid(): ?string
    {
        return $this->dateFin ? $this->dateFin->format('Y-m-d') : null;
    }

    // Méthodes calculées

    public function getVariables(): array
    {
        $variables = [];

        foreach ($this->valeurs as $valeur) {
            $variables = \array_merge($variables, $valeur->getVariables());
        }
        return \array_values(\array_unique($variables));
    }

}

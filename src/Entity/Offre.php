<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\OffreRepository;
use App\Resolver\ConditionsResolver;
use App\Resolver\ValeurResolver;
use App\Helper\Helpers;
use App\Services\Assistant;

/**
 * @ApiResource(
 *      normalizationContext={
 *          "groups"={"offre:item:read"}
 *      },
 *      denormalizationContext={
 *          "groups"={"offre:item:write"}
 *      },
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"offre:collection:read"}
 *              }
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      },
 *      itemOperations={
 *          "get",
 *          "put"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      }
 * )
 * 
 * @ApiFilter(SearchFilter::class, properties={
 *      "aide": "exact",
 *      "ouvrages": "exact"
 * })
 * 
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 * @ORM\Table(name="api_offre")
 */
class Offre
{
    use Helpers;

    /**
     * @var int
     * 
     * @Groups({
     *      "offre:item:read",
     *      "offre:collection:read",
     *      "aide:item:read",
     *      "simulation:item:read",
     * })
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Nom de l'offre
     * 
     * @var string
     * 
     * @Groups({
     *      "offre:item:read", 
     *      "offre:collection:read", 
     *      "offre:item:write",
     *      "aide:item:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    private $nom;

    /**
     * Fiche d'opération standardisée (Certificat d'économies d'énergie)
     * 
     * @var string|null
     * 
     * @Groups({
     *      "offre:item:read", 
     *      "offre:collection:read", 
     *      "offre:item:write",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $fiche;

    /**
     * Ressources externes
     * 
     * @var array|null
     * 
     * @Groups({
     *      "offre:item:read", 
     *      "offre:collection:read", 
     *      "offre:item:write",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\Type("array")
     * @Assert\All({
     *     @Assert\Type("array"),
     *     @Assert\Collection(
     *          fields = {
     *              "texte" = {
     *                  @Assert\NotBlank,
     *                  @Assert\Type("string"),
     *                  @Assert\Length(max = 100)
     *              },
     *              "url" = {
     *                  @Assert\NotBlank,
     *                  @Assert\Url,
     *              }
     *          },
     *          allowMissingFields = false
     *      )
     * })
     * 
     * @ORM\Column(type="array", nullable=true)
     */
    private $ressources = [];

    /**
     * Statut de l'offre
     * 
     * @var bool
     * 
     * @Groups({
     *      "offre:item:read", 
     *      "offre:collection:read", 
     *      "offre:item:write",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotNull
     * @Assert\Type("bool")
     * 
     * @ORM\Column(type="boolean")
     */
    private $active = false;

    /**
     * Aide de référence
     * 
     * @var Aide
     * 
     * @Groups({
     *      "offre:collection:read",
     *      "offre:item:read", 
     *      "offre:item:write",
     * })
     * 
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=Aide::class, inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aide;

    /**
     * Liste des ouvrages
     * 
     * @var Collection|Ouvrage[]
     * 
     * @Groups({
     *      "offre:collection:read",
     *      "offre:item:read", 
     *      "offre:item:write"
     * })
     * 
     * @ORM\ManyToMany(targetEntity=Ouvrage::class, inversedBy="offres")
     * @ORM\JoinTable(name="api_offre_ouvrage")
     */
    private $ouvrages;

    /**
     * Liste des valeurs
     * 
     * @var Collection|Valeur[]
     * 
     * @Groups({
     *      "offre:item:read", 
     *      "offre:item:write"
     * })
     * 
     * @ORM\ManyToMany(
     *      targetEntity=Valeur::class,
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     * )
     * @ORM\JoinTable(name="api_offre_valeur")
     */
    private $valeurs;

    /**
     * Liste des conditions à satisfaire
     * 
     * @var Collection|Condition[]
     * 
     * @Groups({
     *      "offre:item:read", 
     *      "offre:item:write",
     *      "simulation:item:read"
     * })
     * 
     * @ORM\ManyToMany(
     *      targetEntity=Condition::class,
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     * )
     * @ORM\JoinTable(name="api_offre_condition")
     */
    private $conditions;

    /**
     * Liste des variables
     * 
     * @var Collection|Variable[]
     * 
     * @Groups({"offre:item:read", "offre:collection:read"})
     * 
     * @ORM\ManyToMany(targetEntity=Variable::class)
     * @ORM\JoinTable(name="api_offre_variable")
     */
    private $variables;

    /**
     * Ouvrage simulé
     * 
     * @var SimulationOuvrage|null
     */
    private $ouvrage;

    public function __construct()
    {
        $this->valeurs = new ArrayCollection();
        $this->conditions = new ArrayCollection();
        $this->ouvrages = new ArrayCollection();
        $this->variables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFiche(): ?string
    {
        return $this->fiche;
    }

    public function setFiche(?string $fiche): self
    {
        $this->fiche = $fiche;

        return $this;
    }

    public function getRessources(): ?array
    {
        return $this->ressources;
    }

    public function setRessources(?array $ressources): self
    {
        $this->ressources = $ressources;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getAide(): ?Aide
    {
        return $this->aide;
    }

    public function setAide(?Aide $aide): self
    {
        $this->aide = $aide;

        return $this;
    }

    /**
     * @return Collection|Ouvrage[]
     */
    public function getOuvrages(): Collection
    {
        return $this->ouvrages;
    }

    public function addOuvrage(Ouvrage $ouvrage): self
    {
        if (!$this->ouvrages->contains($ouvrage)) {
            $this->ouvrages[] = $ouvrage;
        }

        return $this;
    }

    public function removeOuvrage(Ouvrage $ouvrage): self
    {
        if ($this->ouvrages->contains($ouvrage)) {
            $this->ouvrages->removeElement($ouvrage);
        }

        return $this;
    }

    /**
     * @return Collection|Valeur[]
     */
    public function getAllValeurs(): Collection
    {
        return new ArrayCollection(\array_merge(
            $this->aide->getValeurs()->toArray(), $this->valeurs->toArray()
        ));
    }

    public function getValeurs(): Collection
    {
        return $this->valeurs;
    }

    public function addValeur(Valeur $valeur): self
    {
        if (!$this->valeurs->contains($valeur)) {
            $this->valeurs[] = $valeur;
        }

        return $this;
    }

    public function removeValeur(Valeur $valeur): self
    {
        if ($this->valeurs->contains($valeur)) {
            $this->valeurs->removeElement($valeur);
        }

        return $this;
    }

    /**
     * @return Collection|Condition[]
     */
    public function getAllConditions(): Collection
    {
        return new ArrayCollection(\array_merge(
            $this->aide->getConditions()->toArray(), $this->conditions->toArray()
        ));
    }

    /**
     * @return Collection|Condition[]
     */
    public function getConditions(): Collection
    {
        return $this->conditions;
    }

    public function addCondition(Condition $condition): self
    {
        if (!$this->conditions->contains($condition)) {
            $this->conditions[] = $condition;
        }

        return $this;
    }

    public function removeCondition(Condition $condition): self
    {
        if ($this->conditions->contains($condition)) {
            $this->conditions->removeElement($condition);
        }

        return $this;
    }

    /**
     * @return Collection|Variable[]
     */
    public function getVariables(): Collection
    {
        return $this->variables;
    }

    public function toArrayVariables(): array
    {
        return $this->variables->getValues();
    }

    public function addVariable(Variable $variable): self
    {
        if (!$this->variables->contains($variable)) {
            $this->variables[] = $variable;
        }

        return $this;
    }

    public function removeVariable(Variable $variable): self
    {
        if ($this->variables->contains($variable)) {
            $this->variables->removeElement($variable);
        }

        return $this;
    }

    public function getOuvrage(): ?SimulationOuvrage
    {
        return $this->ouvrage;
    }

    public function setOuvrage(?SimulationOuvrage $ouvrage): self
    {
        $this->ouvrage = $ouvrage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function get(string $name)
    {
        // Données d'entrée globales et par ouvrage
        $variables = \array_merge(
            $this->ouvrage->getVariables(),
            $this->ouvrage->getSimulation()->getVariables()
        );

        if (\array_key_exists($name, $variables)) {
            return $variables[$name];
        }
        if (\array_key_exists($name, Assistant::HELPERS)) {
            $method = Assistant::HELPERS[$name]['method'];

            if (\method_exists($this, $method)) {
                return $this->$method();
            }
        }
        return null;
    }

    public function isCumulable(Offre $offre): bool
    {
        $aidesCumulables = $this->aide->getAidesCumulables()->map(function(Aide $aide) {
            return $aide->getId();
        })->getValues();

        return \in_array($offre->getAide()->getId(), $aidesCumulables);
    }

    /**
     * @Groups({"simulation:offre:item:read"})
     */
    public function getAideId()
    {
        return $this->aide->getId();
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function isEligible(): bool
    {
        return ConditionsResolver::isEligible($this->getAllConditions());
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function getBase(): float
    {
        $valeurs = $this->getValeurs()
            ->filter(function(Valeur $valeur) {
                return $valeur->getType() === 'montant';
            })
            ->filter(function(Valeur $valeur) {
                return ConditionsResolver::isEligible($valeur->getConditions());
            })
            ->map(function(Valeur $valeur) {
                return $valeur->getExpression()->getResponse();
            });

        return $valeurs->count() === 0 ? (float) 0 : \max($valeurs->toArray());
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function getPlafond(): ?float
    {
        $plafonds = $this->getAllValeurs()
            ->filter(function(Valeur $valeur) {
                return $valeur->getType() === 'plafond';
            })
            ->filter(function(Valeur $valeur) {
                return ConditionsResolver::isEligible($valeur->getConditions());
            })
            ->map(function(Valeur $valeur) {
                return $valeur->getExpression()->getResponse();
            })
            ->getValues();

        return $plafonds ? (float) \min($plafonds) : null;
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function getMontantBrut()
    {
        $montant = ValeurResolver::applyFacteurs($this->getBase(), $this->valeurs);
        $montant = ValeurResolver::applyTermes($montant, $this->valeurs);

        $montant = ValeurResolver::applyFacteurs($montant, $this->aide->getValeurs());
        $montant = ValeurResolver::applyTermes($montant, $this->aide->getValeurs());

        return $montant;
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function getMontant(): float
    {
        return \min(
            ValeurResolver::applyPlafonds($this->getMontantBrut(), $this->valeurs),
            ValeurResolver::applyPlafonds($this->getMontantBrut(), $this->aide->getValeurs())
        );
    }

}

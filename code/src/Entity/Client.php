<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Form\Validator\UniqueClientPhoneNumber\UniqueClientPhoneNumberAuthor;


#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "L'entreprise ne doit pas être vide.")]
    #[Assert\Length(max: 100, maxMessage: "L'entreprise ne doit pas dépasser {{ limit }} caractères.")]
    private ?string $entreprise = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le numéro de téléphone est obligatoire.")]
    #[Assert\Length(max: 30, maxMessage: "Le numéro de téléphone ne doit pas dépasser {{ limit }} caractères.")]
    #[Assert\Regex(pattern: "/^\+?[0-9]+$/",message: "Phone number must contain only digits, with an optional '+' at the beginning.")]
    #[UniqueClientPhoneNumberAuthor]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'adresse postale est obligatoire.")]
    #[Assert\Length(max: 255)]
    #[Assert\Regex(pattern: "/^[0-9]+$/",message: "Postal address must contain numbers only.")]
    private ?string $adressePostale = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La ville est obligatoire.")]
    #[Assert\Length(max: 100, maxMessage: "twil")]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le pays est obligatoire.")]
    #[Assert\Length(max: 100)]
    private ?string $pays = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    #[Assert\NotNull(message: "Un auteur est requis pour ce client.")]
    private ?User $author = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le manager est obligatoire.")]
    #[Assert\Length(max: 255)]
    private ?string $manager = null;


    /**
     * @var Collection<int, Facture>
     */
    #[ORM\OneToMany(targetEntity: Facture::class, mappedBy: 'owner')]
    private Collection $factures;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(?string $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getAdressePostale(): ?string
    {
        return $this->adressePostale;
    }

    public function setAdressePostale(string $adressePostale): static
    {
        $this->adressePostale = $adressePostale;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getManager(): ?string
    {
        return $this->manager;
    }

    public function setManager(string $manager): static
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return Collection<int, Facture>
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): static
    {
        if (!$this->factures->contains($facture)) {
            $this->factures->add($facture);
            $facture->setOwner($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): static
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getOwner() === $this) {
                $facture->setOwner(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $win = null;

    #[ORM\Column(length: 255)]
    private ?string $player = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $getDateTime = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?user $relation = null;

    #[ORM\ManyToMany(targetEntity: Card::class)]
    private Collection $cardsPlayer;

    #[ORM\ManyToMany(targetEntity: Card::class)]
    #[ORM\JoinTable(name: "cardsCpu")]
    private Collection $cardsCpu;

    public function __construct()
    {
        $this->cardsPlayer = new ArrayCollection();
        $this->cardsCpu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWin(): ?int
    {
        return $this->win;
    }

    public function setWin(int $win): static
    {
        $this->win = $win;

        return $this;
    }

    public function getPlayer(): ?string
    {
        return $this->player;
    }

    public function setPlayer(string $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getGetDateTime(): ?\DateTimeInterface
    {
        return $this->getDateTime;
    }

    public function setGetDateTime(\DateTimeInterface $getDateTime): static
    {
        $this->getDateTime = $getDateTime;

        return $this;
    }

    public function getRelation(): ?user
    {
        return $this->relation;
    }

    public function setRelation(?user $relation): static
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * @return Collection<int, Card>
     */
    public function getCardsPlayer(): Collection
    {
        return $this->cardsPlayer;
    }

    public function addCardsPlayer(Card $cardsPlayer): static
    {
        if (!$this->cardsPlayer->contains($cardsPlayer)) {
            $this->cardsPlayer->add($cardsPlayer);
        }

        return $this;
    }

    public function removeCardsPlayer(Card $cardsPlayer): static
    {
        $this->cardsPlayer->removeElement($cardsPlayer);

        return $this;
    }

    /**
     * @return Collection<int, Card>
     */
    public function getCardsCpu(): Collection
    {
        return $this->cardsCpu;
    }

    public function addCardCpu(Card $card): static
    {
        if (!$this->cardsCpu->contains($card)) {
            $this->cardsCpu->add($card);
        }

        return $this;
    }

    public function removeCardCpu(Card $card): static
    {
        $this->cardsCpu->removeElement($card);

        return $this;
    }
}

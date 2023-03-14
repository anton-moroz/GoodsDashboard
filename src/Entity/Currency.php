<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    /**
     * @var int|null
     */
    #[Assert\PositiveOrZero]
    #[Assert\Unique]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[Assert\Length(min: 2, max: 15)]
    #[Assert\Unique]
    #[ORM\Column(length: 15, unique: true)]
    private ?string $name = null;

    /**
     * @var string|null
     */
    #[Assert\Length(min: 2, max: 10)]
    #[Assert\Unique]
    #[ORM\Column(length: 10, unique: true)]
    private ?string $code = null;

    /**
     * @var ArrayCollection|Collection
     */
    #[ORM\OneToMany(mappedBy: 'currency', targetEntity: Good::class)]
    private Collection|ArrayCollection $goods;

    public function __construct()
    {
        $this->goods = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Good>
     */
    public function getGoods(): Collection
    {
        return $this->goods;
    }

    /**
     * @param Good $good
     *
     * @return $this
     */
    public function addGood(Good $good): self
    {
        if (!$this->goods->contains($good)) {
            $this->goods->add($good);
            $good->setCurrency($this);
        }

        return $this;
    }

    /**
     * @param Good $good
     *
     * @return $this
     */
    public function removeGood(Good $good): self
    {
        if ($this->goods->removeElement($good)) {
            // set the owning side to null (unless already changed)
            if ($good->getCurrency() === $this) {
                $good->setCurrency(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}

<?php

namespace App\Entity;

use App\Repository\GoodRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity('name')]
#[ORM\Entity(repositoryClass: GoodRepository::class)]
class Good
{
    /**
     * @var int|null
     */
    #[Assert\LessThanOrEqual(4294967295)]
    #[Assert\PositiveOrZero]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[Assert\Length(min: 3, max: 45)]
    #[ORM\Column(type: 'string', length: 45, unique: true)]
    private ?string $name = null;

    /**
     * @var float|null
     */
    #[Assert\PositiveOrZero]
    #[ORM\Column(type: 'float', precision: 2)]
    private ?float $price = null;

    /**
     * @var int|null
     */
    #[Assert\LessThanOrEqual(4294967295)]
    #[Assert\PositiveOrZero]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $quantity = null;

    /**
     * @var Currency|null
     */
    #[ORM\ManyToOne(inversedBy: 'good')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Currency $currency = null;

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
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return $this
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Currency|null
     */
    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    /**
     * @param Currency|null $currency
     *
     * @return $this
     */
    public function setCurrency(?Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }
}

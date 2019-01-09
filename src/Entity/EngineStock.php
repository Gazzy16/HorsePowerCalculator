<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EngineStockRepository")
 */
class EngineStock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $manufacturer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $production;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $block_alloy;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $configuration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valvetrain;

    /**
     * @ORM\Column(type="integer")
     */
    private $displacement;

    /**
     * @ORM\Column(type="integer")
     */
    private $hp;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_hp_at_rpm;

    /**
     * @ORM\Column(type="integer")
     */
    private $torque;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_torque_at_rpm;

    /**
     * @ORM\Column(type="integer")
     */
    private $redline;

    /**
     * @ORM\Column(type="integer")
     */
    private $lifespan;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_hp_stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProduction(): ?string
    {
        return $this->production;
    }

    public function setProduction(string $production): self
    {
        $this->production = $production;

        return $this;
    }

    public function getBlockAlloy(): ?string
    {
        return $this->block_alloy;
    }

    public function setBlockAlloy(string $block_alloy): self
    {
        $this->block_alloy = $block_alloy;

        return $this;
    }

    public function getConfiguration(): ?string
    {
        return $this->configuration;
    }

    public function setConfiguration(string $configuration): self
    {
        $this->configuration = $configuration;

        return $this;
    }

    public function getValvetrain(): ?string
    {
        return $this->valvetrain;
    }

    public function setValvetrain(string $valvetrain): self
    {
        $this->valvetrain = $valvetrain;

        return $this;
    }

    public function getDisplacement(): ?int
    {
        return $this->displacement;
    }

    public function setDisplacement(int $displacement): self
    {
        $this->displacement = $displacement;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getMaxHpAtRpm(): ?int
    {
        return $this->max_hp_at_rpm;
    }

    public function setMaxHpAtRpm(int $max_hp_at_rpm): self
    {
        $this->max_hp_at_rpm = $max_hp_at_rpm;

        return $this;
    }

    public function getTorque(): ?int
    {
        return $this->torque;
    }

    public function setTorque(int $torque): self
    {
        $this->torque = $torque;

        return $this;
    }

    public function getMaxTorqueAtRpm(): ?int
    {
        return $this->max_torque_at_rpm;
    }

    public function setMaxTorqueAtRpm(int $max_torque_at_rpm): self
    {
        $this->max_torque_at_rpm = $max_torque_at_rpm;

        return $this;
    }

    public function getRedline(): ?int
    {
        return $this->redline;
    }

    public function setRedline(int $redline): self
    {
        $this->redline = $redline;

        return $this;
    }

    public function getLifespan(): ?int
    {
        return $this->lifespan;
    }

    public function setLifespan(int $lifespan): self
    {
        $this->lifespan = $lifespan;

        return $this;
    }

    public function getMaxHpStock(): ?int
    {
        return $this->max_hp_stock;
    }

    public function setMaxHpStock(int $max_hp_stock): self
    {
        $this->max_hp_stock = $max_hp_stock;

        return $this;
    }
}

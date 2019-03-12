<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * One stock engine has many tuned engines.
     * @ORM\OneToMany(targetEntity="App\Entity\EngineTuned", mappedBy="stock")
     */
    private $tunedengines;
    
    /**
     * One stock engine has many upgrades.
     * @ORM\OneToMany(targetEntity="App\Entity\EngineTuned", mappedBy="stockupgrades")
     */
    private $stockupgrades;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $manufacturer;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('cast iron', 'aluminium alloy')")
     */
    private $block_alloy;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('V-shaped', 'W-shaped', 'Inline')")
     */
    private $configuration;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $number_of_cylinders;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('3', '4', '5')")
     */
    private $valves_per_cylinder;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $displacement;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $piston_stroke;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $cylinder_bore;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $hp;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $torque;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $redline;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $max_hp_stock;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="stockengines")
     */
    private $userstock;
    
    public function __construct()
    {
        $this->tunedstockengines = new ArrayCollection();
        $this->stockupgrades = new ArrayCollection();
    }
    
    public function getTunedStockEngines()
    {
        return $this->tunedstockengines;
    }
    public function addTunedStockEngine(?EngineTuned $tunedstockengine)
    {
        return $this->tunedstockengines->add($tunedstockengine);
    }
    public function removeTunedStockEngine(?EngineTuned $tunedstockengine)
    {
        return $this->tunedstockengines->remove($tunedstockengine);
    }
    
    public function getStockUpgrades()
    {
        return $this->stockupgrades;
    }
    public function addStockUpgrades(?EngineTuned $stockupgrades)
    {
        return $this->stockupgrades->add($stockupgrades);
    }
    public function removeStockUpgrades(?EngineTuned $stockupgrades)
    {
        return $this->stockupgrades->remove($stockupgrades);
    }

    public function getUserStockId() : ?int
    {
        return $this->userstock;
    }
    public function setUserStockId(?int $userstock)
    {
        $this->userstock = $userstock;
    }
    
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
    
    public function getNumberOfCylinders(): ?int
    {
        return $this->number_of_cylinders;
    }
    
    public function setNumberOfCylinders(string $number_of_cylinders): self
    {
        $this->number_of_cylinders = $number_of_cylinders;
        
        return $this;
    }
    
    public function getValvesPerCylinder(): ?string
    {
        return $this->valves_per_cylinder;
    }
    
    public function setValvesPerCylinder(string $valves_per_cylinder): self
    {
        $this->valves_per_cylinder = $valves_per_cylinder;
        
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
    
    public function getPistonStroke(): ?int
    {
        return $this->piston_stroke;
    }
    
    public function setPistonStroke(int $piston_stroke): self
    {
        $this->piston_stroke = $piston_stroke;
        
        return $this;
    }
    
    public function getCylinderBore(): ?int
    {
        return $this->cylinder_bore;
    }
    
    public function setCylinderBore(int $cylinder_bore): self
    {
        $this->cylinder_bore = $cylinder_bore;
        
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
    
    public function getTorque(): ?int
    {
        return $this->torque;
    }
    
    public function setTorque(int $torque): self
    {
        $this->torque = $torque;
        
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

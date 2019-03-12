<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EngineTunedRepository")
 */
class EngineTuned
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
    private $piston_stroke;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $cylinder_bore;
    
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tunedengines")
     */
    private $usertuned;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EngineStock", inversedBy="tunedstockengines")
     */
    private $stock;
    
    public function getUserTunedId() : ?User
    {
        return $this->usertuned;
    }
    public function setUserTunedId(?User $usertuned)
    {
        $this->usertuned = $usertuned;
    }
    
    public function getStockId() : ?EngineStock
    {
        return $this->stock;
    }
    public function setStockId(?EngineStock $stock)
    {
        $this->stock = $stock;
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
}

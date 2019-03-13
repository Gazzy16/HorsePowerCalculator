<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UpgradesRepository")
 */
class Upgrade
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('none', 'turbo', 'supercharger')")
     */
    private $forced_induction;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $psi;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('stock', 'street', 'sport', 'deleted')")
     */
    private $intake;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('stock', 'street', 'sport', 'type r')")
     */
    private $ecu;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('stock', 'street', 'sport', 'type r')")
     */
    private $pistons;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('stock', 'street', 'sport', 'type r')")
     */
    private $intercooler;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('stock', 'street', 'sport', 'type r')")
     */
    private $exhaust;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EngineStock", inversedBy="stockupgrades")
     */
    private $stockupgrade;
    
    public function getStockUpgradeId(): ?EngineStock
    {
        return $this->stockupgrade;
    }
    
    public function setStockUpgradeId(?EngineStock $stockupgrade): self
    {
        $this->stockupgrade = $stockupgrade;
        
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getForcedInduction(): ?string
    {
        return $this->forced_induction;
    }
    
    public function setForcedInduction(string $forced_induction): self
    {
        $this->forced_induction = $forced_induction;
        
        return $this;
    }
    
    public function getPsi(): ?int
    {
        return $this->psi;
    }
    
    public function setPsi(int $psi): self
    {
        $this->psi = $psi;
        
        return $this;
    }
    
    public function getIntake(): ?string
    {
        return $this->intake;
    }
    
    public function setIntake(string $intake): self
    {
        $this->intake = $intake;
        
        return $this;
    }
    
    public function getEcu(): ?string
    {
        return $this->ecu;
    }
    
    public function setEcu(string $ecu): self
    {
        $this->ecu = $ecu;
        
        return $this;
    }
    
    public function getPistons(): ?string
    {
        return $this->pistons;
    }
    
    public function setPistons(string $pistons): self
    {
        $this->pistons = $pistons;
        
        return $this;
    }
    
    public function getIntercooler(): ?string
    {
        return $this->intercooler;
    }
    
    public function setIntercooler(string $intercooler): self
    {
        $this->intercooler = $intercooler;
        
        return $this;
    }
    
    public function getExhaust(): ?string
    {
        return $this->exhaust;
    }
    
    public function setExhaust(string $exhaust): self
    {
        $this->exhaust = $exhaust;
        
        return $this;
    }
}

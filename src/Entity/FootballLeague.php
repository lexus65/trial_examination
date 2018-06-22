<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Table(name="league")
 * @ORM\Entity(repositoryClass="App\Repository\FootballLeagueRepository")
 */
class FootballLeague
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name")
     */
    private $name;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="FootballTeam", mappedBy="leagues")
     */
    private $teams;

    /**
     * FootballLeague constructor.
     */
    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param FootballTeam $team
     *
     */
    public function addTeam(FootballTeam $team): void
    {
        $team->addLeague($this);
        $this->teams->add($team);
    }

    public function removeTeam(FootballTeam $team): bool
    {
        return $this->teams->removeElement($team);
    }

    /**
     * @return Collection
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}

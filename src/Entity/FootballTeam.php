<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="App\Repository\FootballTeamRepository")
 */
class FootballTeam
{
    const PROP_NAME = 'name';

    const PROP_STRIP = 'strip';

    const PROP_LEAGUE = 'league';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(type="string", name="name")
     */
    private $name;

    /**
     * @var string $name
     * @ORM\Column(type="string", name="strip")
     */
    private $strip;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="FootballLeague", inversedBy="teams")
     */
    private $leagues;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->leagues = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    /**
     * @return string
     */
    public function getStrip() : string
    {
        return $this->strip;
    }

    /**
     * @param string $strip
     */
    public function setStrip(string $strip)
    {
        $this->strip = $strip;
    }

    /**
     * @return Collection
     */
    public function getLeagues(): Collection
    {
        return $this->leagues;
    }

    /**
     * @param FootballLeague $league
     */
    public function addLeague(FootballLeague $league)
    {
        $this->leagues->add($league);
    }

    /**
     * @param FootballLeague $league
     *
     * @return bool
     */
    public function removeLeague(FootballLeague $league): bool
    {
        return $this->leagues->removeElement($league);
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 6/22/18
 * Time: 13:40
 */
namespace App\Manager;

use App\Entity\FootballLeague;
use App\Entity\FootballTeam;
use App\Repository\FootballTeamRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TeamManager
 * @package App\Manager
 */
class TeamManager {

    /**
     * @var LeagueManager
     */
    private $leagueManager;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    /**
     * @var FootballTeamRepository
     */
    private $teamRepository;

    /**
     * TeamManager constructor.
     * @param LeagueManager $leagueManager
     * @param EntityManagerInterface $em
     */
    public function __construct(LeagueManager $leagueManager, EntityManagerInterface $em, FootballTeamRepository $teamRepository)
    {
        $this->leagueManager = $leagueManager;
        $this->em = $em;
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createTeam(array $data)
    {
        $team = new FootballTeam();
        $team->setName($data['name']);
        $team->setStrip($data['strip']);
        if(isset($data['league'])){
            $league = $this->leagueManager->findLeague($data['league']);
            if($league instanceof FootballLeague)
                $team->addLeague($league);
        }
        $this->em->persist($team);
        $this->em->flush();

        return $team->getId();
    }

    /**
     * @param $id
     * @param $property
     * @param $value
     * @return bool
     */
    public function modifyTeam($id, $property, $value)
    {
        $team = $this->findTeam('id', $id);

        if(false === $team)
            return false;

        switch ($property){
            case FootballTeam::PROP_NAME :
                $team->setName($value);
                break;

            case FootballTeam::PROP_STRIP :
                $team->setStrip($value);
                break;

            case FootballTeam::PROP_LEAGUE :
                $league = $this->leagueManager->findLeague($value);
                if(!$league instanceof FootballLeague)
                    return false;
                $team->addLeague($league);
                break;
        }

        $this->em->persist($team);
        $this->em->flush();

        return $team->getId();
    }

    /**
     * @param string $prop
     * @param $value
     * @return bool|null|object
     */
    public function findTeam(string $prop, $value)
    {
        $team = $this->teamRepository
            ->findOneBy(
                [$prop => $value]
            );

        if ($team instanceof FootballTeam)
            return $team;

        return false;
    }
}
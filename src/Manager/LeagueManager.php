<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 6/22/18
 * Time: 13:39
 */

namespace App\Manager;

use App\Entity\FootballLeague;
use App\Repository\FootballLeagueRepository;
use App\Repository\FootballTeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class LeagueManager
 * @package App\Manager
 */
class LeagueManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var FootballTeamRepository
     */
    private $teamRepository;

    /**
     * @var FootballLeagueRepository
     */
    private $leagueRepository;

    /**
     * LeagueManager constructor.
     * @param EntityManagerInterface $em
     * @param FootballTeamRepository $teamRepository
     * @param FootballLeagueRepository $leagueRepository
     */
    public function __construct(EntityManagerInterface $em, FootballTeamRepository $teamRepository, FootballLeagueRepository $leagueRepository)
    {

        $this->em = $em;
        $this->teamRepository = $teamRepository;
        $this->leagueRepository = $leagueRepository;
    }

    /**
     * @param $id
     * @return bool|null|object
     */
    public function findLeague($id)
    {
        $league = $this->leagueRepository
            ->findOneBy(
                ['id' => $id]
            );

        if ($league instanceof FootballLeague)
            return $league;

        return false;
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $league = $this->findLeague($id);
        try {
            $this->em->remove($league);
            $this->em->persist($league);
            $this->em->flush();
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function getTeamsOfLeague($id){
        $league = $this->findLeague($id);
        $teams = [];

        if(!$league)
            return false;

        foreach ($league->getTeams() as $team){
            $teams[] = [
                'id' => $team->getId(),
                'name' => $team->getName()
            ];
        }

        return $teams;
    }
}
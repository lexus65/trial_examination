<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FootballLeagueController extends Controller
{
    /**
     * @Route("/football/league/{id}",
     *     name="football_league_get_teams",
     *     requirements={"id"="\d+"},
     *     methods={"GET"}
     *     )
     */
    public function getTeamsOfLeague($id)
    {
        $data = $this->get('league_manager')->getTeamsOfLeague($id);
        return $this->json([
            'data' => $data,
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @Route("/football/league/{id}",
     *     name="football_league_delete",
     *     requirements={"id"="\d+"},
     *     methods={"DELETE"}
     *     )
     */
    public function deleteLeague($id)
    {
        $this->get('league_manager')->delete($id);
        return $this->json([
            'status' => Response::HTTP_NO_CONTENT,
        ]);
    }
}

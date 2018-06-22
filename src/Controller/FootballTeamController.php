<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class FootballTeamController
 * @package App\Controller
 */
class FootballTeamController extends Controller
{
    /**
     *
     * @Route("/football-team/{id}",
     *     name="football_team_modify",
     *     requirements={"id"="\d+"},
     *     methods={"PUT"}
     *     )
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function modify($id, Request $request)
    {
        $teamManager = $this->get('team_manager');
        $data = json_decode($request->getContent(), true);
        $response = $teamManager->modifyTeam($id, $data['property'], $data['value']);

        return $this->json([
            'data' => $response,
            'status' => Response::HTTP_CREATED
        ]);
    }

    /**
     *
     * @Route("/football-team/create",
     *     name="football_team_create",
     *     methods={"POST"}
     *     )
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $teamManager = $this->get('team_manager');
        $response = $teamManager->createTeam(json_decode($request->getContent(), true));

        return $this->json([
            'data' => $response,
            'status' => Response::HTTP_CREATED
        ]);
    }
}

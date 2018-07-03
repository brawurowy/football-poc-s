<?php

namespace App\Controller;

use App\Entity\League;
use App\Response\JsonResponseStructured as Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LeagueController
 * @package App\Controller
 * @Route("/leagues", name="leagues_")
 */
class LeagueController extends ApiController
{
    /**
     * @Route("/{id}", methods="GET", name="show")
     * @param League $league
     * @return Response
     */
    public function show(League $league)
    {
        return new Response($league);
    }

    /**
     * @Route("/{id}/teams", methods="GET")
     * @param League $league
     * @return Response
     */
    public function getTeams(League $league)
    {
        return new Response($league->getTeams()->toArray());
    }
}
<?php

namespace App\Controller;

use App\Entity\League;
use Symfony\Component\HttpFoundation\Response;
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
        $data = $league->serialize();
        return $this->responseTemplate($data);
    }

    /**
     * @Route("/{id}/teams", methods="GET")
     * @param League $league
     * @return Response
     */
    public function getTeams(League $league)
    {
        $data = $this->serialize($league->getTeams(), ['normalizer_ignored_attributes' => ['league']]);
        return $this->responseTemplate($data);
    }
}
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

    /**
     * @Route("/{id}", methods="DELETE", name="destroy")
     * @param League $league
     */
    public function destroy(League $league = null)
    {
        if(!$league) {
            $response = new Response('Cannot find team!');
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            return $response;
        }

        try {
            $this->entityManager->remove($league);
            $this->entityManager->flush();
            return new Response($league);
        } catch (\Exception $e) {
            dd($e->getMessage());
            $response = new Response('Error!', 'FAIL', false);
            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
            return $response;
        }
    }
}
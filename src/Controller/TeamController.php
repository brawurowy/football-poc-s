<?php

namespace App\Controller;


use App\Entity\Team;
use App\Form\TeamType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class TeamController
 * @package App\Controller
 * @Route("/teams", name="teams_")
 */
class TeamController extends ApiController
{
    /**
     * @Route("", methods="POST", name="store")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function store(Request $request, ValidatorInterface $validator)
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->submit($request->request->all());

        $errors = $validator->validate($team);
        if ($errors->count()) {
            return $this->json(['success' => false, 'msg' => (string)$errors]);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($team);
        $entityManager->flush();
        return $this->json(['success' => true, 'msg' => "Saved new product with id " . $team->getId(), 'data' => $this->serialize($team, ['normalizer_ignored_attributes' => ['league']])]);
    }

    /**
     * @Route("/{id}", methods={"PUT", "PATCH"}, name="update")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param Team $team
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function update(Request $request, ValidatorInterface $validator, Team $team = null)
    {
        if (!$team) {
            return $this->json(['msg' => "Can't find team"], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(TeamType::class, $team);
        $form->submit(array_filter($request->request->all()), false);

        $errors = $validator->validate($team);
        if ($errors->count()) {
            return $this->json(['success' => false, 'msg' => (string)$errors]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->json(['success' => true, 'msg' => "Updated product with id " . $team->getId(), 'data' => $this->serialize($team, ['normalizer_ignored_attributes' => ['league']])]);
    }
}
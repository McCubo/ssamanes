<?php

namespace App\Controller;

use App\Entity\WorkPlace;
use App\Form\WorkPlaceType;
use App\Repository\WorkPlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin-work-place")
 */
class WorkPlaceController extends Controller
{
    /**
     * @Route("/", name="work_place_index", methods="GET")
     */
    public function index(WorkPlaceRepository $workPlaceRepository): Response
    {
        return $this->render('work_place/index.html.twig', ['work_places' => $workPlaceRepository->findAll()]);
    }

    /**
     * @Route("/new", name="work_place_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $workPlace = new WorkPlace();
        $form = $this->createForm(WorkPlaceType::class, $workPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($workPlace);
            $em->flush();

            return $this->redirectToRoute('work_place_index');
        }

        return $this->render('work_place/new.html.twig', [
            'work_place' => $workPlace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="work_place_edit", methods="GET|POST")
     */
    public function edit(Request $request, WorkPlace $workPlace): Response
    {
        $form = $this->createForm(WorkPlaceType::class, $workPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('work_place_edit', ['id' => $workPlace->getId()]);
        }

        return $this->render('work_place/edit.html.twig', [
            'work_place' => $workPlace,
            'form' => $form->createView(),
        ]);
    }

}

<?php

namespace App\Controller;

use App\Entity\WorkingStatus;
use App\Form\WorkingStatusType;
use App\Repository\WorkingStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin-working-status")
 */
class WorkingStatusController extends Controller
{
    /**
     * @Route("/", name="working_status_index", methods="GET")
     */
    public function index(WorkingStatusRepository $workingStatusRepository): Response
    {
        return $this->render('working_status/index.html.twig', ['working_statuses' => $workingStatusRepository->findAll()]);
    }

    /**
     * @Route("/new", name="working_status_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $workingStatus = new WorkingStatus();
        $form = $this->createForm(WorkingStatusType::class, $workingStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($workingStatus);
            $em->flush();
            
            $this->addFlash('success', 'flash.success.new_record');
            return $this->redirectToRoute('working_status_index');
        }

        return $this->render('working_status/new.html.twig', [
            'working_status' => $workingStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="working_status_edit", methods="GET|POST")
     */
    public function edit(Request $request, WorkingStatus $workingStatus): Response
    {
        $form = $this->createForm(WorkingStatusType::class, $workingStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success', 'flash.success.edit_record');
            return $this->redirectToRoute('working_status_index');
        }

        return $this->render('working_status/edit.html.twig', [
            'working_status' => $workingStatus,
            'form' => $form->createView(),
        ]);
    }
}

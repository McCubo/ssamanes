<?php

namespace App\Controller;

use App\Entity\CivilStatus;
use App\Form\CivilStatusType;
use App\Repository\CivilStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin-civil-status")
 */
class CivilStatusController extends Controller
{
    /**
     * @Route("/", name="civil_status_index", methods="GET")
     */
    public function index(CivilStatusRepository $civilStatusRepository): Response
    {
        return $this->render('civil_status/index.html.twig', ['civil_statuses' => $civilStatusRepository->findAll()]);
    }

    /**
     * @Route("/new", name="civil_status_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $civilStatus = new CivilStatus();
        $form = $this->createForm(CivilStatusType::class, $civilStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($civilStatus);
            $em->flush();

            $this->addFlash('success', 'flash.success.new_record');
            return $this->redirectToRoute('civil_status_index');
        }

        return $this->render('civil_status/new.html.twig', [
            'civil_status' => $civilStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="civil_status_edit", methods="GET|POST")
     */
    public function edit(Request $request, CivilStatus $civilStatus): Response
    {
        $form = $this->createForm(CivilStatusType::class, $civilStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success', 'flash.success.edit_record');
            return $this->redirectToRoute('civil_status_index');
        }

        return $this->render('civil_status/edit.html.twig', [
            'civil_status' => $civilStatus,
            'form' => $form->createView(),
        ]);
    }

}

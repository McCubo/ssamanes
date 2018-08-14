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
 * @Route("/civil/status")
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

            return $this->redirectToRoute('civil_status_index');
        }

        return $this->render('civil_status/new.html.twig', [
            'civil_status' => $civilStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{name}/{id}/show", name="civil_status_show", methods="GET")
     */
    public function show(CivilStatus $civilStatus): Response
    {
        return $this->render('civil_status/show.html.twig', ['civil_status' => $civilStatus]);
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

            return $this->redirectToRoute('civil_status_edit', ['id' => $civilStatus->getId()]);
        }

        return $this->render('civil_status/edit.html.twig', [
            'civil_status' => $civilStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="civil_status_delete", methods="DELETE")
     */
    public function delete(Request $request, CivilStatus $civilStatus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$civilStatus->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($civilStatus);
            $em->flush();
        }

        return $this->redirectToRoute('civil_status_index');
    }
}

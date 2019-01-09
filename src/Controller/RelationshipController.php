<?php

namespace App\Controller;

use App\Entity\Relationship;
use App\Form\RelationshipType;
use App\Repository\RelationshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin-relationship")
 */
class RelationshipController extends Controller
{
    /**
     * @Route("/", name="relationship_index", methods="GET")
     */
    public function index(RelationshipRepository $relationshipRepository): Response
    {
        return $this->render('relationship/index.html.twig', ['relationships' => $relationshipRepository->findAll()]);
    }

    /**
     * @Route("/new", name="relationship_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $relationship = new Relationship();
        $form = $this->createForm(RelationshipType::class, $relationship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($relationship);
            $em->flush();
            
            $this->addFlash('success', 'flash.success.new_record');
            return $this->redirectToRoute('relationship_index');
        }

        return $this->render('relationship/new.html.twig', [
            'relationship' => $relationship,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="relationship_edit", methods="GET|POST")
     */
    public function edit(Request $request, Relationship $relationship): Response
    {
        $form = $this->createForm(RelationshipType::class, $relationship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'flash.success.edit_record');
            return $this->redirectToRoute('relationship_index');
        }

        return $this->render('relationship/edit.html.twig', [
            'relationship' => $relationship,
            'form' => $form->createView(),
        ]);
    }

}

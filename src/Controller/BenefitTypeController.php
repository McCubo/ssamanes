<?php

namespace App\Controller;

use App\Entity\BenefitType;
use App\Form\BenefitTypeType;
use App\Repository\BenefitTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin-benefit-type")
 */
class BenefitTypeController extends Controller
{
    /**
     * @Route("/", name="benefit_type_index", methods="GET")
     */
    public function index(BenefitTypeRepository $benefitTypeRepository): Response
    {
        return $this->render('benefit_type/index.html.twig', ['benefit_types' => $benefitTypeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="benefit_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $benefitType = new BenefitType();
        $form = $this->createForm(BenefitTypeType::class, $benefitType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($benefitType);
            $em->flush();

            $this->addFlash('success', 'flash.success.new_record');
            return $this->redirectToRoute('benefit_type_index');
        }

        return $this->render('benefit_type/new.html.twig', [
            'benefit_type' => $benefitType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="benefit_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, BenefitType $benefitType): Response
    {
        $form = $this->createForm(BenefitTypeType::class, $benefitType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success', 'flash.success.edit_record');
            return $this->redirectToRoute('benefit_type_index');
        }

        return $this->render('benefit_type/edit.html.twig', [
            'benefit_type' => $benefitType,
            'form' => $form->createView(),
        ]);
    }

}

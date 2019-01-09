<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\BenefitType;
use App\Entity\CivilStatus;
use App\Entity\WorkPlace;
use App\Entity\WorkingStatus;
use App\Entity\Relationship;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function admin(EntityManagerInterface $entityManager)
    {
        $benefitTypeCount = $entityManager->getRepository(BenefitType::class)->getActiveCount();
        $civilStatusCount = $entityManager->getRepository(CivilStatus::class)->getActiveCount();
        $workplaceCount = $entityManager->getRepository(WorkPlace::class)->getActiveCount();
        $workingStatusCount = $entityManager->getRepository(WorkingStatus::class)->getActiveCount();
        $relationCount = $entityManager->getRepository(Relationship::class)->getActiveCount();
        return $this->render('admin/index.html.twig', [
            'benefit_type_count' => $benefitTypeCount,
            'civil_status_count' => $civilStatusCount,
            'workplace_count' => $workplaceCount,
            'working_status_count' => $workingStatusCount,
            'relation_count' => $relationCount
        ]);
    }
}

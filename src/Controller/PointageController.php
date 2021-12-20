<?php

namespace App\Controller;

use App\Entity\Pointages;
use App\Form\PointageType;
use App\Repository\PointagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as assert;

class PointageController extends AbstractController
{
    /**
     *  @var PointagesRepository
     */

    public function __construct(PointagesRepository $pointrepository, EntityManagerInterface $em)
    {
        $this->repository = $pointrepository;
        $this->em = $em;
    }

    /**
     * @Route("/pointage", name="pointage.index")
     */
    public function index(): Response
    {
        $pointage = $this->repository->findAll();

        return $this->render('pointage/index.html.twig', compact('pointage'));
    }

    /**
     * @Route("/pointage/create", name="pointage.create")
     * 
     */
    public function new(Request $request)
    {
        $pointage = new Pointages();
        $form = $this->createForm(PointageType::class, $pointage);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->em->persist($pointage);
            $this->em->flush();
            return $this->redirectToRoute('pointage.index');
        }

        return $this->render("pointage/create.html.twig", [
            'pointage' => $pointage,
            'form'  => $form->createView()
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Chantiers;
use App\Repository\ChantiersRepository;
use App\Form\ChantierType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ChantierController extends AbstractController
{
/**
 *  @var ChantiersRepository
 */

    public function __construct(ChantiersRepository $chantierRepository, EntityManagerInterface $em)
    {
        $this->repository = $chantierRepository;
        $this->em = $em;
    }

    /**
     * @Route("/chantier", name="chantier.index")
     */
    public function index(): Response
    {
        $properties = $this->repository->findAll();
        return $this->render('chantier/index.html.twig', compact('properties'));
    }
    
    /**
     * @Route("/chantier/create", name="chantier.create")
    */
    public function new(Request $request)
    {
        $chantier = new Chantiers();
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->em->persist($chantier);
            $this->em->flush();
            return $this->redirectToRoute('chantier.index');
        }

        return $this->render("chantier/create.html.twig", [
            'utilisateur' => $chantier,
            'form'  => $form->createView()
        ]);
    }

    /**
     * @Route("/chantier/{id}", name="chantier.edit", methods="GET|POST")
     * @param Utilisateur $utilisateur
     */
    public function edit(Chantiers $chantier, Request $request)
    {
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->em->flush();
            return $this->redirectToRoute('chantier.index');
        }
        
        return $this->render("chantier/edit.html.twig", [
            'chantier' => $chantier,
            'form'  => $form->createView()
        ]);
    }
    /**
     * @Route("/chantier/{id}", name="chantier.delete", methods="DELETE")
     * @param Chantiers $chantier
     */
    public function delete(Chantiers $chantier, Request $request)
    {
        
            $this->em->remove($chantier);
            $this->em->flush();
        
        
        return $this->redirectToRoute('chantier.index');
    }


}

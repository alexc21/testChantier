<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    /**
     *  @var UtilisateurRepository
     */
    
    
    public function __construct(UtilisateurRepository $utilrepository, EntityManagerInterface $em)
    {
        $this->repository = $utilrepository;
        $this->em = $em;
    }

    /**
     * @Route("/user", name="user.index")
     */
    public function index( )
    {
        $properties = $this->repository->findAll();        
    
        return $this->render('user/index.html.twig', compact('properties'));
        
    }

    /**
     * @Route("/user/create", name="user.create")
    */
    public function new(Request $request)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->em->persist($utilisateur);
            $this->em->flush();
            return $this->redirectToRoute('user.index');
        }

        return $this->render("user/create.html.twig", [
            'utilisateur' => $utilisateur,
            'form'  => $form->createView()
        ]);
    }



    /**
     * @Route("/user/{id}", name="user.edit", methods="GET|POST")
     * @param Utilisateur $utilisateur
     */
    public function edit(Utilisateur $utilisateur, Request $request)
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->em->flush();
            return $this->redirectToRoute('user.index');
        }
        
        return $this->render("user/edit.html.twig", [
            'utilisateur' => $utilisateur,
            'form'  => $form->createView()
        ]);
    }
    /**
     * @Route("/user/{id}", name="user.delete", methods="DELETE")
     * @param Utilisateur $utilisateur
     */
    public function delete(Utilisateur $utilisateur){
        
            $this->em->remove($utilisateur);
            $this->em->flush();
            
        return $this->redirectToRoute('user.index');
    }

    
}

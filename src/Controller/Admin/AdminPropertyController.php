<?php 
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use App\Form\PropertyType;

 class AdminPropertyController extends AbstractController 
 {
    public function __construct(PropertyRepository $repository,EntityManagerInterface $em )
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig',['properties'=> $properties ]);
    }

    public function edit(Property $property, Request $request)
     {
        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
             $this->em->flush();
             $this->addflash('success', "Bien modifié avec succés");
             return $this->redirectToRoute('admin_property');
        }
        return $this->render('/admin/property/edit.html.twig',['property'=> $property, 'form' => $form->createView()]);
     }
    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
             $this->em->persist($property);
             $this->em->flush();
             $this->addflash('success', "Bien créé avec succés");
             return $this->redirectToRoute('admin_property');
        }
        return $this->render('/admin/property/new.html.twig',['form' => $form->createView()]);

    }
    public function delete(Property $property, Request $request){

        if ($this->isCsrfTokenValid('delete'. $property->getId(), $request->get('_token') )){

             $this->em->remove($property);
             $this->em->flush();
             $this->addflash('success', "Bien supprimé avec succés");
        }
         return $this->redirectToRoute('admin_property');
       
    }

 }
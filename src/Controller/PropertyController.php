<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;

class PropertyController extends AbstractController {

    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(PropertyRepository $repository,EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function index(PaginatorInterface $paginator, Request $request): Response
    {
       $search = new PropertySearch();
       $form = $this->createForm(PropertySearchType::class, $search);
       $form->handleRequest($request);

        $properties =$paginator->paginate(
            $this->repository->findAllVisibleQuery($search), /* query NOT result */
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('property/index.html.twig', 
        ['current_menu'=> 'properties',
         'properties'=> $properties,
         'form' => $form->createView()
         ]);
    }


    public function show(Property $property,string $slug): Response
    {
        if ($property->getSlug() !== $slug){
             return $this->redirectToRoute('property',
             [
                 'id' => $property->getId(),
                 'slug' => $property->getSlug()
             ], 301);
        }
        return $this->render('property/show.html.twig', ['current_menu'=> 'properties', 'property' => $property]);
    }
}
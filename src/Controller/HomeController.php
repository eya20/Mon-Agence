<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;

class HomeController extends AbstractController 
{
  

    public function index(PropertyRepository $repository)
    {
        $properties = $repository->findLatest();
        return $this->render('pages/home.html.twig',['properties' => $properties]);
    }
}
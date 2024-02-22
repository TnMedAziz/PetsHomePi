<?php

namespace App\Controller;

use App\Repository\ServicesRepository;
use App\Form\ServiceType;
use App\Entity\TypeService;
use App\Entity\Services; 

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientServiceController extends AbstractController
{
    
    #[Route('/client/service', name: 'app_client_service')]
    public function index(): Response
    {
        $Services = $this->getDoctrine()->getRepository(Services::class)->findAll();
        return $this->render('client_service/index.html.twig', [
            'services' => $Services,
        ]);
    
    }
}

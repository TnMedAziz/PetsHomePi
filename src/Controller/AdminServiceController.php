<?php

namespace App\Controller;

use App\Repository\ServicesRepository;
use App\Repository\TypeServiceRepository;
use App\Form\ServiceType;
use App\Form\ServicesType;
use App\Entity\TypeService;
use App\Entity\Services; // Importez la classe Service
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminServiceController extends AbstractController
{
    #[Route('/admin/service', name: 'app_admin_service')]
    public function index(): Response
    {
        $Services = $this->getDoctrine()->getRepository(Services::class)->findAll();
        return $this->render('admin_service/index.html.twig', [
            'services' => $Services,
        ]);
    
    }
    #[Route('/admin/new', name: 'app_admin_new_service')]
    public function new(Request $request): Response{
        $Service = new Services();
        $form = $this->createForm(ServiceType::class, $Service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Service);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_new_service');
        }

        return $this->render('admin_service/new.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }
    #[Route('/admin/edit/{id}', name: 'app_admin_edit_service')]
    public function edit(ServicesRepository $repository, $id, Request $request): Response
    {
        $service = $repository->find($id);
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute("app_admin_service");
        }

        return $this->render('admin_service/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }
    #[Route('/admin/delete/{id}', name: 'app_admin_delete_service')]
    public function delete($id, ServicesRepository $repository): Response
    {
        $service = $repository->find($id);

        if (!$service) {
            throw $this->createNotFoundException('Service non trouvé');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($service);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_service');
    }
    #[Route('/admin/type', name: 'app_admin_type')]
    public function affichage(): Response
    {
        $TypeService = $this->getDoctrine()->getRepository(TypeService::class)->findAll();
        return $this->render('admin_service/affichType.html.twig', [
            'TypeService' => $TypeService,
        ]);
    
    }
    #[Route('/admin/newtype', name: 'app_admin_new_type')]
    public function newtype(Request $request): Response{
        $TypeService = new TypeService();
        $form = $this->createForm(ServicesType::class, $TypeService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($TypeService);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_type');
        }

        return $this->render('admin_service/newtype.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }
    #[Route('/admin/edittype/{id}', name: 'app_admin_edit_type')]
    public function edittype(TypeServiceRepository $repository, $id, Request $request): Response
    {
        $TypeService = $repository->find($id);
        $form = $this->createForm(ServicesType::class, $TypeService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute("app_admin_type");
        }

        return $this->render('admin_service/edittype.html.twig', [
            'form' => $form->createView(),
        ]);

    }
    #[Route('/admin/deletetype/{id}', name: 'app_admin_delete_type')]
    public function deletetype($id, TypeServiceRepository $repository): Response
    {
        $TypeService = $repository->find($id);

        if (!$TypeService) {
            throw $this->createNotFoundException('Service non trouvé');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($TypeService);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_type');
    }


    
}

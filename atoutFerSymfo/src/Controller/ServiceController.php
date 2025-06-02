<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_ADMIN', message: "Vous n'êtes pas autorisé à voir cette page")]
class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('service/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }

    #[Route('/service/add', name: 'app_service_add')]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $service = new Service();

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

            $image->move(
                $this->getParameter('service_images'),
                $newFilename
            );
            $service->setImage($newFilename);

            $em->persist($service);
            $em->flush();

            return new RedirectResponse($this->generateUrl('app_service'));
        }
        return $this->render('service/add.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/service/edit/{id}', name: 'app_service_edit')]
    public function edit(Service $service, Request $request, EntityManagerInterface $em, SluggerInterface $slugger, Filesystem $fs): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();
            $image = $form->get('image')->getData();

            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                $fs->remove($this->getParameter('service_images') . '/' . $service->getImage());

                $image->move(
                    $this->getParameter('service_images'),
                    $newFilename
                );
                $service->setImage($newFilename);
            }

            $em->flush();

            return new RedirectResponse($this->generateUrl("app_service"));
        }
        return $this->render('service/edit.html.twig', [
            'form' => $form->createView(),
            'service' => $service
        ]);
    }

    #[Route('/service/delete/{id}', name: 'app_service_delete')]
    public function delete(Service $service, Request $request, EntityManagerInterface $em): Response
    {
        $em->remove($service);
        $em->flush();

        return new RedirectResponse($this->generateUrl("app_service"));
    }


}

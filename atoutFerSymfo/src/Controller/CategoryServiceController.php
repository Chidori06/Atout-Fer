<?php

namespace App\Controller;

use App\Entity\CategoryService;
use App\Form\CategoryServiceType;
use App\Repository\CategoryServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/categoryservice')]
class CategoryServiceController extends AbstractController
{
    #[Route('/', name: 'app_category_service')]
    public function index(CategoryServiceRepository $categoryServiceRepository): Response
    {

        return $this->render('category_service/index.html.twig', [
            'categoriesServices' => $categoryServiceRepository->findAll(),
        ]);
    }

    #[Route('/add', name: 'app_category_service_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categoryService = new CategoryService();

        $form = $this->createForm(CategoryServiceType::class, $categoryService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($categoryService);
            $entityManager->flush();

            return new RedirectResponse($this->generateUrl('app_category_service'));
        }
        return $this->render('category_service/add.html.twig', [
            'categoryService' => $categoryService,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'app_category_service_edit')]
    public function edit(CategoryService $categoryService, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CategoryServiceType::class, $categoryService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            $em->flush();

            return new RedirectResponse($this->generateUrl("app_category_service"));
        }
        return $this->render('category_service/edit.html.twig', [
            'form' => $form->createView(),
            'categoryService' => $categoryService
        ]);
    }

    #[Route('/delete/{id}', name: 'app_category_service_delete')]
    public function delete(CategoryService $categoryService, Request $request, EntityManagerInterface $em): Response
    {
        $em->remove($categoryService);
        $em->flush();

        return new RedirectResponse($this->generateUrl("app_category_service"));
    }
}

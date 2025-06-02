<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/category')]
#[IsGranted('ROLE_ADMIN', message: "Vous n'êtes pas autorisé à voir cette page")]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository)
    {

        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
    #[Route('/add', name: 'app_category_add')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

            $image->move(
                $this->getParameter('category_images'),
                $newFilename
            );
            $category->setImage($newFilename);

            $entityManager->persist($category);
            $entityManager->flush();

            return new RedirectResponse($this->generateUrl('app_category'));
        }

        return $this->render('category/add.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/edit/{id}', name: 'app_category_edit')]
    public function edit(Category $category, Request $request, EntityManagerInterface $em, SluggerInterface $slugger, Filesystem $fs)
    {
        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $image = $form->get('image')->getData();

            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                $fs->remove($this->getParameter('category_images') . '/' . $category->getImage());

                $image->move(
                    $this->getParameter('category_images'),
                    $newFilename
                );
                $category->setImage($newFilename);
            }
            $em->flush();

            return new RedirectResponse($this->generateUrl("app_category"));
        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
            'category' => $category
        ]);
    }

    #[Route('/delete/{id}', name: 'app_category_delete')]
    public function delete(Category $category, Request $request, EntityManagerInterface $em, Filesystem $fs)
    {
        $fs->remove($this->getParameter('category_images') . '/' . $category->getImage());

        $em->remove($category);
        $em->flush();

        return new RedirectResponse($this->generateUrl("app_category"));

    }
}

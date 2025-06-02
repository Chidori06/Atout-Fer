<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/address')]
#[IsGranted('ROLE_ADMIN', message: "Vous n'êtes pas autorisé à voir cette page")]
class AddressController extends AbstractController
{
    /* #[Route('/', name: 'app_address')]
     public function index(AddressRepository $addressRepository): Response
     {
         return $this->render('address/index.html.twig', [
             'addresses' => $addressRepository->findAll(),
         ]);
     }

     #[Route('/address/add', name: 'app_address_add')]
     public function add(Request $request, EntityManagerInterface $entityManager): Response
     {
         $address = new Address();

         $form = $this->createForm(AddressType::class, $address);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $entityManager->persist($address);
             $entityManager->flush();

             return new RedirectResponse($this->generateUrl('app_address'));
         }
         return $this->render('address/add.html.twig', [
             'address' => $address,
             'form' => $form->createView(),
         ]);
     }

     #[Route('/address/edit/{id}', name: 'app_address_edit')]
     public function edit(Address $address, Request $request, EntityManagerInterface $em): Response
     {
         $form = $this->createForm(AddressType::class, $address);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $address = $form->getData();

             $em->flush();

             return new RedirectResponse($this->generateUrl("app_address"));
         }

         return $this->render('address/edit.html.twig', [
             'form' => $form->createView(),
             'address' => $address
         ]);
     }

     #[Route('/address/delete/{id}', name: 'app_address_delete')]
     public function delete(Address $address, Request $request, EntityManagerInterface $em)
     {
         $em->remove($address);
         $em->flush();

         return new RedirectResponse($this->generateUrl("app_address"));

     }*/
}

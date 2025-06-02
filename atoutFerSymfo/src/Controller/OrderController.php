<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/orderLine')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'app_order')]
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

    #[Route('/detail/{id}', name: 'app_order_detail')]
    public function detail(Order $order)
    {

        return $this->render('order/detail.html.twig', [
            'order' => $order
        ]);
    }

    #[Route('/edit/{id}', name: 'app_order_edit')]
    public function edit(Order $order, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            $em->flush();

            return new RedirectResponse($this->generateUrl("app_order"));
        }
        return $this->render('order/edit.html.twig', [
            'form' => $form->createView(),
            'order' => $order
        ]);
    }

    #[Route('/delete/{id}', name: 'app_order_delete')]
    public function delete(Order $order, Request $request, EntityManagerInterface $em): Response
    {
        $em->remove($order);
        $em->flush();

        return new RedirectResponse($this->generateUrl("app_order"));
    }
}

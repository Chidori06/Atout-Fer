<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/orderLine')]
#[IsGranted('ROLE_ADMIN', message: "Vous n'êtes pas autorisé à voir cette page")]
class OrderLineController extends AbstractController
{
    #[Route('/', name: 'app_order_line')]
    public function index(): Response
    {
        return $this->render('order_line/index.html.twig', [
            'controller_name' => 'OrderLineController',
        ]);
    }
}

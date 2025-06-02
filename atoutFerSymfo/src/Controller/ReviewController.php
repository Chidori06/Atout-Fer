<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN', message: "Vous n'êtes pas autorisé à voir cette page")]
class ReviewController extends AbstractController
{
    #[Route('/review', name: 'app_review')]
    public function index(ReviewRepository $reviewRepository): Response
    {
        return $this->render('review/index.html.twig', [
            'reviews' => $reviewRepository->findAll(),
        ]);
    }

    #[Route('/review/detail/{id}', name: 'app_review_detail')]
    public function detail(Review $review)
    {

        return $this->render('review/detail.html.twig', [
            'review' => $review
        ]);
    }


}

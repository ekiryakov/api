<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use App\Repository\VendorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{
    /**
     * @Route("/", name="landing_page", methods={"GET"})
     */
    public function index(OfferRepository $offerRepository, VendorRepository $vendorRepository): Response
    {
        return $this->render('landing/page.html.twig', [
            'offers' => $offerRepository->findBy([],null,3,0),
            'vendors' => $vendorRepository->findAll(),
        ]);
    }
}
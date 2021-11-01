<?php

namespace App\Controller;

use App\Repository\SetRepository;
use App\Repository\VendorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{
    /**
     * @Route("/", name="landing_page", methods={"GET"})
     */
    public function index(SetRepository $setRepository, VendorRepository $vendorRepository): Response
    {
        return $this->render('landing/page.html.twig', [
            'sets' => $setRepository->findBy([],null,5,0),
            'vendors' => $vendorRepository->findAll(),
        ]);
    }
}
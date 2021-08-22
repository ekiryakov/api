<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\Vendor;
use App\Form\OfferType;
use App\Repository\CategoryRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/offer")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="offer_index", methods={"GET"})
     */
    public function index(Request $request, OfferRepository $offerRepository, CategoryRepository $categoryRepository): Response
    {
        $user = $this->getUser();
        $category = $request->get('category');

        if($user instanceof Vendor) {
            $offers = empty($category)
                ? $offerRepository->findBy(['vendor' => $user])
                : $offerRepository->findBy(['vendor' => $user, 'category' => $category]);
        } else {
            $offers = empty($category)
                ? $offerRepository->findAll()
                : $offerRepository->findBy(['category' => $category]);
        }

        return $this->render('offer/index.html.twig', [
            'offers' => $offers,
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="offer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $offer = new Offer();

        /** @var Vendor $user */
        $user = $this->getUser();
        $offer->setVendor($user);

        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="offer_show", methods={"GET"})
     */
    public function show(Offer $offer): Response
    {
        return $this->render('offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="offer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offer $offer): Response
    {
        $this->validateOwner($offer);

        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="offer_delete", methods={"POST"})
     */
    public function delete(Request $request, Offer $offer): Response
    {
        $this->validateOwner($offer);

        if ($this->isCsrfTokenValid('delete'.$offer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offer_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @param Offer $offer
     */
    protected function validateOwner(Offer $offer): void
    {
        /** @var Vendor $user */
        $user = $this->getUser();
        if ($user->getId() !== $offer->getVendor()->getId()) {
            throw new AccessDeniedException();
        }
    }
}

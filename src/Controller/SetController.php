<?php

namespace App\Controller;

use App\Entity\Set;
use App\Form\SetType;
use App\Repository\SetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/set")
 */
class SetController extends AbstractController
{
    /**
     * @Route("/", name="set_index", methods={"GET"})
     */
    public function index(SetRepository $setRepository): Response
    {
        return $this->render('set/index.html.twig', [
            'sets' => $setRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="set_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $set = new Set();
        $form = $this->createForm(SetType::class, $set);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($set);
            $entityManager->flush();

            return $this->redirectToRoute('set_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('set/new.html.twig', [
            'set' => $set,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="set_show", methods={"GET"})
     */
    public function show(Set $set): Response
    {
        return $this->render('set/show.html.twig', [
            'set' => $set,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="set_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Set $set): Response
    {
        $form = $this->createForm(SetType::class, $set);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('set_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('set/edit.html.twig', [
            'set' => $set,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="set_delete", methods={"POST"})
     */
    public function delete(Request $request, Set $set): Response
    {
        if ($this->isCsrfTokenValid('delete'.$set->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($set);
            $entityManager->flush();
        }

        return $this->redirectToRoute('set_index', [], Response::HTTP_SEE_OTHER);
    }
}

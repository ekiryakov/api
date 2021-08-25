<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Subscription;
use App\Form\SubscriptionType;
use App\Repository\SubscriptionRepository;
use App\Service\PaymentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subscription")
 */
class SubscriptionController extends AbstractController
{
    protected const STATUS_CREATED = 1;
    protected const STATUS_PAYED = 2;
    protected const STATUS_UPDATED = 3;
    protected const STATUS_CANCELED = 4;

    /**
     * @Route("/", name="subscription_index", methods={"GET"})
     */
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        $subscriptions = $this->getUser() instanceof Customer
            ? $subscriptionRepository->findBy(['customer' => $this->getUser()])
            : [];

        return $this->render('subscription/index.html.twig', [
            'subscriptions' => $subscriptions,
        ]);
    }

    /**
     * @Route("/new", name="subscription_new", methods={"GET","POST"})
     */
    public function new(Request $request, PaymentManagerInterface $payment): Response
    {
        $subscription = new Subscription();
        $subscription->setStatus(self::STATUS_CREATED);

        /** @var Customer $user */
        $user = $this->getUser();
        $subscription->setCustomer($user);

        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscription);
            $entityManager->flush();

            return $this->redirect($payment->link($subscription));
        }

        return $this->renderForm('subscription/new.html.twig', [
            'subscription' => $subscription,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_show", methods={"GET"})
     */
    public function show(Subscription $subscription): Response
    {
        $this->validateOwner($subscription);

        return $this->render('subscription/show.html.twig', [
            'subscription' => $subscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subscription_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subscription $subscription, PaymentManagerInterface $payment): Response
    {
        $this->validateOwner($subscription);
        $subscription->setStatus(self::STATUS_UPDATED);

        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subscription_index', [], Response::HTTP_SEE_OTHER);
        }
        
        $data = [
            'subscription' => $subscription,
            'form' => $form,
        ];

        if (in_array($subscription->getStatus(), [self::STATUS_CREATED, self::STATUS_CANCELED])) {
            $data['pay'] = $payment->link($subscription);
        }

        return $this->renderForm('subscription/edit.html.twig', $data);
    }

    /**
     * @Route("/{id}", name="subscription_delete", methods={"POST"})
     */
    public function delete(Request $request, Subscription $subscription): Response
    {
        $this->validateOwner($subscription);
        $subscription->setStatus(self::STATUS_CANCELED);

        if ($this->isCsrfTokenValid('delete'.$subscription->getId(), $request->request->get('_token'))) {
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('subscription_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/pay", name="subscription_pay", methods={"POST"})
     */
    public function pay(Request $request, Subscription $subscription, PaymentManagerInterface $payment): Response
    {
        if ($payment->proof($request)) {
            $subscription->setStatus(self::STATUS_PAYED);
            $this->getDoctrine()->getManager()->flush();

            return new Response();
        }

        return (new Response())->setStatusCode(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param Subscription $subscription
     */
    protected function validateOwner(Subscription $subscription): void
    {
        /** @var Customer $user */
        $user = $this->getUser();
        if ($user->getId() !== $subscription->getCustomer()->getId()) {
            throw new AccessDeniedHttpException();
        }
    }
}

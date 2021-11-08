<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerRegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CustomerRegistrationController extends AbstractController
{
    /**
     * @Route("/customer/register", name="customer_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Customer();
        $form = $this->createForm(CustomerRegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('subscription_index');
        }

        return $this->render('registration/customer_register.html.twig', [
            'registrationForm' => $form->getData(),
            'errors' => $form->getErrors(true),
        ]);
    }
}

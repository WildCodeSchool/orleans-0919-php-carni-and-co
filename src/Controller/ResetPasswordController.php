<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use \DateTime;

/**
 * @Route("/resetPassword")
 */
class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/request", name="resetpassword_request")
     * @param Request $request
     * @param TokenGeneratorInterface $tokenGenerator
     * @param UserRepository $userRepository
     * @param MailerInterface $mailer
     * @return RedirectResponse|Response
     * @throws TransportExceptionInterface
     */
    public function request(
        Request $request,
        TokenGeneratorInterface $tokenGenerator,
        UserRepository $userRepository,
        MailerInterface $mailer
    ) {
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank()
                ]])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $user = $userRepository->findOneBy(['email' => $form->getData()['email']]);
            if (!$user) {
                $this->addFlash('warning', "Cet email n'existe pas.");
                return $this->redirectToRoute("resetpassword_request");
            }

            // création du token
            $user->setToken($tokenGenerator->generateToken());
            // enregistrement de la date de création du token
            $user->setPasswordRequestedAt(new DateTime());
            $manager->flush();

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($user->getEmail())
                ->subject('Réinitialisation mot de passe')
                ->html($this->renderView('reset_password/email.html.twig', [
                    'user' => $user
                ]));

            $mailer->send($email);
            $this->addFlash(
                'success',
                "Un mail va vous être envoyé
                 afin que vous puissiez renouveller votre mot de passe. Le lien que vous recevrez sera valide 24h."
            );

            return $this->redirectToRoute("home_index");
        }

        return $this->render('reset_password/request.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // si supérieur à 24h, retourne false
    // sinon retourne false
    private function isRequestInTime(\DateTime $passwordRequestedAt = null)
    {
        if ($passwordRequestedAt === null) {
            return false;
        }

        $now = new DateTime();
        $interval = $now->getTimestamp() - $passwordRequestedAt->getTimestamp();

        $daySeconds = 86400;

        return $interval <= $daySeconds;
    }

    /**
     * @Route("/{id}/{token}", name="resettoken")
     * @param User $user
     * @param $token
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
    public function resettoken(User $user, $token, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($user->getToken() === null
            || $token !== $user->getToken()
            || !$this->isRequestInTime($user->getPasswordRequestedAt())) {
            throw new AccessDeniedHttpException();
        }

        $form = $this->createForm(ResetPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->getData()->getPassword();
            $encoded = $passwordEncoder->encodePassword($user, $password);
            $user->setPassword($encoded);

            $user->setToken(null);
            $user->setPasswordRequestedAt(null);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', "Votre mot de passe a été renouvelé.");

            return $this->redirectToRoute('home_index');
        }
        return $this->render('reset_password/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

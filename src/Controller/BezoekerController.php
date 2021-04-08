<?php

namespace App\Controller;

use App\Entity\Soortactiviteit;
use App\Entity\User;
use App\Form\ActiviteitType;
use App\Form\FormHandler;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use http\Exception\BadMessageException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BezoekerController extends AbstractController
{
    private $serializer;
    private $em;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/{vueRouting}", requirements={"vueRouting"="^(?!api|_(profiler|wdt)).*"}, name="homepage")
     */
    public function indexAction()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/api/registreren", name="registreren")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function registreren(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        FormHandler::processForm($request, $form);
        if (!$form->isValid()) {
            $errors = FormHandler::getErrorsFromForm($form);
            $data = [
                'type' => 'validation_error',
                'title' => 'Er is een validatie error',
                'errors' => $errors
            ];

            return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
        }

        $repository = $this->getDoctrine()->getRepository(User::class);
        $bestaande_user = $repository->findOneBy(['username' => $form->getData()->getUsername()]);
        if ($bestaande_user) {
            $data = [
                'type' => 'validation_error',
                'title' => 'Gebruiker bestaat al',
                'errors' => ['']
            ];
            return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
        }

        $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $data = [
            'type' => 'success',
            'title' => 'Gebruiker successvol aangemaakt',
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/soort_activiteit", name="getAllSoortActiviteiten")
     */
    public function getAllSoortActiviteiten(Request $request)
    {
        $posts = $this->em->getRepository(Soortactiviteit::class)->findAll();
        $data = $this->serializer->serialize($posts, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}

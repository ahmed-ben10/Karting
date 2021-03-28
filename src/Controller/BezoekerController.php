<?php

namespace App\Controller;

use App\Entity\Soortactiviteit;
use App\Entity\User;
use App\Form\ActiviteitType;
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
    public function registreren(Request $request, UserPasswordEncoderInterface $passwordEncoder, ValidatorInterface $validator)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $this->processForm($request, $form);
        if (!$form->isValid()) {
            $errors = $this->getErrorsFromForm($form);
            $data = [
                'type' => 'validation_error',
                'title' => 'Er is een validatie error',
                'errors' => $errors
            ];
            return new JsonResponse($data, 400);
        }
        $data = $request->request->all();

        $user->setUsername($data['username']);

        if (
            $request->request->has('plainPassword') &&
            $request->request->has('plainPasswordRepeat') &&
            $data['plain_password'] === $data['plain_password_repeat']
        ) {
            $password = $passwordEncoder->encodePassword($user, $data['plain_password']);
            $user->setPassword($password);
        } else {
            $data = $this->serializer->serialize(['error' => 'password error'], JsonEncoder::FORMAT);
            return new JsonResponse($data, Response::HTTP_BAD_REQUEST, [], true);
        }

        $user->setVoorletters($data['voorletters']);
        $user->setTussenvoegsel($data['tussenvoegsel']);
        $user->setAchternaam($data['achternaam']);
        $user->setAdres($data['adres']);
        $user->setPostcode($data['postcode']);
        $user->setWoonplaats($data['woonplaats']);
        $user->setEmail($data['email']);
        $user->setTelefoon($data['telefoon']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $data = $this->serializer->serialize(['success' => 'success'], JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
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

    private function processForm(Request $request, FormInterface $form)
    {
        $data = json_decode($request->getContent(), true);
        $clearMissing = $request->getMethod() != 'PATCH';
        $form->submit($data, $clearMissing);
    }

    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }
}

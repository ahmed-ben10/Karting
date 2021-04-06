<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\FormHandler;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class DeelnemerController extends AbstractController
{
    private $serializer;
    private $em;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/user/activiteiten", name="activiteiten")
     */
    public function activiteitenAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $beschikbareActiviteiten = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->getBeschikbareActiviteiten($user->getId());

        $ingeschrevenActiviteiten = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->getIngeschrevenActiviteiten($user->getId());

        $totaal = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->getTotaal($ingeschrevenActiviteiten);


        $data = [
            'ingeschrevenActiviteiten' => $ingeschrevenActiviteiten,
            'beschikbareActiviteiten' => $beschikbareActiviteiten,
            'totaal' => number_format($totaal, 2, ',', ' '),
        ];

        $data = $this->serializer->serialize($data, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/user/inschrijven/{id}", name="inschrijven")
     */
    public function inschrijvenActiviteitAction($id)
    {

        $activiteit = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->find($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->addActiviteit($activiteit);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $data = $this->serializer->serialize([
            'type' => 'success',
            'title' => 'Gebruiker successvol ingeschreven',
        ], JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/user/uitschrijven/{id}", name="uitschrijven")
     */
    public function uitschrijvenActiviteitAction($id)
    {
        $activiteit = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->find($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->removeActiviteit($activiteit);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $data = $this->serializer->serialize([
            'type' => 'success',
            'title' => 'Gebruiker successvol uitgeschreven',
        ], JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/user/deelnemer/edit", name="deelnemer_edit")
     */
    public function editSoortActiviteitenAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $bestaande_user = $repository->findOneBy(['username' => $user->getUsername()]);

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

        $bestaande_user = $repository->findOneBy(['username' => $form->getData()->getUsername()]);
        if ($bestaande_user && $bestaande_user->getUsername() !== $user->getUsername()) {
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
        $em->flush();;
        $data = $this->serializer->serialize([
            'type' => 'success',
            'title' => 'Gebruiker successvol gewijzigd',
        ], JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/user", name="app_user")
     */
    public function getUser(): JsonResponse
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $data = $this->serializer->serialize([
            'user' => $user
        ], JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}

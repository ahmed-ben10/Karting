<?php

namespace App\Controller;

use App\Entity\Activiteit;
use App\Entity\Soortactiviteit;
use App\Entity\User;
use App\Form\ActiviteitType;
use App\Form\SoortActiviteitType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MedewerkerController extends AbstractController
{
    /**
     * @Route("/admin/activiteiten", name="activiteitenoverzicht")
     */
    public function activiteitenOverzichtAction()
    {

        $activiteiten = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();

        return $this->render('medewerker/activiteiten.html.twig', [
            'activiteiten' => $activiteiten
        ]);
    }

    /**
     * @Route("/admin/details/{id}", name="details")
     */
    public function detailsAction($id)
    {
        $activiteiten = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();
        $activiteit = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->find($id);

        $deelnemers = $this->getDoctrine()
            ->getRepository('App:User')
            ->getDeelnemers($id);


        return $this->render('medewerker/details.html.twig', [
            'activiteit' => $activiteit,
            'deelnemers' => $deelnemers,
            'aantal' => count($activiteiten)
        ]);
    }

    /**
     * @Route("/admin/beheer", name="beheer")
     */
    public function beheerAction()
    {
        $activiteiten = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();

        return $this->render('medewerker/beheer.html.twig', [
            'activiteiten' => $activiteiten
        ]);
    }

    /**
     * @Route("/admin/add", name="add")
     */
    public function addAction(Request $request)
    {
        // create a user and a contact
        $a = new Activiteit();

        $form = $this->createForm(ActiviteitType::class, $a);
        $form->add('save', SubmitType::class, array('label' => "voeg toe"));
        //$form->add('reset', ResetType::class, array('label'=>"reset"));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();

            $this->addFlash(
                'notice',
                'activiteit toegevoegd!'
            );
            return $this->redirectToRoute('beheer');
        }
        $activiteiten = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();
        return $this->render('medewerker/add.html.twig', array('form' => $form->createView(), 'naam' => 'toevoegen', 'aantal' => count($activiteiten)
        ));
    }

    /**
     * @Route("/admin/update/{id}", name="update")
     */
    public function updateAction($id, Request $request)
    {
        $a = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->find($id);

        $form = $this->createForm(ActiviteitType::class, $a);
        $form->add('save', SubmitType::class, array('label' => "aanpassen"));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            // tells Doctrine you want to (eventually) save the contact (no queries yet)
            $em->persist($a);


            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            $this->addFlash(
                'notice',
                'activiteit aangepast!'
            );
            return $this->redirectToRoute('beheer');
        }

        $activiteiten = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();

        return $this->render('medewerker/add.html.twig', array('form' => $form->createView(), 'naam' => 'aanpassen', 'aantal' => count($activiteiten)));
    }

    /**
     * @Route("/admin/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $this->getDoctrine()
            ->getRepository('App:Activiteit')->find($id);
        $em->remove($a);
        $em->flush();

        $this->addFlash(
            'notice',
            'activiteit verwijderd!'
        );
        return $this->redirectToRoute('beheer');

    }

    /**
     * @Route("/admin/soort_activiteiten", name="soort_activiteitenoverzicht")
     */
    public function soortActiviteitenOverzichtAction()
    {

        $activiteiten = $this->getDoctrine()
            ->getRepository(Soortactiviteit::class)
            ->findAll();

        return $this->render('medewerker/soort_activiteiten.html.twig', [
            'activiteiten' => $activiteiten,
            'aantal' => count($activiteiten)
        ]);
    }

    /**
     * @Route("/admin/soort_activiteiten/delete/{id}", name="soort_activiteiten_delete")
     */
    public function deleteSoortActiviteitenAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $this->getDoctrine()
            ->getRepository(Soortactiviteit::class)->find($id);
        $em->remove($a);
        $em->flush();

        $this->addFlash(
            'notice',
            'Soort activiteit verwijderd!'
        );
        return $this->redirectToRoute('soort_activiteitenoverzicht');

    }

    /**
     * @Route("/admin/soort_activiteiten/add", name="soort_activiteiten_add")
     */
    public function addSoortActiviteitenAction(Request $request)
    {
        // create a user and a contact
        $a = new Soortactiviteit();

        $form = $this->createForm(SoortActiviteitType::class, $a);
        $form->add('save', SubmitType::class, array('label' => "voeg toe"));
        //$form->add('reset', ResetType::class, array('label'=>"reset"));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();

            $this->addFlash(
                'notice',
                'Soort activiteit toegevoegd!'
            );
            return $this->redirectToRoute('soort_activiteitenoverzicht');
        }
        $activiteiten = $this->getDoctrine()
            ->getRepository(Soortactiviteit::class)
            ->findAll();
        return $this->render('medewerker/soort_activiteiten_add.html.twig',
            array('form' => $form->createView(),
                'naam' => 'toevoegen',
                'aantal' => count($activiteiten)
            )
        );
    }

    /**
     * @Route("/admin/soort_activiteiten/edit/{id}", name="soort_activiteiten_edit")
     */
    public function editSoortActiviteitenAction(Request $request, $id)
    {
        // create a user and a contact
        $a = $this->getDoctrine()
            ->getRepository(Soortactiviteit::class)->find($id);

        $form = $this->createForm(SoortActiviteitType::class, $a);
        $form->add('save', SubmitType::class, array('label' => "Wijzig"));
        //$form->add('reset', ResetType::class, array('label'=>"reset"));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();

            $this->addFlash(
                'notice',
                'Soort activiteit gewijzigd!'
            );
            return $this->redirectToRoute('soort_activiteitenoverzicht');
        }
        $activiteiten = $this->getDoctrine()
            ->getRepository(Soortactiviteit::class)
            ->findAll();
        return $this->render('medewerker/soort_activiteiten_add.html.twig',
            array('form' => $form->createView(),
                'naam' => 'wijzigen',
                'aantal' => count($activiteiten)
            )
        );
    }

    /**
     * @Route("/admin/deelnemers", name="deelnemersoverzicht")
     */
    public function deelnemerOverzichtAction()
    {

        $activiteiten = $this->getDoctrine()
            ->getRepository(Soortactiviteit::class)
            ->findAll();

        $deelnemers = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('medewerker/deelnemers.html.twig', [
            'deelnemers' => $deelnemers,
            'aantal' => count($activiteiten)
        ]);
    }

    /**
     * @Route("/admin/deelnemers/delete/{id}", name="deelnemers_delete")
     */
    public function deleteDeelnemersAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $this->getDoctrine()
            ->getRepository(User::class)->find($id);
        $em->remove($a);
        $em->flush();

        $this->addFlash(
            'notice',
            'Deelnemer verwijderd!'
        );
        return $this->redirectToRoute('deelnemersoverzicht');

    }

    /**
     * @Route("/admin/deelnemers/reset_password/{id}", name="deelnemers_reset_password")
     */
    public function resetDeelnemersWachtwoordAction($id, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()
            ->getRepository(User::class)->find($id);
        $password = $passwordEncoder->encodePassword($user, 'qwerty01');
        $user->setPassword($password);
        $em->flush();

        $this->addFlash(
            'notice',
            'Wachtwoord van '. $user->getUsername() . ' gereset'
        );
        return $this->redirectToRoute('deelnemersoverzicht');

    }
}

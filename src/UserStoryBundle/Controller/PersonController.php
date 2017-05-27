<?php

namespace UserStoryBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use UserStoryBundle\Entity\Adress;
use UserStoryBundle\Entity\Email;
use UserStoryBundle\Entity\Phone;
use UserStoryBundle\Entity\Person;
use UserStoryBundle\Form\AdressType;
use UserStoryBundle\Form\EmailFormType;
use UserStoryBundle\Form\PhoneType;
use UserStoryBundle\Form\PersonType;


class PersonController extends Controller
{
    /**
     * @Route("/new",
     *     name="personForm")
     * @Method("GET")
     */
    public function formPersonAction(Request $request)
    {
        $person = new Person();
        $formPerson = $this->createForm(PersonType::class, $person, array(
            'action' => $this->generateUrl('personCreate')
        ));
        $formPerson->handleRequest($request);
        return $this->render('@UserStory/person/addPerson.html.twig', array(
            'formPerson' => $formPerson->createView()
        ));
    }

    /**
     * @Route("/new",
     *     name="personCreate")
     * @Method("POST")
     */
    public function newPersonAction(Request $request)
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('showPerson', array(
                'id' => $post->getId()
            ));
        }
        return new Response('Wprowadzono błędne dane. Proszę raz jeszcze wprowadzić osobę');
    }

    /**
     * @Route("/{id}/modify",
     *     name="personEditForm")
     * @Method("GET")
     */
    public function formPersonEditAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:Person');
        if ($repository->find($id)) {
            $person = $repository->find($id);
            $adress = new Adress();
            $email = new Email();
            $phone = new Phone();
            $formPerson = $this->createForm(PersonType::class, $person, array(
                'action' => $this->generateUrl('personEdit' ,array('id' => $id))
            ));
            $formPerson->handleRequest($request);
            $formAdress = $this->createForm(AdressType::class, $adress, array(
                'action' => $this->generateUrl('adressAdd' ,array('id' => $id))
            ));
            $formEmail = $this->createForm(EmailFormType::class, $email, array(
                'action' => $this->generateUrl('emailAdd', array('id' => $id))
            ));
            $formPhone = $this->createForm(PhoneType::class, $phone, array(
                'action' => $this->generateUrl('phoneAdd', array('id' => $id))
            ));
            return $this->render('@UserStory/person/addPerson.html.twig', array(
                'formPerson' => $formPerson->createView(),
                'formAdress' => $formAdress->createView(),
                'formEmail' => $formEmail->createView(),
                'formPhone' => $formPhone->createView(),
                'person' => $person
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{id}/modify",
     *     name="personEdit")
     * @Method("POST")
     */
    public function personEditAction(Request $request, $id)
    {
        $person = $this->getDoctrine()
            ->getRepository('UserStoryBundle:Person')
            ->find($id);
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('showPerson', array(
                'id' => $post->getId()
            ));
        }
        return new Response('Wprowadzono błędne dane.');
    }

    /**
     * @Route("/{id}/addEmail",
     *     name="emailAdd")
     * @Method("POST")
     */
    public function emailAddAction(Request $request, $id)
    {
        $person = $this->getDoctrine()
            ->getRepository('UserStoryBundle:Person')
            ->find($id);
        $email = new Email();
        $form = $this->createForm(EmailFormType::class, $email);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $post->setPerson($person);
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('showPerson', array(
                'id' => $post->getPerson()->getId()
            ));
        }
        return new Response('Wprowadzono błędne dane.');
    }

    /**
     * @Route("/{id}/addPhone",
     *     name="phoneAdd")
     * @Method("POST")
     */
    public function phoneAddAction(Request $request, $id)
    {
        $person = $this->getDoctrine()
            ->getRepository('UserStoryBundle:Person')
            ->find($id);
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $post->setPerson($person);
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('showPerson', array(
                'id' => $post->getPerson()->getId()
            ));
        }
        return new Response('Wprowadzono błędne dane.');
    }

    /**
     * @Route("/{id}/addAdress",
     *     name="adressAdd")
     * @Method("POST")
     */
    public function adressAddAction(Request $request, $id)
    {
        $person = $this->getDoctrine()
            ->getRepository('UserStoryBundle:Person')
            ->find($id);
        $adress = new Adress();
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $post->setPerson($person);
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('showPerson', array(
                'id' => $post->getPerson()->getId()
            ));
        }
        return new Response('Wprowadzono błędne dane.');
    }

    /**
     * @Route("/{id}/delete",
     *     name="deletePerson")
     * @Method("GET")
     */
    public function deletePersonAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:Person');
        if ($repository->find($id)) {
            $person = $repository->find($id);
            $em = $this->getDoctrine()->getManager();
            $em->remove($person);
            $em->flush();
            return new Response('Usunięto użytkownika o id ' . $id);
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{idPerson}/{idAdress}/deleteAdress",
     *     name="deleteAdress")
     * @Method("GET")
     */
    public function deleteAdressAction($idPerson, $idAdress)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:Person');
        if ($repository->find($idPerson)) {
            $person = $repository->find($idPerson);
            $repositoryAdress = $this->getDoctrine()->getRepository('UserStoryBundle:Adress');
            $adresses = $repositoryAdress->findByPerson($idPerson);
            $em = $this->getDoctrine()->getManager();
            foreach ($adresses as $adress) {
                if ($adress->getId() == $idAdress) {
                    $em->remove($adress);
                    $person->removeAdress($adress);
                    $em->flush();
                    return $this->redirectToRoute('personEdit', array(
                        'id' => $person->getId()
                    ));
                }
            }
            return $this->redirectToRoute('personEdit', array(
                'id' => $person->getId()
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{idPerson}/{idEmail}/deleteEmail",
     *     name="deleteEmail")
     * @Method("GET")
     */
    public function deleteEmailAction($idPerson, $idEmail)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:Person');
        if ($repository->find($idPerson)) {
            $person = $repository->find($idPerson);
            $repositoryEmail = $this->getDoctrine()->getRepository('UserStoryBundle:Email');
            $emails = $repositoryEmail->findByPerson($idPerson);
            $em = $this->getDoctrine()->getManager();
            foreach ($emails as $email) {
                if ($email->getId() == $idEmail) {
                    $em->remove($email);
                    $person->removeEmail($email);
                    $em->flush();
                    return $this->redirectToRoute('personEdit', array(
                        'id' => $person->getId()
                    ));
                }
            }
            return $this->redirectToRoute('personEdit', array(
                'id' => $person->getId()
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{idPerson}/{idPhone}/deletePhone",
     *     name="deletePhone")
     * @Method("GET")
     */
    public function deletePhoneAction($idPerson, $idPhone)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:Person');
        if ($repository->find($idPerson)) {
            $person = $repository->find($idPerson);
            $repositoryPhone = $this->getDoctrine()->getRepository('UserStoryBundle:Phone');
            $phones = $repositoryPhone->findByPerson($idPerson);
            $em = $this->getDoctrine()->getManager();
            foreach ($phones as $phone) {
                if ($phone->getId() == $idPhone) {
                    $em->remove($phone);
                    $person->removePhone($phone);
                    $em->flush();
                    return $this->redirectToRoute('personEdit', array(
                        'id' => $person->getId()
                    ));
                }
            }
            return $this->redirectToRoute('personEdit', array(
                'id' => $person->getId()
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{id}",
     *     name="showPerson")
     * @Method("GET")
     */
    public function showPersonAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:Person');
        if ($repository->find($id)) {
            $person = $repository->find($id);
            return $this->render('@UserStory/person/person.html.twig', array(
                'person' => $person
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/",
     *     name="showAllPersons")
     * @Method("GET")
     */
    public function showAllPersonAction()
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:Person');
        $persons = $repository->getAllOrderByName();
        return $this->render('@UserStory/person/persons.html.twig', array(
            'persons' => $persons
        ));
    }

    /**
     * @Route("editAdress/{id}", name="editAdress")
     *
     */
    public function adressEditAction(Request $request, $id)
    {
        $adress = $this->getDoctrine()->getRepository('UserStoryBundle:Adress')
            ->find($id);
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $personId = $post->getPerson()->getId();
            return $this->redirectToRoute('personEditForm', array(
                'id' => $personId
            ));
        }
        return $this->render('@UserStory/person/adressEdit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("editEmail/{id}", name="editEmail")
     *
     */
    public function emailEditAction($id, Request $request)
    {
        $email = $this->getDoctrine()->getRepository('UserStoryBundle:Email')
            ->find($id);
        $form = $this->createForm(EmailFormType::class, $email);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $personId = $post->getPerson()->getId();
            return $this->redirectToRoute('personEditForm', array(
                'id' => $personId
            ));
        }
        return $this->render('@UserStory/person/emailEdit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("editPhone/{id}", name="editPhone")
     *
     */
    public function phoneEditAction($id, Request $request)
    {
        $phone = $this->getDoctrine()->getRepository('UserStoryBundle:Phone')
            ->find($id);
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $personId = $post->getPerson()->getId();
            return $this->redirectToRoute('personEditForm', array(
                'id' => $personId
            ));
        }
        return $this->render('@UserStory/person/phoneEdit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}

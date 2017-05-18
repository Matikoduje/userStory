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
use UserStoryBundle\Entity\User;
use UserStoryBundle\Form\AdressType;
use UserStoryBundle\Form\EmailFormType;
use UserStoryBundle\Form\PhoneType;
use UserStoryBundle\Form\UserType;


class UserController extends Controller
{
    /**
     * @Route("/new",
     *     name="userForm")
     * @Method("GET")
     */
    public function formUserAction(Request $request)
    {
        $user = new User();
        $formUser = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('userCreate')
        ));
        $formUser->handleRequest($request);
        return $this->render('UserStoryBundle:user:addUser.html.twig', array(
            'formUser' => $formUser->createView()
        ));
    }

    /**
     * @Route("/new",
     *     name="userCreate")
     * @Method("POST")
     */
    public function newUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('showUser', array(
                'id' => $post->getId()
            ));
        }
        return new Response('Wprowadzono błędne dane. Proszę raz jeszcze wprowadzić użytkownika');
    }

    /**
     * @Route("/{id}/modify",
     *     name="userEditForm")
     * @Method("GET")
     */
    public function formUserEditAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:User');
        if ($repository->find($id)) {
            $user = $repository->find($id);
            $adress = new Adress();
            $email = new Email();
            $phone = new Phone();
            $formUser = $this->createForm(UserType::class, $user, array(
                'action' => $this->generateUrl('userEdit' ,array('id' => $id))
            ));
            $formUser->handleRequest($request);
            $formAdress = $this->createForm(AdressType::class, $adress, array(
                'action' => $this->generateUrl('adressAdd' ,array('id' => $id))
            ));
            $formEmail = $this->createForm(EmailFormType::class, $email, array(
                'action' => $this->generateUrl('emailAdd', array('id' => $id))
            ));
            $formPhone = $this->createForm(PhoneType::class, $phone, array(
                'action' => $this->generateUrl('phoneAdd', array('id' => $id))
            ));
            return $this->render('UserStoryBundle:user:addUser.html.twig', array(
                'formUser' => $formUser->createView(),
                'formAdress' => $formAdress->createView(),
                'formEmail' => $formEmail->createView(),
                'formPhone' => $formPhone->createView(),
                'user' => $user
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{id}/modify",
     *     name="userEdit")
     * @Method("POST")
     */
    public function userEditAction(Request $request, $id)
    {
        $user = $this->getDoctrine()
            ->getRepository('UserStoryBundle:User')
            ->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('showUser', array(
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
        $user = $this->getDoctrine()
            ->getRepository('UserStoryBundle:User')
            ->find($id);
        $email = new Email();
        $form = $this->createForm(EmailFormType::class, $email);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $post->setUser($user);
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('showUser', array(
                'id' => $post->getUser()->getId()
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
        $user = $this->getDoctrine()
            ->getRepository('UserStoryBundle:User')
            ->find($id);
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $post->setUser($user);
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('showUser', array(
                'id' => $post->getUser()->getId()
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
        $user = $this->getDoctrine()
            ->getRepository('UserStoryBundle:User')
            ->find($id);
        $adress = new Adress();
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $post->setUser($user);
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('showUser', array(
                'id' => $post->getUser()->getId()
            ));
        }
        return new Response('Wprowadzono błędne dane.');
    }

    /**
     * @Route("/{id}/delete",
     *     name="deleteUser")
     * @Method("GET")
     */
    public function deleteUserAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:User');
        if ($repository->find($id)) {
            $user = $repository->find($id);
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            return new Response('Usunięto użytkownika o id ' . $id);
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{idUser}/{idAdress}/deleteAdress",
     *     name="deleteAdress")
     * @Method("GET")
     */
    public function deleteAdressAction($idUser, $idAdress)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:User');
        if ($repository->find($idUser)) {
            $user = $repository->find($idUser);
            $repositoryAdress = $this->getDoctrine()->getRepository('UserStoryBundle:Adress');
            $adresses = $repositoryAdress->findByUser($idUser);
            $em = $this->getDoctrine()->getManager();
            foreach ($adresses as $adress) {
                if ($adress->getId() == $idAdress) {
                    $em->remove($adress);
                    $user->removeAdress($adress);
                    $em->flush();
                    return $this->redirectToRoute('userEdit', array(
                        'id' => $user->getId()
                    ));
                }
            }
            return $this->redirectToRoute('userEdit', array(
                'id' => $user->getId()
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{idUser}/{idEmail}/deleteEmail",
     *     name="deleteEmail")
     * @Method("GET")
     */
    public function deleteEmailAction($idUser, $idEmail)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:User');
        if ($repository->find($idUser)) {
            $user = $repository->find($idUser);
            $repositoryEmail = $this->getDoctrine()->getRepository('UserStoryBundle:Email');
            $emails = $repositoryEmail->findByUser($idUser);
            $em = $this->getDoctrine()->getManager();
            foreach ($emails as $email) {
                if ($email->getId() == $idEmail) {
                    $em->remove($email);
                    $user->removeEmail($email);
                    $em->flush();
                    return $this->redirectToRoute('userEdit', array(
                        'id' => $user->getId()
                    ));
                }
            }
            return $this->redirectToRoute('userEdit', array(
                'id' => $user->getId()
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{idUser}/{idPhone}/deletePhone",
     *     name="deletePhone")
     * @Method("GET")
     */
    public function deletePhoneAction($idUser, $idPhone)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:User');
        if ($repository->find($idUser)) {
            $user = $repository->find($idUser);
            $repositoryPhone = $this->getDoctrine()->getRepository('UserStoryBundle:Phone');
            $phones = $repositoryPhone->findByUser($idUser);
            $em = $this->getDoctrine()->getManager();
            foreach ($phones as $phone) {
                if ($phone->getId() == $idPhone) {
                    $em->remove($phone);
                    $user->removePhone($phone);
                    $em->flush();
                    return $this->redirectToRoute('userEdit', array(
                        'id' => $user->getId()
                    ));
                }
            }
            return $this->redirectToRoute('userEdit', array(
                'id' => $user->getId()
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/{id}",
     *     name="showUser")
     * @Method("GET")
     */
    public function showUserAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:User');
        if ($repository->find($id)) {
            $user = $repository->find($id);
            return $this->render('UserStoryBundle:user:user.html.twig', array(
                'user' => $user
            ));
        } else {
            return new Response('Nie ma użytkownika o podanym id');
        }
    }

    /**
     * @Route("/",
     *     name="showAllUsers")
     * @Method("GET")
     */
    public function showAllUserAction()
    {
        $repository = $this->getDoctrine()->getRepository('UserStoryBundle:User');
        $users = $repository->getAllOrderByName();
        return $this->render('UserStoryBundle:user:users.html.twig', array(
            'users' => $users
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
            $userId = $post->getUser()->getId();
            return $this->redirectToRoute('userEditForm', array(
                'id' => $userId
            ));
        }
        return $this->render('@UserStory/user/adressEdit.html.twig', array(
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
            $userId = $post->getUser()->getId();
            return $this->redirectToRoute('userEditForm', array(
                'id' => $userId
            ));
        }
        return $this->render('@UserStory/user/emailEdit.html.twig', array(
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
            $userId = $post->getUser()->getId();
            return $this->redirectToRoute('userEditForm', array(
                'id' => $userId
            ));
        }
        return $this->render('@UserStory/user/phoneEdit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}

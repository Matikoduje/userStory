<?php

namespace UserStoryBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use UserStoryBundle\Entity\Adress;
use UserStoryBundle\Entity\User;
use UserStoryBundle\Form\AdressType;
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
            $formUser = $this->createForm(UserType::class, $user, array(
                'action' => $this->generateUrl('userEdit' ,array('id' => $id))
            ));
            $formUser->handleRequest($request);
            $formAdress = $this->createForm(AdressType::class, $adress, array(
                'action' => $this->generateUrl('adressEdit' ,array('id' => $id))
            ));
            return $this->render('UserStoryBundle:user:addUser.html.twig', array(
                'formUser' => $formUser->createView(),
                'formAdress' => $formAdress->createView()
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
            return new Response('Zmodyfikowano użytkownika');
        }
        return new Response('Wprowadzono błędne dane.');
    }

    /**
     * @Route("/{id}/modify",
     *     name="adressEdit")
     * @Method("POST")
     */
    public function adressEditAction(Request $request, $id)
    {
        $user = $this->getDoctrine()
            ->getRepository('UserStoryBundle:User')
            ->find($id);
        $adress = new Adress();
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);
        var_dump($request->request->all());
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $post->setUser($user);
            $em->flush();
            return new Response('Dodano adres użytkownika.');
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
}

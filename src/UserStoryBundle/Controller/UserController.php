<?php

namespace UserStoryBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/new",
     *     name="userForm")
     * @Method("GET")
     */
    public function formUserAction()
    {

    }

    /**
     * @Route("/new",
     *     name="userCreate")
     * @Method("POST")
     */
    public function newUserAction()
    {

    }

    /**
     * @Route("/{id}/modify",
     *     name="userEditForm")
     * @Method("GET")
     */
    public function formUserEditAction()
    {

    }

    /**
     * @Route("/{id}/modify",
     *     name="userEdit")
     * @Method("POST")
     */
    public function userEditAction()
    {

    }

    /**
     * @Route("/{id}/delete",
     *     name="deleteUser")
     * @Method("GET")
     */
    public function deleteUserAction()
    {

    }

    /**
     * @Route("/{id}",
     *     name="showUser")
     * @Method("GET")
     */
    public function showUserAction()
    {

    }

    /**
     * @Route("/",
     *     name="showAllUsers")
     * @Method("GET")
     */
    public function showAllUserAction()
    {

    }
}

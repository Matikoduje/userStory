<?php


namespace UserStoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WebController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function welcomeAction()
    {
        return $this->render('@UserStory/web/welcome.html.twig', array(
        ));
    }
}
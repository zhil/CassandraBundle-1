<?php

namespace Mmd\CassandraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MmdCassandraBundle:Default:index.html.twig', array('name' => $name));
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: louise
 * Date: 12/07/18
 * Time: 15:24
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}
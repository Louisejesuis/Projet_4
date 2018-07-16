<?php
/**
 * Created by PhpStorm.
 * User: louise
 * Date: 12/07/18
 * Time: 15:24
 */
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/index.html.twig');
    }

}
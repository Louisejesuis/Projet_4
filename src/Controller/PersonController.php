<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/person")
 */
class PersonController extends Controller
{
    /**
     * @Route("/admin", name="person_index", methods="GET")
     */
    public function index(PersonRepository $personRepository): Response
    {
        $user = $this->getUser();
        return $this->render('person/index.html.twig', ['people' => $personRepository->findAll(), 'user' => $user]);
    }

    /**
     * @Route("/admin/new", name="person_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('person_index');
        } elseif ($this->getUser() != null ) {
            return $this->redirectToRoute('index');
            $this->addFlash('danger', 'Vous devez vous connecter pour poster une annonce');
        }

        return $this->render('person/new.html.twig', [
            'person' => $person,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="person_show", methods="GET")
     */
    public function show(Person $person): Response
    {
        $user = $this->getUser();
        return $this->render('person/show.html.twig', ['person' => $person, 'user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="person_edit", methods="GET|POST")
     */
    public function edit(Request $request, Person $person): Response
    {
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('person_edit', ['id' => $person->getId()]);
        }

        return $this->render('person/edit.html.twig', [
            'person' => $person,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="person_delete", methods="DELETE")
     */
    public function delete(Request $request, Person $person): Response
    {
        if ($this->isCsrfTokenValid('delete' . $person->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($person);
            $em->flush();
        }

        return $this->redirectToRoute('person_index');
    }
}

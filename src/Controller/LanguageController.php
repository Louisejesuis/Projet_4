<?php

namespace App\Controller;

use App\Entity\Language;
use App\Form\LanguageType;
use App\Repository\LanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/language")
 */
class LanguageController extends Controller
{
    /**
     * @Route("/", name="language_index", methods="GET")
     */
    public function index(LanguageRepository $languageRepository): Response
    {
        return $this->render('language/index.html.twig', ['languages' => $languageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="language_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $language = new Language();
        $form = $this->createForm(LanguageType::class, $language);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($language);
            $em->flush();

            return $this->redirectToRoute('language_index');
        }

        return $this->render('language/new.html.twig', [
            'language' => $language,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="language_show", methods="GET")
     */
    public function show(Language $language): Response
    {
        return $this->render('language/show.html.twig', ['language' => $language]);
    }

    /**
     * @Route("/{id}/edit", name="language_edit", methods="GET|POST")
     */
    public function edit(Request $request, Language $language): Response
    {
        $form = $this->createForm(LanguageType::class, $language);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('language_edit', ['id' => $language->getId()]);
        }

        return $this->render('language/edit.html.twig', [
            'language' => $language,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="language_delete", methods="DELETE")
     */
    public function delete(Request $request, Language $language): Response
    {
        if ($this->isCsrfTokenValid('delete'.$language->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($language);
            $em->flush();
        }

        return $this->redirectToRoute('language_index');
    }
}

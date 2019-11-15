<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\Vol1Type;
use App\Repository\VolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/vol")
 */
class VolController extends AbstractController
{
    /**
     * @Route("/", name="vol_index", methods={"GET"})
     */
    public function index(VolRepository $volRepository): Response
    {
        return $this->render('vol/index.html.twig', [
            'vols' => $volRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vol_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vol = new Vol();
        $form = $this->createForm(Vol1Type::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vol);
            $entityManager->flush();

            return $this->redirectToRoute('vol_index');
        }

        return $this->render('vol/new.html.twig', [
            'vol' => $vol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vol_show", methods={"GET"})
     */
    public function show(Vol $vol): Response
    {
        return $this->render('vol/show.html.twig', [
            'vol' => $vol,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vol_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vol $vol): Response
    {
        $form = $this->createForm(Vol1Type::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vol_index');
        }

        return $this->render('vol/edit.html.twig', [
            'vol' => $vol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vol_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vol $vol): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vol->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vol);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vol_index');
    }
}

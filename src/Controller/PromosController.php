<?php

namespace App\Controller;

use App\Entity\Promos;
use App\Form\PromosType;
use App\Repository\PromosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/promos")
 */
class PromosController extends AbstractController
{
    /**
     * @Route("/", name="promos_index", methods={"GET"})
     */
    public function index(PromosRepository $promosRepository): Response
    {
        return $this->render('promos/index.html.twig', [
            'promos' => $promosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="promos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $promo = new Promos();
        $form = $this->createForm(PromosType::class, $promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promo);
            $entityManager->flush();

            return $this->redirectToRoute('promos_index');
        }

        return $this->render('promos/new.html.twig', [
            'promo' => $promo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promos_show", methods={"GET"})
     */
    public function show(Promos $promo): Response
    {
        return $this->render('promos/show.html.twig', [
            'promo' => $promo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="promos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Promos $promo): Response
    {
        $form = $this->createForm(PromosType::class, $promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promos_index');
        }

        return $this->render('promos/edit.html.twig', [
            'promo' => $promo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Promos $promo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($promo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('promos_index');
    }
}

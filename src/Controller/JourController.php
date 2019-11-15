<?php

namespace App\Controller;

use App\Entity\Jour;
use App\Entity\Voyage;

use App\Form\JourType;
use App\Repository\JourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/jour")
 */
class JourController extends AbstractController
{
    /**
     * @Route("/", name="jour_index", methods={"GET"})
     */
    public function index(JourRepository $jourRepository): Response
    {
        return $this->render('jour/index.html.twig', [
            'jours' => $jourRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{idV}", name="jour_new", methods={"GET","POST"})
     */
    public function new(Request $request,$idV): Response
    {
        $jour = new Jour();
        $form = $this->createForm(JourType::class, $jour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                        $entityManager = $this->getDoctrine()->getManager();

         $Voyage=    $entityManager->find(Voyage::class,$idV);
        $Voyage->addJoure($jour) ;
            $entityManager->persist($Voyage);
            $entityManager->flush();

        }
        return $this->render('jour/new.html.twig', [
            'jour' => $jour,
            'form' => $form->createView(),
                        'idV'=>$idV,

        ]);
    }

    /**
     * @Route("/{id}", name="jour_show", methods={"GET"})
     */
    public function show(Jour $jour): Response
    {
        return $this->render('jour/show.html.twig', [
            'jour' => $jour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="jour_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Jour $jour): Response
    {
        $form = $this->createForm(JourType::class, $jour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jour_index');
        }

        return $this->render('jour/edit.html.twig', [
            'jour' => $jour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="jour_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Jour $jour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('jour_index');
    }
}

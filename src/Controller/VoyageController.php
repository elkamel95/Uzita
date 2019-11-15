<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\VoyageType;
use App\Form\JourType;
use App\Entity\Images;
use App\Form\VoyageTypedit;


use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Jour;
use App\Service\RemoveImageService;

/**
 * @Route("admin/voyage")
 */
class VoyageController extends AbstractController
{
    /**
     * @Route("/", name="voyage_index", methods={"GET"})
     */
    public function index(VoyageRepository $voyageRepository): Response
    {
        return $this->render('voyage/index.html.twig', [
            'voyages' => $voyageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="voyage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voyage = new Voyage();
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);
$i=0;
        if ($form->isSubmitted() ) {
              $attachments =$request->files->get('voyage')['Article']['images']['url'];
      //   $attachments=$hotel->getAticle()->getImages()->getUrl();
       if ($attachments) {
            foreach($attachments as $attachment)

            {
                if($i==1){
                                $image =new Images();

                $file = $attachment;
        

                $filename = md5(uniqid()) . '.' .$file->guessExtension();

                $file->move(
                        $this->getParameter('brochures_directory'), $filename
                );
                $image->setUrl($filename);
                $image->setAlt('1');
               $voyage->getArticle()->setImages($image);

            }
            $i=1;


        }
        }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voyage);
            $entityManager->flush();


      $jour = new Jour();
        $form = $this->createForm(JourType::class, $jour);

    return $this->render('jour/new.html.twig', [
            'jour' => $jour,
            'form' => $form->createView(),
            'idV'=>$voyage->getId(),

        ]);



                }

        return $this->render('voyage/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voyage_show", methods={"GET"})
     */
    public function show(Voyage $voyage): Response
    {
        return $this->render('voyage/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voyage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Voyage $voyage): Response
    {

        $form = $this->createForm(VoyageTypedit::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
  $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyage);

            $images=  $voyage->getAticle()->getImages();
            $alt=$this->getParameter('brochures_directory');
            $filesystem->setPaths($images,$alt);
            $entityManager->flush();

            return $this->redirectToRoute('voyage_index');
        }

        return $this->render('voyage/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voyage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Voyage $voyage): Response
    {

$filesystem = new RemoveImageService();
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $images=  $voyage->getArticle()->getImages();
           $alt=$this->getParameter('brochures_directory');


                      $filesystem->setPaths($images,$alt);
  $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voyage_index');
    }
}

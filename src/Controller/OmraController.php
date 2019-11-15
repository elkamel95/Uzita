<?php

namespace App\Controller;

use App\Entity\Omra;
use App\Entity\Images;

use App\Form\OmraType;
use App\Form\OmraTypedit;
use App\Repository\OmraRepository;
use App\Repository\ImagesRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/omra")
 */
class OmraController extends AbstractController
{
    /**
     * @Route("/", name="omra_index", methods={"GET"})
     */
    public function index(OmraRepository $omraRepository): Response
    {
        return $this->render('omra/index.html.twig', [
            'omras' => $omraRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="omra_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $omra = new Omra();
        $form = $this->createForm(OmraType::class, $omra);
        $form->handleRequest($request);
$i=0;
          if ($form->isSubmitted() ) {

              $attachments =$request->files->get('omra')['article']['images']['url'];

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
                var_dump($image->getUrl());
               $omra->getArticle()->setImages($image);

            }
            $i=1;


        }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($omra);
        $em->flush();




            return $this->redirectToRoute('omra_index');
        }

        return $this->render('omra/new.html.twig', [
            'omra' => $omra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="omra_show", methods={"GET"})
     */
    public function show(Omra $omra): Response
    {
        return $this->render('omra/show.html.twig', [
            'omra' => $omra,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="omra_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Omra $omra,ImagesRepository $ImagesRepository): Response
    {
        $form = $this->createForm(OmraTypedit::class, $omra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
$i=0;



              $attachments =$request->files->get('omra')['article']['images']['url'];

      $id=$omra->getArticle()->getId();
$images=$ImagesRepository->findByAriticle($id);
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($images as $image) {
    $entityManager->remove($image);
}
$entityManager->flush();
       if ($attachments) {
            foreach($attachments as $attachment)
            {
                                $image =new Images();

                $file = $attachment;
        

                $filename = md5(uniqid()) . '.' .$file->guessExtension();

                $file->move(
                        $this->getParameter('brochures_directory'), $filename
                );
                $image->setUrl($filename);
                $image->setAlt('6');
                if( $image->getUrl()!=null)
               $omra->getArticle()->setImages($image);

            }
        }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('omra_index');
        }

        return $this->render('omra/edit.html.twig', [
            'omra' => $omra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="omra_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Omra $omra): Response
    {
        if ($this->isCsrfTokenValid('delete'.$omra->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyage);

            $images=  $omra->getAticle()->getImages();
            $alt=$this->getParameter('brochures_directory');
            $filesystem->setPaths($images,$alt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('omra_index');
    }
}

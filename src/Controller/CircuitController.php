<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\VoyageType;
use App\Form\JourType;
use App\Entity\Images;
use App\Form\VoyageTypedit;
use App\Form\VoyageTypCuircuit;
use App\Form\VoyageTypCuircuitedit;

use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Jour;
use App\Service\RemoveImageService;

/**
 * @Route("admin/circuits")
 */
class CircuitController extends AbstractController
{
    /**
     * @Route("/", name="circuit_index", methods={"GET"})
     */
    public function index(VoyageRepository $voyageRepository): Response
    {
        return $this->render('circuits/index.html.twig', [
            'voyages' => $voyageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="circuit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voyage = new Voyage();
        $form = $this->createForm(VoyageTypCuircuit::class, $voyage);
        $form->handleRequest($request);
$i=0;
        if ($form->isSubmitted() ) {

              $attachments =$request->files->get('voyage_typ_cuircuit')['Article']['images']['url'];
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

        return $this->render('circuits/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_show", methods={"GET"})
     */
    public function show(Voyage $voyage): Response
    {
        return $this->render('circuits/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="circuit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Voyage $voyage): Response
    {

        $form = $this->createForm(VoyageTypCuircuitedit::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $filesystem = new RemoveImageService();

             $image=  $voyage->getArticle()->getMedia()->getImage();
            $images=  $voyage->getArticle()->getImages();
           $path=$this->getParameter('upload_destination').'/'.$image->getOriginalName();
           $alt=$this->getParameter('brochures_directory');

                  
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('circuit_index');
        }

        return $this->render('circuits/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Voyage $voyage): Response
    {

$filesystem = new RemoveImageService();
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
       $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($omra);

            $images=  $omra->getAticle()->getImages();
            $alt=$this->getParameter('brochures_directory');
            $filesystem->setPaths($images,$alt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('circuit_index');
    }
}

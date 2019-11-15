<?php

namespace App\Controller;
use App\Entity\Hotel;
use App\Form\HotelType;
use App\Form\HotelTypedit;
use App\Repository\PromosRepository;

use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationRepository;
use App\Repository\ImagesRepository;
use App\Service\RemoveImageService;
use App\Entity\Images;
/**
 * @Route("/admin/hotel")
 */
class HotelController extends AbstractController
{
    /**
     * @Route("/", name="hotel_index", methods={"GET"})
     */
    public function index(HotelRepository $hotelRepository,ReservationRepository $reservationRepository ): Response
    {
        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotelRepository->findAll(),'count'=> $reservationRepository->GetCountReservationAll(),
        ]);
    }
     /**
     * @Route("/reservationHotel/{id}", name="reservation_Hotel", methods={"GET"})
     */
    public function ShowReservationHotel(ReservationRepository $reservationRepository,$id): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->GetReservationByIDArticle($id),'count'=> $reservationRepository->GetCountReservationAll()
        ]);
    }

    /**
     * @Route("/new", name="hotel_new", methods={"GET","POST"})
     */
    public function new(Request $request,PromosRepository $PromosRepository): Response
    {
$i=0;
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {

              $attachments =$request->files->get('hotel')['aticle']['images']['url'];

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
               $hotel->getAticle()->setImages($image);

            }
            $i=1;


        }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($hotel);
        $em->flush();




            return $this->redirectToRoute('hotel_index');
        }

        return $this->render('hotel/new.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
         'promo'=> $PromosRepository->findAll(),

        ]);
    }

    /**
     * @Route("/{id}", name="hotel_show", methods={"GET"})
     */
    public function show(Hotel $hotel,ReservationRepository $reservationRepository ,$id): Response
    {
        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotel,'count'=> $reservationRepository->GetCountReservation($hotel->getAticle()->getId()),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="hotel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hotel $hotel,HotelRepository $hotelRepository,$id,ImagesRepository $ImagesRepository): Response
    {
        $form = $this->createForm(HotelTypedit::class, $hotel);
        $form->handleRequest($request);
            $entityManager = $this->getDoctrine()->getManager();
        $filesystem = new RemoveImageService();

        if ($form->isSubmitted() && $form->isValid()) {

          $attachments =$request->files->get('hotel')['aticle']['images']['url'];
          $alt=$this->getParameter('brochures_directory');

          $images=$hotel->getAticle()->getImages();
          $entityManager = $this->getDoctrine()->getManager();

          $filesystem->setPaths($images,$alt);
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
               $hotel->getAticle()->setImages($image);

            }
        }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hotel_index');
        }

        return $this->render('hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hotel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Hotel $hotel): Response
    {
        $filesystem = new RemoveImageService();

        if ($this->isCsrfTokenValid('delete'.$hotel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hotel);

            $images=  $hotel->getAticle()->getImages();
            $alt=$this->getParameter('brochures_directory');
            $filesystem->setPaths($images,$alt);
            $entityManager->flush();

        }

        return $this->redirectToRoute('hotel_index');
    }



}

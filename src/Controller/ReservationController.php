<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\SearchType;


/**
 * @Route("admin/reservation")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/", name="reservation_index", methods={"GET","POST"})
     */
    public function index(ReservationRepository $reservationRepository,Request $request): Response
    {
  $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
    foreach ($form->getData(0)as $Data) {
$id=$Data;

}
   



return $this->render('reservation/search.html.twig', [
            'reservations' => $reservationRepository->GetReservationByIDArticle($id),'count'=> $reservationRepository->GetCountReservationAll(),  'form' => $form->createView(),'countIsOk' => $reservationRepository->GetCountReservationComfirmer()

        ]);

}
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),'count'=> $reservationRepository->GetCountReservationAll(),'countIsOk' => $reservationRepository->GetCountReservationComfirmer(),
            'form' => $form->createView()
        ]);


     
    }

   /**
     * @Route("/search/{id}", name="reservation_search", methods={"GET"})
     */
    public function search($id,ReservationRepository $reservationRepository,Request $request): Response
    {


 

        return $this->render('reservation/search.html.twig', [
            'reservations' => $reservationRepository->GetReservationByIDArticle($id),'count'=> $reservationRepository->GetCountReservationAll(),'countIsOk' => $reservationRepository->GetCountReservationComfirmer()
        ]);


     
    }


    /**
     * @Route("/new/{id}", name="reservation_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

         $article=   $entityManager->find(Article::class,$id);
            $reservation->setArticle($article);
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
    if($reservation->getIsOk()==0)    
$reservation->setIsOk(1);
else
$reservation->setIsOk(0);


            $this->getDoctrine()->getManager()->flush();

        

                 return $this->redirectToRoute('reservation_index');

    }

    /**
     * @Route("/{id}", name="reservation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }




}

<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;

use App\Repository\ArticleRepository;

use App\Repository\PromosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request,PromosRepository $PromoRepository): Response
    {

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                        $attachments = $form['images']->getData();
        if ($attachments) {
            foreach($attachments as $attachment)
            {
                $file = $attachment->getImageFile();

                var_dump($attachment);
                $filename = md5(uniqid()) . '.' .$file->guessExtension();

                $file->move(
                        $this->getParameter('brochures_directory'), $filename
                );
                var_dump($filename);
                $attachment->setImageFile($file);
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
          

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
            'promo'=> $PromoRepository->findAll(),
        ]);
    }




    /**
     * @Route("/new/images", name="article_new", methods={"GET","POST"})
     */
    public function newimage(Request $request): Response
    {
         $article = new Article();
    $form = $this->createForm(ArticleType::class,$article);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $attachments = $article->getImages();

        if ($attachments) {
            foreach($attachments as $attachment)
            {
                $file = $attachment->getImageFile();

                var_dump($attachment);
                $filename = md5(uniqid()) . '.' .$file->guessExtension();

                $file->move(
                        $this->getParameter('brochures_directory'), $filename
                );
                var_dump($filename);
                $attachment->setImageFile($file);
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
          

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index');
    }
}

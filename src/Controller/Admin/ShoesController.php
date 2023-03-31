<?php

namespace App\Controller\Admin;

use App\Entity\Shoes;
use App\Form\ShoesType;
use App\Repository\ShoesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/shoes')]
class ShoesController extends AbstractController
{
    #[Route('/', name: 'app_admin_shoes_index', methods: ['GET'])]
    public function index(ShoesRepository $shoesRepository): Response
    {
        return $this->render('admin/shoes/index.html.twig', [
            'shoes' => $shoesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_shoes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ShoesRepository $shoesRepository): Response
    {
        $shoe = new Shoes();
        $form = $this->createForm(ShoesType::class, $shoe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shoesRepository->save($shoe, true);

            return $this->redirectToRoute('app_admin_shoes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/shoes/new.html.twig', [
            'shoe' => $shoe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_shoes_show', methods: ['GET'])]
    public function show(Shoes $shoe): Response
    {
        return $this->render('admin/shoes/show.html.twig', [
            'shoe' => $shoe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_shoes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Shoes $shoe, ShoesRepository $shoesRepository): Response
    {
        $form = $this->createForm(ShoesType::class, $shoe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shoesRepository->save($shoe, true);

            return $this->redirectToRoute('app_admin_shoes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/shoes/edit.html.twig', [
            'shoe' => $shoe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_shoes_delete', methods: ['POST'])]
    public function delete(Request $request, Shoes $shoe, ShoesRepository $shoesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoe->getId(), $request->request->get('_token'))) {
            $shoesRepository->remove($shoe, true);
        }

        return $this->redirectToRoute('app_admin_shoes_index', [], Response::HTTP_SEE_OTHER);
    }
}

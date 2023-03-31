<?php

namespace App\Controller;


use App\Entity\Shoes;
use App\Form\SearchFormType;
use App\Repository\ShoesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShoesController extends AbstractController
{
    #[Route('/', name: 'app_shoes', methods: ['GET', 'POST'])]
    public function indexBis(Request $request, ShoesRepository $shoesRepository): Response
    {

        $search_form = $this->createForm(SearchFormType::class);
        $search_form->handleRequest($request);

        $formData = ['dateadd' => 'r.dateadd DESC'];

        if ($search_form->isSubmitted() && $search_form->isValid()) {
            // to do
            $formData = $search_form->getData();
            
        }
        $shoes= $shoesRepository->search($formData);
        return $this->render('shoes/index.html.twig', [
            'shoes' => $shoes,
            'search_form' => $search_form,
        ]);


        
    }

   
}

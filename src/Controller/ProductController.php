<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\SearchType;
use App\Classe\Search;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/produits', name: 'products')]

    public function index(Request $request)
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        // dd($products);

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();
            dd($search);
        }

        return $this->render('product/index.html.twig', 
        [
            'products' => $products,
            'form' => $form->createView()
        ]);
        
    }

    #[Route('/produit/{slug}', name: 'product')]

    public function show($slug)
    {
        //dd($slug);
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);
        //dd($product);

        if(!$product) {
            return $this->redirectToRoute('products');
        }

        return $this->render('product/show.html.twig', 
        [
            'product' => $product
        ]);
        
    }
}

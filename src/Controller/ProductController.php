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


    #[Route('/', name: 'products')]

    public function index(Request $request)
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        // dd($products);

        //appel du formulaire pour filtrer les articles sur la page d'affichage des produits
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        //vérification et validation des données du formulaire 
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();
            dd($search);
        }

        return $this->render('product/index.html.twig', 
        [

            'products' => $products,
            //génère le formulaire dans la vue 
            'form' => $form->createView()
        ]);
        
    }

    //route qui prend en compte le slug créé automatiquement lors de la création d'un produit 
    //ex : un produit qui s'appelle "Robe Rouge" aura pour slug "robe-rouge" 
    #[Route('/produit/{slug}', name: 'product')]

    public function show($slug)
    {
        //dd($slug);
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);
        //dd($product);

        //si le produit n'existe pas, redirection vers la page de tous les produits 
        if(!$product) {
            return $this->redirectToRoute('products');
        }
        //s'il existe, affichage du produit sur une nouvelle page
        return $this->render('product/show.html.twig', 
        [
            'product' => $product
        ]);
        
    }
}

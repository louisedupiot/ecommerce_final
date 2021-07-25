<?php

//gestion des produits côté administrateur dans EasyAdmin

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    //fonction qui permet de rajouter un produit dans la BDD
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
                // le slug permet de faire des URLS plus simples et clairs
            SlugField::new('slug')->setTargetFieldName('name'),
            ImageField::new('illustration')->setBasePath('uploads/files')
                ->setUploadDir('public/uploads/files')
                //les images sont renommées avec des lettres aléatoires
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('subtitle'),
            TextareaField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'),
            AssociationField::new('category')

        ];
    }

}

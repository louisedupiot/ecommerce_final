<?php

// création d'une classe Search pour rendre la recherche filtrée plus simple à gérer dans le code

namespace App\Classe;

use App\Entity\Category;

class Search {

    /** 
    * @var string
    **/
    public $string = '';

    /** 
    * @var Category
    **/

    public $categories = [];

}
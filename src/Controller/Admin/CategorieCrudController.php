<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorie::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
         /*
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ]; */
        yield TextField::new('nom');
       yield TextEditorField::new('description');
        yield AssociationField::new('articles')->onlyOnIndex();
        
    }
   
}

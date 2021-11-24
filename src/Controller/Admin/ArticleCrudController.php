<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

   
    
    

    
    public function configureFields(string $pageName): iterable
    {
        $t=(new \DateTime('now'))->format('Y-M-D');
        /*
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];*/
        yield TextField::new('nom');
        yield ImageField::new('image')->setBasePath('images/article')->setUploadDir('public/images/article');
        yield ImageField::new('file')->setBasePath('images/article')->setUploadDir('public/images/article')->onlyOnForms();
       yield TextField::new('youtube');
        yield AssociationField::new('categorie');
          yield AssociationField::new('user')->hideOnForm();
        //  yield DateField::new('createdAt')->hideOnForm();
        //  yield DateTimeField::new('updatedAt')->hideOnForm();
        // yield DateField::new('date')->setFormat('Y-MM-dd')->renderAsText();
       
       
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('nom')
            
           
        ;
    }

    public function configureActions(Actions $actions): Actions
{
    return $actions
        // ...
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
        
        ->remove(Crud::PAGE_DETAIL, Action::EDIT)
        ->setPermission(Action::NEW, 'ROLE_ADMIN')
        
    ;
 
}

public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->showEntityActionsAsDropdown()
        ;
    }


    // public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
    //     $entityInstance->setUser($this->getUser());
    //     parent::createEntity($entityInstance);
        
    // }

  

 

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        
    $entityInstance->setUser($this->getUser());
      parent::updateEntity($entityManager, $entityInstance);
      
    }

    
   
}

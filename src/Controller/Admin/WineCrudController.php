<?php

namespace App\Controller\Admin;

use App\Entity\Wine;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WineCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Wine::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setFormTypeOption('label', 'Nom'),
            TextField::new('year')
                ->setFormTypeOption('label', 'Année'),
            TextField::new('description'),
            AssociationField::new('Region', 'Région')
                ->setFormTypeOptions([
                    'choice_label' => 'label',]),
            TextField::new('Cepage'),
            ImageField::new('image_name', 'image')
                ->setBasePath('public/images/')
                ->setUploadDir('public/images/')
                ,
                AssociationField::new('cave', 'Cave')
                ->setFormTypeOptions([
                    'choice_label' => 'name',
                ]),
            ];
            
    }
    
}

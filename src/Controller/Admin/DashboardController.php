<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Image;
use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ConferenceCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mini')
           

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg')

            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

         

            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            ->generateRelativeUrls();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('article', 'fa fa-shopping-bag', 'article');
        yield MenuItem::section('users');
        yield MenuItem::linkToCrud('utilisateurs', 'fas fa-list', User::class);
        yield MenuItem::section('Articles');
         yield MenuItem::linkToCrud('Articles', 'fas fa-list', Article::class)->setDefaultSort(['nom' => 'ASC']);
         yield MenuItem::linkToCrud('Add Article', 'fa fa-tags', Article::class)
            ->setAction('new');
            yield   MenuItem::section('categories');
         yield MenuItem::linkToCrud('Categories', 'fas fa-list', Categorie::class)->setController(CategorieCrudController::class);
        yield MenuItem::linkToExitImpersonation('Stop impersonation', 'fa fa-exit');
        yield   MenuItem::section('image');
        yield MenuItem::linkToCrud('image', 'fas fa-list', Image::class);
            yield MenuItem::linktoRoute('Stats', 'fa fa-chart-bar', 'admin_business_stats');
        
      
    }
}

<?php

namespace App\Controller\admin;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminCategoriesController
 * Repo
 * @author leane
 */
class AdminCategoriesController extends AbstractController {

    /**
     * 
     * @var FormationRepository
     */
    private $formationRepository;

    /**
     * 
     * @var CategorieRepository
     */
    private $categorieRepository;

    private const ADMIN_CATEGORIES_TEMPLATE = "admin/admin.categories.html.twig";

    function __construct(FormationRepository $formationRepository, CategorieRepository $categorieRepository) {
        $this->formationRepository = $formationRepository;
        $this->categorieRepository = $categorieRepository;
    }

    #[Route('/admin/categories', name: 'admin.categories')]
    public function index(Request $request): Response {
        $formations = $this->formationRepository->findAll();
        $categories = $this->categorieRepository->findAll();
        $categorie = new Categorie();
        $formCategorie = $this->createForm(CategorieType::class, $categorie);

        $formCategorie->handleRequest($request);
        if ($formCategorie->isSubmitted() && $formCategorie->isValid()) {
            $categorieExistante = $this->categorieRepository
                    ->findOneBy(['name' => $categorie->getName()]);

            if ($categorieExistante) {

                $this->addFlash('error', 'Cette catégorie existe déjà.');
            } else {
                $this->categorieRepository->add($categorie);
                return $this->redirectToRoute('admin.categories');
            }
        }
        return $this->render(self::ADMIN_CATEGORIES_TEMPLATE, [
                    'formations' => $formations,
                    'categories' => $categories,
                    'formcategorie' => $formCategorie->createView()
        ]);
    }

    #[Route('/admin/categorie/suppr/{id}', name: 'admin.categorie.suppr')]
    public function suppr(int $id): Response {
        $categorie = $this->categorieRepository->find($id);
        if ($categorie->getFormations()->isEmpty()) {
            $this->categorieRepository->remove($categorie);
        } else {
            $this->addFlash(
                    'error',
                    'La catégorie doit être rattachée à aucune formation pour être supprimée.'
            );
        }
        return $this->redirectToRoute('admin.categories');
    }
}

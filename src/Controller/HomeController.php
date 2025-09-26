<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Repository\DogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(DogRepository $dogRepository): Response
    {
        // Récupérer quelques chiens récents pour la page d'accueil
        $recentDogs = $dogRepository->findBy(['isAdopted' => false], ['id' => 'DESC'], 6);
        
        return new Response($this->renderHomePage($recentDogs));
    }

    #[Route('/search', name: 'app_search')]
    public function search(Request $request, DogRepository $dogRepository): Response
    {
        $breed = $request->query->get('breed', '');
        $age = $request->query->get('age', '');
        $gender = $request->query->get('gender', '');
        $size = $request->query->get('size', '');
        
        $dogs = $dogRepository->findByFilters($breed, $age, $gender, $size);
        
        return new Response($this->renderSearchPage($dogs, $breed, $age, $gender, $size));
    }

    private function renderHomePage(array $dogs): string
    {
        $dogsHtml = '';
        foreach ($dogs as $dog) {
            $dogsHtml .= $this->renderDogCard($dog);
        }

        return $this->getBaseHtml('Accueil - Adoption de Chiens', '
            <div class="hero">
                <div class="hero-content">
                    <h1>🐕 Trouvez votre compagnon idéal</h1>
                    <p>Des centaines de chiens attendent une famille aimante</p>
                    <a href="/search" class="btn btn-primary">Rechercher un chien</a>
                </div>
            </div>
            
            <div class="container">
                <h2>Nos derniers arrivants</h2>
                <div class="dogs-grid">
                    ' . $dogsHtml . '
                </div>
            </div>
        ');
    }

    private function renderSearchPage(array $dogs, string $breed, string $age, string $gender, string $size): string
    {
        $dogsHtml = '';
        foreach ($dogs as $dog) {
            $dogsHtml .= $this->renderDogCard($dog);
        }

        return $this->getBaseHtml('Recherche - Adoption de Chiens', '
            <div class="container">
                <h1>🔍 Rechercher un chien</h1>
                
                <div class="search-form">
                    <form method="GET" action="/search">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="breed">Race</label>
                                <input type="text" id="breed" name="breed" value="' . htmlspecialchars($breed) . '" placeholder="Ex: Labrador, Berger Allemand...">
                            </div>
                            
                            <div class="form-group">
                                <label for="age">Âge</label>
                                <select id="age" name="age">
                                    <option value="">Tous les âges</option>
                                    <option value="0-1"' . ($age === '0-1' ? ' selected' : '') . '>Chiot (0-1 an)</option>
                                    <option value="1-3"' . ($age === '1-3' ? ' selected' : '') . '>Jeune (1-3 ans)</option>
                                    <option value="3-7"' . ($age === '3-7' ? ' selected' : '') . '>Adulte (3-7 ans)</option>
                                    <option value="7+"' . ($age === '7+' ? ' selected' : '') . '>Senior (7+ ans)</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="gender">Sexe</label>
                                <select id="gender" name="gender">
                                    <option value="">Tous</option>
                                    <option value="Mâle"' . ($gender === 'Mâle' ? ' selected' : '') . '>Mâle</option>
                                    <option value="Femelle"' . ($gender === 'Femelle' ? ' selected' : '') . '>Femelle</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="size">Taille</label>
                                <select id="size" name="size">
                                    <option value="">Toutes les tailles</option>
                                    <option value="Petit"' . ($size === 'Petit' ? ' selected' : '') . '>Petit</option>
                                    <option value="Moyen"' . ($size === 'Moyen' ? ' selected' : '') . '>Moyen</option>
                                    <option value="Grand"' . ($size === 'Grand' ? ' selected' : '') . '>Grand</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </form>
                </div>
                
                <div class="results">
                    <h2>Résultats (' . count($dogs) . ' chien(s) trouvé(s))</h2>
                    <div class="dogs-grid">
                        ' . $dogsHtml . '
                    </div>
                </div>
            </div>
        ');
    }

    private function renderDogCard(Dog $dog): string
    {
        $imageUrl = $dog->getImage() ?: 'https://via.placeholder.com/300x200?text=' . urlencode($dog->getName());
        
        return '
            <div class="dog-card" data-dog-id="' . $dog->getId() . '">
                <img src="' . $imageUrl . '" alt="' . htmlspecialchars($dog->getName()) . '">
                <div class="dog-info">
                    <h3>' . htmlspecialchars($dog->getName()) . '</h3>
                    <p class="breed">' . htmlspecialchars($dog->getBreed()) . '</p>
                    <p class="details">' . $dog->getAge() . ' ans • ' . htmlspecialchars($dog->getGender()) . ' • ' . htmlspecialchars($dog->getSize()) . '</p>
                    ' . ($dog->getDescription() ? '<p class="description">' . htmlspecialchars(substr($dog->getDescription(), 0, 100)) . '...</p>' : '') . '
                    <div class="dog-actions">
                        <button class="btn btn-primary" onclick="showDogDetails(' . $dog->getId() . ')">Voir détails</button>
                    </div>
                </div>
            </div>
        ';
    }

    private function getBaseHtml(string $title, string $content): string
    {
        return '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $title . '</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="nav-logo">🐕 AdoptDog</a>
            <div class="nav-menu">
                <a href="/" class="nav-link">Accueil</a>
                <a href="/search" class="nav-link">Rechercher</a>
            </div>
        </div>
    </nav>
    
    <main>
        ' . $content . '
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 AdoptDog - Trouvez votre compagnon idéal</p>
        </div>
    </footer>
    
    <script src="/js/app.js"></script>
</body>
</html>';
    }
}

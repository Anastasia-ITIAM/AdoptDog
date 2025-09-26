<?php

namespace App\DataFixtures;

use App\Entity\Dog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dogs = [
            [
                'name' => 'Bella',
                'breed' => 'Golden Retriever',
                'age' => 3,
                'gender' => 'Femelle',
                'size' => 'Grand',
                'description' => 'Bella est une chienne très douce et affectueuse. Elle adore les enfants et les promenades. Elle est parfaitement éduquée et cherche une famille aimante.',
                'location' => 'Paris',
                'image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=400'
            ],
            [
                'name' => 'Max',
                'breed' => 'Labrador',
                'age' => 2,
                'gender' => 'Mâle',
                'size' => 'Grand',
                'description' => 'Max est un chien énergique et joueur. Il adore nager et jouer avec des balles. Parfait pour une famille active.',
                'location' => 'Lyon',
                'image' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=400'
            ],
            [
                'name' => 'Luna',
                'breed' => 'Border Collie',
                'age' => 4,
                'gender' => 'Femelle',
                'size' => 'Moyen',
                'description' => 'Luna est très intelligente et obéissante. Elle excelle dans les activités mentales et cherche un maître qui saura la stimuler.',
                'location' => 'Marseille',
                'image' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=400'
            ],
            [
                'name' => 'Charlie',
                'breed' => 'Beagle',
                'age' => 1,
                'gender' => 'Mâle',
                'size' => 'Moyen',
                'description' => 'Charlie est un jeune chien curieux et amical. Il adore explorer et rencontrer de nouvelles personnes. Très sociable !',
                'location' => 'Toulouse',
                'image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=400'
            ],
            [
                'name' => 'Daisy',
                'breed' => 'Bouledogue Français',
                'age' => 2,
                'gender' => 'Femelle',
                'size' => 'Petit',
                'description' => 'Daisy est une petite chienne très attachante. Elle est calme et parfaite pour un appartement. Elle adore les câlins.',
                'location' => 'Nice',
                'image' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=400'
            ],
            [
                'name' => 'Rocky',
                'breed' => 'Berger Allemand',
                'age' => 5,
                'gender' => 'Mâle',
                'size' => 'Grand',
                'description' => 'Rocky est un chien loyal et protecteur. Il a été dressé et est très obéissant. Idéal pour une famille avec enfants.',
                'location' => 'Bordeaux',
                'image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=400'
            ],
            [
                'name' => 'Mia',
                'breed' => 'Jack Russell',
                'age' => 3,
                'gender' => 'Femelle',
                'size' => 'Petit',
                'description' => 'Mia est une petite chienne très énergique et intelligente. Elle adore jouer et faire de l\'exercice. Très sociable avec les autres chiens.',
                'location' => 'Nantes',
                'image' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=400'
            ],
            [
                'name' => 'Buddy',
                'breed' => 'Cocker Spaniel',
                'age' => 4,
                'gender' => 'Mâle',
                'size' => 'Moyen',
                'description' => 'Buddy est un chien doux et affectueux. Il adore les promenades et les jeux. Parfait compagnon pour toute la famille.',
                'location' => 'Strasbourg',
                'image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=400'
            ],
            [
                'name' => 'Coco',
                'breed' => 'Chihuahua',
                'age' => 2,
                'gender' => 'Femelle',
                'size' => 'Petit',
                'description' => 'Coco est une petite chienne très mignonne et affectueuse. Elle est parfaite pour un appartement et adore les câlins.',
                'location' => 'Montpellier',
                'image' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=400'
            ],
            [
                'name' => 'Zeus',
                'breed' => 'Rottweiler',
                'age' => 6,
                'gender' => 'Mâle',
                'size' => 'Grand',
                'description' => 'Zeus est un chien imposant mais très doux. Il est très obéissant et protecteur. Idéal pour quelqu\'un qui a de l\'expérience avec les chiens.',
                'location' => 'Lille',
                'image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=400'
            ],
            [
                'name' => 'Ruby',
                'breed' => 'Dalmatien',
                'age' => 3,
                'gender' => 'Femelle',
                'size' => 'Grand',
                'description' => 'Ruby est une chienne élégante et énergique. Elle adore courir et jouer. Elle a besoin d\'exercice régulier et d\'espace.',
                'location' => 'Rennes',
                'image' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=400'
            ],
            [
                'name' => 'Oscar',
                'breed' => 'Bouledogue Anglais',
                'age' => 4,
                'gender' => 'Mâle',
                'size' => 'Moyen',
                'description' => 'Oscar est un chien calme et paisible. Il adore se prélasser et faire des siestes. Parfait pour quelqu\'un qui cherche un compagnon tranquille.',
                'location' => 'Reims',
                'image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=400'
            ]
        ];

        foreach ($dogs as $dogData) {
            $dog = new Dog();
            $dog->setName($dogData['name'])
                ->setBreed($dogData['breed'])
                ->setAge($dogData['age'])
                ->setGender($dogData['gender'])
                ->setSize($dogData['size'])
                ->setDescription($dogData['description'])
                ->setLocation($dogData['location'])
                ->setImage($dogData['image'])
                ->setIsAdopted(false);

            $manager->persist($dog);
        }

        $manager->flush();
    }
}

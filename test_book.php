<?php

// 1. Charger l'autoloader de Composer et importer la classe Book
require_once 'vendor/autoload.php';

use App\Entity\Book;

// 2. Instancier un livre avec le constructeur (new Book(...))
$book = new Book(
    "Apprendre PHP", 
    "Un livre pour découvrir PHP et la POO.", 
    new \DateTimeImmutable("2025-09-01"), 
    "Alice Martin"
);

// 3. Afficher le titre, l'auteur et la date formatée en d/m/Y grâce aux getters
echo "Titre : " . $book->getTitle() . "\n";
echo "Auteur : " . $book->getAuthor() . "\n";
// On utilise la méthode format() disponible sur l'objet DateTimeImmutable
echo "Date de publication : " . $book->getPublishAt()->format('d/m/Y') . "\n";

// À reformuler : quelle différence existe-t-il entre la chaîne 2025-09-01 et l’objet DateTimeImmutable ?
// la chaîne de caractères 2025-09-01 est du texte brut. on ne peut pas la manipuler sans utiliser des fonctions complexes.
// L'objet DateTimeImmutable : est un outil fourni par php. Grâce à cet objet, 
// on a acces à des méthodes très comme ->format('d/m/Y') pour l'afficher proprement, ou des méthodes pour comparer des dates entre elles.


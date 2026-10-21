<nav class="container-fluid">
  <ul>
    <li><strong>Books Library</strong></li>
  </ul>
  <ul>
    <li><a href="/">Accueil</a></li>
    <li><a href="/categories">Liste des catégories</a></li>
    <li><a href="/category/new">Ajouter une catégorie</a></li>

    <?php if (isset($_SESSION["user"])): ?>
      <!-- Si l'utilisateur est connecté : on affiche son prénom et un lien de déconnexion (si tu l'as déjà prévu) -->
      <li><span>Bonjour, <?= htmlspecialchars($_SESSION["user"]["firstname"]) ?></span></li>
      <li><a href="/logout">Deconnexion</a></li>
      <!-- Tu pourras ajouter un lien /logout ici par la suite -->
    <?php else: ?>
      <!-- Si l'utilisateur est un visiteur : on affiche Inscription et Connexion -->
      <li><a href="/register">Inscription</a></li>
      <li><a href="/login">Connexion</a></li>
      
    <?php endif; ?>
  </ul>
</nav>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <header>
        <h1>Blog di Tecnologie Web</h1>
    </header>
    <nav>
        <ul>
            <li><a href="base.php">Home</a></li><li><a href="archivio.html">Archivio</a></li><li><a href="contatti.php">Contatti</a></li><li><a href="login.html">Login</a></li>
        </ul>
    </nav>
    <main>
        <?php
            require($templateParams["nome"]);
        ?>
    </main><aside>
        <section>
            <h2>Post Casuali</h2>
            <ul>
            <?php foreach($templateParams["articolicasuali"] as $articolocasuale): ?>
                <li>
                    <img src="<?php echo UPLOAD_DIR.$articolocasuale["imgarticolo"]; ?>" alt=""/>
                    <a href="#"><?php echo $articolocasuale["titoloarticolo"]; ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        </section>
        <section>
            <h2>Categorie</h2>
            <ul>
            <?php foreach($templateParams["categorie"] as $categoria): ?>
                <li>
                    <a href="#"><?php echo $categoria["nomecategoria"]; ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        </section>
    </aside>
    <footer>
        <p>Tecnologie Web - A.A. 2022/2023</p>
    </footer>
</body>
</html>
<?php
include_once 'config/Database.php';
include_once 'class/usuario.php';
include_once 'class/galeria.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (!$user->loggedIn()) {
	header("Location: index.php");
}

$gallery = new Gallery($db);

?>
<title>Sistema de Galería Dinámica</title>
<link type="text/css" rel="stylesheet" href="style/estilo.css" />
<div class="container">
	<div class="row">
		<div class="navbar-collapse gallery">
			<h2>Galería</h2>
			<br>
			<div><a href="subir.php" class="btn btn-primary"><strong>Subir Imágenes</strong></a></div>
			<ul>
				<?php
				$galleryList = $gallery->getGalleryList();
				while ($image = $galleryList->fetch_assoc()) {
				?>
					<li id="gallery_image_<?php echo $image["id"]; ?>">
						<span><?php echo $image["image_description"]; ?></span><br>
						<a href="uploads/<?php echo $image["image_name"]; ?>" data-lightbox="<?php echo $_SESSION['userid']; ?>" data-title="<?php echo $image["image_title"]; ?>"><img src="uploads/<?php echo $image["image_name"]; ?>" class="images" width="200" height="200"></a>
						<br><br>
						<span class="pull-right">
							<a href="" id="<?php echo $image["id"]; ?>" class="delete"><span class="glyphicon glyphicon-trash"></span></a>
						</span>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
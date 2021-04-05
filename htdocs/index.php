<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<?php require '../vendor/autoload.php'; ?>

<div class="container mx-auto">
	<div class="space-y-8">
		<?php
		$gallery = new \Practice\Function\Gallery\Gallery();
		foreach ( $gallery as $key => $image ) :
			?>
			<h1 class="text-5xl"><?php echo htmlspecialchars( $key ); ?></h1>
			<div class="grid grid-cols-3 gap-4">
				<?php new \Practice\Function\Image\Image( $image ); ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>

</body>
</html>

<?php
$lang = elgg_extract('lang', $vars);
$content = elgg_extract('content', $vars);
//$scripts = elgg_extract('scripts', $vars);
$styles = elgg_extract('styles', $vars);
$integration = elgg_extract('integration', $vars);


// Get core scripts
foreach (H5PCore::$scripts as $script) {
	$script = str_replace('js/', '', $script);
	elgg_require_js($script);
	elgg_dump($script);
}
?>

<!doctype html>
<html lang="<?php print $lang; ?>" class="h5p-iframe">
<head>
  <meta charset="utf-8">
  <title><?php print $content['title']; ?></title>
  <?php for ($i = 0, $s = count($scripts); $i < $s; $i++): ?>
    <script src="<?php print $scripts[$i]; ?>"></script>
  <?php endfor; ?>
  <?php for ($i = 0, $s = count($styles); $i < $s; $i++): ?>
    <link rel="stylesheet" href="<?php print $styles[$i]; ?>">
  <?php endfor; ?>
</head>
<body>
  <div class="h5p-content" data-content-id="<?php print $content['id']; ?>"></div>
  <script>
    H5PIntegration = <?php print json_encode($integration); ?>;
  </script>
</body>
</html>

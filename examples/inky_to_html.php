<?php

declare(strict_types=1);

/**
 * Example: convert Inky shorthand markup to full HTML email markup using the Twig inky-extra extension.
 *
 * Run from the inky-extra project root:
 *   php examples/inky_to_html.php
 */

require __DIR__ . '/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\Extra\Inky\InkyExtension;

$loader = new ArrayLoader([
    'email.html.twig' => <<<'TWIG'
{% apply inky_to_html %}
<container>
  <row>
    <columns>
      <h1>Hello, {{ name }}!</h1>
      <p>Welcome to our newsletter.</p>
      <button href="https://example.com">Click here</button>
    </columns>
  </row>
</container>
{% endapply %}
TWIG,
]);

$twig = new Environment($loader);
$twig->addExtension(new InkyExtension());

$html = $twig->render('email.html.twig', ['name' => 'Alice']);

echo "Rendered HTML length: " . strlen($html) . " bytes\n";
echo substr($html, 0, 300) . "\n";

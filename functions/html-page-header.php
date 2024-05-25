<?php
function htmlPageHeader($title="", $description="", $keywords="", $card_image="") {
    global $canonical_link;
    global $website_link;

    $output = "";
    // Meta tags
    $output .= "<meta charset=\"UTF-8\">\n";
    $output .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $output .= "<meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">\n";
    $output .= "<meta name=\"description\" content=\"$description\">\n";
    $output .= "<meta name=\"keywords\" content=\"$keywords\">\n";
    // Title tag
    $output .= "<title>$title</title>\n";
    // Canonical link
    $output .= "<link rel=\"canonical\" href=\"$canonical_link\" />\n";
    // Open Graph meta tags
    $output .= "<meta property=\"og:url\" content=\"$canonical_link\" />\n";
    $output .= "<meta property=\"og:type\" content=\"website\" />\n";
    $output .= "<meta property=\"og:title\" content=\"$title\" />\n";
    $output .= "<meta property=\"og:description\" content=\"$description\" />\n";
    if (!empty($card_image)) {
        $output .= "<meta property=\"og:image\" content=\"$website_link/$card_image\" />\n";
    } else {
        $output .= "<meta property=\"og:image\" content=\"$website_link/assets/media/card-image.png\" />\n";
    }
    // Twitter meta tags
    $output .= "<meta name=\"twitter:card\" content=\"summary\" />\n";
    $output .= "<meta name=\"twitter:site\" content=\"@website\" />\n";
    $output .= "<meta name=\"twitter:title\" content=\"$title\" />\n";
    $output .= "<meta name=\"twitter:description\" content=\"$description\" />\n";
    if (!empty($card_image)) {
        $output .= "<meta name=\"twitter:image\" content=\"$website_link/$card_image\" />\n";
    } else {
        $output .= "<meta name=\"twitter:image\" content=\"$website_link/assets/media/card-image.png\" />\n";
    }
    // Favicon
    $output .= "<link rel=\"icon\" href=\"$website_link/assets/media/favicon.png\">\n";

    echo $output;
}
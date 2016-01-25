<?php
defined( '_JEXEC' ) or die;

echo '<div class = "moduletable' . $params->get('modclasssuffix') . '">';
if (  $articlecontent ->title != NULL ){
    echo '<h2>' . $articlecontent ->title. '</h2>';
}
echo strip_tags($articlecontent ->content, '<p><a><ul><li>');
echo '</div>';


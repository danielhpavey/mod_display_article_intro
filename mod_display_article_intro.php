<?php
include('helper.php');

$length = $params ->get( 'length' );
$showtitle = $params ->get( 'title' );
$display = 0;

if ( $params ->get( 'singlearticle' ) == 1 ){

    $view = 'article';
    $articleid = $params ->get( 'article_id' );
    $display = 1;

} else if (  getArticle::isCatOrArticle() ){

    $view = JFactory::getApplication()->input->get('view');
    $articleid = JFactory::getApplication()->input->get('id');
    $display = 1;
}


if ( $display == 1 ){

    $articleclass= new getArticle( $articleid, $length, $view, $showtitle );
    $articlecontent = $articleclass->getContent();

    require JModuleHelper::getLayoutPath('mod_display_article_intro', $params->get('layout', 'default'));
}

?>

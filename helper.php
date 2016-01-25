<?php

class getArticle 
{
	var $articleid;
	var $length;
    var $view;
    var $showtitle;
		
	
    public function __construct( $articleid, $length, $view, $showtitle )
    {
        $this ->article = $articleid;
        $this ->length = $length;
        $this ->view = $view;
        $this ->showtitle = $showtitle;
    }

    public static function isCatOrArticle()
    {
        $articleid = JFactory::getApplication()->input->get('id');
        $view = JFactory::getApplication()->input->get('view');

        if ( $articleid != NULL && $view == 'article'){
            return true;
        }
        if ( $articleid != NULL && $view == 'category'){
            return true;
        }

    }
	
	
    public function getContent()
    {
        
        $db = JFactory::getDBO();
        $query = $db->getQuery(true); 
        $q = $this ->query();

        $q .= $this ->where(); 

        $db->setQuery($q);
        $result = $db->loadResult();

        if ( $this ->length !=0 ){
            $result = substr( $result, 0, $this ->length ); 
        }

        if ( $this ->showtitle  == 1 ){
            
            $title = $this ->getTitle();

        } else {
            $title = null;
        }

        $r = new stdClass();
        $r ->title = $title;
        $r ->content = $result;
         
        return $r;
    }

    public function getTitle()
    {

        $db = JFactory::getDBO();
        $query = $db->getQuery(true); 
        $q = 'select title from #__content ';
        $q .= $this ->where();
        $db->setQuery($q);
        $result = $db->loadResult();
        return $result;
    }

    private function query()
    {
        $query = 'select introtext from #__content';
        return $query;
    }

    private function where()
    {
        switch ($this ->view){

            case 'article':
            $q = ' where id = "' . $this -> article . '"';
            break;

            case 'category':
            $q = ' where id = ';
            $q .= '(select max(id) from #__content where catid = "' . $this ->article . '") ';
            break;
        
        }

        return $q;
    }

}

?>

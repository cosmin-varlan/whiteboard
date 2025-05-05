<?php
class LandingView
{

    public function __construct(){

	}

    public function displayLandingPage() {        
        ob_start();
        include(DIRECTOR_SITE.SLASH."views".SLASH."TPL".SLASH."landing.tpl");        
        $this->output = ob_get_contents();
        ob_end_clean();        
        return $this->output;
    }
}
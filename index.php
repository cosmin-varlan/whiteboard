<?php
    session_start();

    define ('SLASH', DIRECTORY_SEPARATOR);
    define ('DIRECTOR_SITE', dirname(__FILE__));

    require_once DIRECTOR_SITE.SLASH."utils".SLASH."autoloader.php";


    // setam cateva valori.....
    $controller = "LandingController";
    $actiune = "none";
    $parametri = [];


    // ***********   preluarea datelor prin transmise prin POST *************
    $post = file_get_contents('php://input');
    parse_str($post, $parametri);
    // -----------  am preluat datele transmiseprin POST in array-ul $parametri  ---------





    // ************   Parsam URLul ca sa vedem care este controllerul si care e actiunea **************    
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $domain = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER["REQUEST_URI"];
    $siteAddress = $protocol. "://" .$domain."/";

    $_SESSION["domain"] = $domain; 
        
    $infos = explode('/', $uri); 

    $controllerPosition = -1;    
    for($i=0; $i<count($infos); $i++)
    {
        if (strpos($infos[$i], 'Controller')){
            $controllerPosition = $i;
            break;
        }
    }
    if ($controllerPosition>1) $siteAddress.= ($infos[1]."/");
    $_SESSION["siteAddress"] = $siteAddress;

    if ($controllerPosition != -1)  {
        $controller = $infos[$controllerPosition];
        if ($controllerPosition + 1 < count($infos)) $actiune = $infos[$controllerPosition + 1];
        else $actiune="";
        if ($controllerPosition + 2 < count($infos)) 
        {
            for($i=$controllerPosition+2; $i<count($infos); $i++)
                array_push($parametri, $infos[$i]);
        }                    
    }
    // ------------ terminat cu parsarea URL ---------------



    if (isset($_SESSION["user"]))
    {        
        // daca avem setat un user atunci ii vom verifica drepturile in controller
        $control = new $controller($actiune, $parametri);
    }
    else
    {
        // daca nu am setat un user atunci dau voie doar la anumite controllere (publice)
        if (($controller == "UserController" && ($actiune=="auth" || $actiune=="register"))||
            ($controller == "LandingController" && $actiune=="none"))
            $control = new $controller($actiune, $parametri);
        else {            
            //header('Location: https://poate_un_url_de_autentificare.ro');
            exit();
        }
    }

?>
<?php declare( strict_types=1 );

namespace IAW\Projecte\Controller;

use IAW\Projecte\View\BaseView;
use IAW\Projecte\View\RegistroView;
use IAW\Projecte\DataBase\Repository\UserRepository;



class RegistroController
{
    public function __construct()
    {
    }

    public function __invoke(): void
    {        
        if($_SESSION['es_administrador']=='N')
        {
            header('Location: /dashboard');
            die;
        }
        $template = new RegistroView();
        $template->setTitle( 'Registro'.$_SESSION['es_administrador'] );
        $template->render();
        
    }

}

<?php declare( strict_types=1 );

namespace IAW\Projecte\Controller;

use IAW\Projecte\View\BaseView;
use IAW\Projecte\View\HomeTemplate;
use IAW\Projecte\View\LoginView;
use IAW\Projecte\DataBase\Repository\UserRepository;



class LogoutController
{
    public function __construct()
    {
    }

    public function __invoke(): void
    {
     
        session_unset();

    
        session_destroy();

        $template = new LoginView();
        $template->setTitle( 'Login' );
        $template->render();
        
    }

}

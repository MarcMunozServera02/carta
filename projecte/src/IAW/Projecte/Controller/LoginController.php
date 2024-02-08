<?php declare( strict_types=1 );

namespace IAW\Projecte\Controller;

use IAW\Projecte\View\BaseView;
use IAW\Projecte\View\HomeTemplate;
use IAW\Projecte\View\LoginView;
use IAW\Projecte\DataBase\Repository\UserRepository;



class LoginController
{
    public function __construct()
    {
    }

    public function __invoke(): void
    {        
        if(isset($_SESSION['usuario_id']))
        {
            header('Location: /dashboard');
            die;
        }
        $template = new LoginView();
        $template->setTitle( 'Login' );
        $template->render();
        
    }

}

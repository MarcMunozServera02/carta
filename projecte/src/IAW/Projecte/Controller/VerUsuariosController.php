<?php declare( strict_types=1 );

namespace IAW\Projecte\Controller;

use IAW\Projecte\DataBase\Repository\UserRepository;
use IAW\Projecte\View\VerUsuariosView;

class VerUsuariosController
{
    public function __invoke(): void
    {
        if(isset($_SESSION['usuario_id'])){
            $usuaris = ( new UserRepository() )->getUsuaris();
            
            $template = new VerUsuariosView();
            $template->setTitle( 'Usuaris' );
            $template->setUsuaris($usuaris);
            $template->render();
        }
        else{
            print_r('No eres administrador <br><a href="dashboard">Volver</a>');
        }
    }
        
}

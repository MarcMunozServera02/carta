<?php declare( strict_types=1 );

namespace IAW\Projecte\Controller;

use IAW\Projecte\DataBase\Repository\UserRepository;
use IAW\Projecte\View\CorreoView;

class VerCorreoController
{
    public function __invoke(): void
    {
        if(isset($_SESSION['usuario_id'])){
            $usuario = ( new UserRepository() )->getCorreo($_SESSION['usuario_id'] );
            
            $correo=$usuario['email'];
            $template = new CorreoView();
           
            $template->setTitle( 'Correo' );
            
            $template->setEmail($correo);
            $template->render();
        }
        else{
            print_r('No estas validado <br><a href="dashboard">Volver</a>');
        }
    }
        
}

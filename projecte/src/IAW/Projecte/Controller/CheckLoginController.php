<?php declare( strict_types=1 );

namespace IAW\Projecte\Controller;

use IAW\Projecte\DataBase\Repository\UserRepository;
use IAW\Projecte\View\DashBoardView;

class CheckLoginController
{
    public function __invoke(): void
    {
        $usuarioValido = ( new UserRepository() )->validarCredenciales( $_POST['usuario'], $_POST['contrasena'] );
        //$usuarioValido=(New UserRepository())->get($_POST['usuario']);
        if ( $usuarioValido ) {
            $_SESSION['usuario_id'] = $usuarioValido['id'];
            $_SESSION['es_administrador'] = $usuarioValido['administrador'];
            $template = new DashBoardView();
            $template->setTitle( $usuarioValido['nombre'] );
            $template->render();
        } else {
            print_r( "Credenciales incorrectas" );
        }
    }
}

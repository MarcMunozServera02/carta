<?php declare( strict_types=1 );

namespace IAW\Projecte\Controller;

use IAW\Projecte\DataBase\Repository\UserRepository;

class CheckRegistroController
{
    public function __invoke(): void
    {
        $esAdministrador = "S";
        if ( $_POST['administrador'] ) {
            $esAdministrador = 'S';
        } else {
            $esAdministrador = 'N';
        }
        
        $dato = [
            "usuario" => $this->limpiarEntrada( $_POST['usuario'] ),
            "contrasena" => $this->limpiarEntrada( $_POST['contrasena'] ),
            "nombre" => $this->limpiarEntrada( $_POST['nombre'] ),
            "email" => $this->limpiarEntrada( $_POST['email'] ),
            "administrador" => $this->limpiarEntrada( $esAdministrador ),
        ];
        
        $resultado = ( new UserRepository() )->GuardarUsuario( $dato );
        if ( $resultado ) {
            print_r( 'Datos guardados</br><a href="/dashboard">Volver</a>' );
            die;
        }
        print_r( "problemas registrando los datos" );
    }
    
    // limpia los datos recibidos
    public function limpiarEntrada( $dato )
    {
        $dato = trim( $dato );
        $dato = stripslashes( $dato );
        $dato = htmlspecialchars( $dato );
        
        return $dato;
    }
}

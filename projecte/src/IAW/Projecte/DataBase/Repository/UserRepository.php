<?php declare( strict_types=1 );

namespace IAW\Projecte\DataBase\Repository;

use PDO;

class UserRepository extends BaseRepository
{
    public function get( string $usuario ): ?array
    {
        $stmt = $this->connection->get()->prepare( 'SELECT id, nombre, contrasena,administrador FROM usuarios WHERE usuario = :usuario' );
        $stmt->bindValue( ':usuario', $usuario, PDO::PARAM_STR );
        $stmt->execute();
        
        return $stmt->fetch() ?: null;
    }
    
    public function getCorreo(int $id){
        $stmt = $this->connection->get()->prepare( 'SELECT id, email FROM usuarios WHERE id = :id' );
        $stmt->bindValue( ':id', $id, PDO::PARAM_INT );
        $stmt->execute();
        return $stmt->fetch() ?: null;
    }
    public function getUsuaris():?array
    {
        $stmt = $this->connection->get()->prepare( 'SELECT id,usuario, nombre, email, administrador FROM usuarios order by id' );
        $stmt->execute();
        return $stmt->fetchAll() ?: null;
    }

    public function validarCredenciales( $usuario, $contrasena )
    {
        $user = $this->get( $usuario );
        
        // Verifica si se encontraron resultados
        if ( !$user ) {
            return null;
        }
        
        // Verifica la contraseña utilizando password_verify
        if ( !password_verify( $contrasena, $user['contrasena'] ) ) {
            return null;
        }
        
        return [
            'id' => $user['id'],
            'nombre' => $user['nombre'],
            'administrador' => $user['administrador'],
        ];
    }
    
    public function guardarUsuario( array $data ): bool
    {
        $stmt = $this->connection->get()->prepare( 'INSERT INTO usuarios (usuario, contrasena, nombre, email, administrador) VALUES (:usuario,:contrasena,:nombre,:email,:administrador)' );
        
        $stmt->bindValue( ':usuario', $data['usuario'] );
        $stmt->bindValue( ':contrasena', password_hash( $data['contrasena'], PASSWORD_DEFAULT ) );
        $stmt->bindValue( ':nombre', $data['nombre'] );
        $stmt->bindValue( ':email', $data['email'] );
        $stmt->bindValue( ':administrador', $data['administrador'] );
        $stmt->execute();
        
        return true;
    }
}
<?php declare( strict_types=1 );

namespace IAW\Projecte\View;

use IAW\Projecte\View\BaseView;
use Parsedown;

class CorreoView extends BaseView
{
    protected string $email;
    public function setEmail( string $correo){
        $this->email=$correo;
    }
    protected function prepare(): string
    {
        return $this->engine->render( 'correo.html', [
            'title' => $this->title,
            'correo'=>$this->email,
        ] );
    }
}

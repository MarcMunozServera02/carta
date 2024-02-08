<?php declare( strict_types=1 );

namespace IAW\Projecte\View;

use IAW\Projecte\View\BaseView;
use Parsedown;

class VerUsuariosView extends BaseView
{
    protected array $usuaris;
    public function setUsuaris( array $usuaris){
        $this->usuaris=$usuaris;
    }
    protected function prepare(): string
    {
        return $this->engine->render( 'verusuarios.html', [
            'title' => $this->title,
            'usuaris'=>$this->usuaris,
        ] );
    }
}

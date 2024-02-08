<?php declare( strict_types=1 );

namespace IAW\Projecte\View;

use IAW\Projecte\View\BaseView;

class DashBoardView extends BaseView
{
    protected function prepare(): string
    {
        return $this->engine->render( 'dashboard.html', [
            'title' => $this->title,
            'administrador'=>$_SESSION['es_administrador']            
        ] );
    }
}



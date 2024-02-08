<?php declare( strict_types=1 );

namespace IAW\Projecte\View;

use IAW\Projecte\View\BaseView;
use Parsedown;

class LoginView extends BaseView
{
    protected function prepare(): string
    {
        return $this->engine->render( 'login.html', [
            'title' => $this->title,
        ] );
    }
}

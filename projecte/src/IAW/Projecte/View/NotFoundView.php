<?php declare( strict_types=1 );

namespace IAW\Projecte\View;

class NotFoundView extends BaseView
{
    public function __construct( string $message )
    {
        parent::__construct();

        $this->title = 'No se ha encontrado';
        $this->content = $message;
    }
}
<?php declare( strict_types=1 );

namespace IAW\Projecte\Controller;

use IAW\Projecte\View\BaseView;
use IAW\Projecte\View\HomeTemplate;
use IAW\Projecte\View\DashBoardView;
use IAW\Projecte\DataBase\Repository\UserRepository;

class DashBoardController
{
    public function __construct()
    {
    }

    public function __invoke(): void
    {
        $template = new DashBoardView();
        $template->setTitle( 'DashBoard' );
        $template->render();
        
    }

}

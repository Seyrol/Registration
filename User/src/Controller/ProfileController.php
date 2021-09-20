<?php
declare(strict_types=1);
namespace User\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\View\View;

class ProfileController extends AbstractActionController
{
    public function indexAction()
    {
        $auth = new AuthenticationService();
        if($auth->hasIdentity()) {
            # if user has session take them some else
            return new ViewModel();
        }else {
            return $this->redirect()->toRoute('error');
        }
    }
}
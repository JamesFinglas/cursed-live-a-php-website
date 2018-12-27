<?php
namespace Itb;


class UserController
{
    private $twig;

    public function loginFormAction()
    {
        $argsArray = [
            'pageTitle' => 'Login Form',
        ];
        $template = 'home.html.twig';

        $html = $this->twig->render($template, $argsArray);
        print $html;
    }


    public function processLoginAction($username, $password)
    {
        if($this->validCredentialsAdmin($username, $password)) {
            $_SESSION['username'] = $username;
            $argsArray = [
                'pageTitle' => 'Template Form',
            ];
            $template = 'home.html.twig';

            $html = $this->twig->render($template, $argsArray);
            print $html;
        } else {
            $argsArray = [
                'pageTitle' => 'Login Error Form',
            ];
            $template = 'loginError.html.twig';

            $html = $this->twig->render($template, $argsArray);
            print $html;
        }
    }

    private function validCredentialsAdmin($u, $p)
    {
        if('admin' == $u && 'admin' == $p){
            return true;
        }
        else if('staff' == $u && 'staff' == $p){
            return true;
        } else {
            return false;
        }
    }

    public function isLoggedIn()
    {
        if(isset($_SESSION['username'])){
            return true;
        } else {
            return false;
        }
    }

    public function usernameFromSession()
    {
        if(isset($_SESSION['username'])){
            return $_SESSION['username'];
        } else {
            return '';
        }
    }

}
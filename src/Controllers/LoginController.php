<?php

namespace Castels\Controllers;

use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Castels\Model\UserModel;
use Castels\Validator\UserValidator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends Controller
{
    /**
     * @Route(
     *     url="/login",
     *     handler="form"
     * )
     */
    public function form()
    {
        return $this->render("login/form.html.twig");
    }


    /**
     * @Route(
     *     url="/login/process",
     *     handler="login"
     * )
     */
    public function login()
    {
        if (isset($_POST["enter"])) {

            $model = new UserModel($this->get("pdo"));
            $entity = $model->makeUser($_POST);

            $validator = new UserValidator($entity);
            $validator->setModel($model);

            $errors = $validator->validate();
            if ($errors)
                return $this->render("login/form.html.twig", ["errors" => $errors]);


            $response = new RedirectResponse('/admin');
            $response->headers->set("user_logged","yes");

            return $response;
        }

        // if requested directly redirect to main page
        return $this->redirect('/');
    }


    /**
     * @Route(
     *     url="/logout",
     *     handler="logout"
     * )
     */
    public function logout()
    {
        $response = new Response();
        $response->headers->set("user_logged","no");

        return $response;
    }

}
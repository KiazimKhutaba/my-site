<?php


namespace Castels\Controllers;


use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Castels\Service\TelegramService;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class TelegramController extends Controller
{
    /**
     * @Route(
     *     url="/telegram/send",
     *     handler="sendMessageForm"
     * )
     */
    public function sendMessageForm()
    {
        $query = Request::createFromGlobals() -> query;
        $tgSrv = new TelegramService();
        $twig = $this -> get('twig');
        $data = [];

        if( $query -> has("tgSendBtn")  ) {
            $message = $query -> get("tgMessage");

            $tgResponse = $tgSrv -> send($message);
            $data["tgResponse"] = json_decode($tgResponse,true);


            //print("<pre>" . print_r($data,1) . "</pre>");
        }

        $data["test"] = "Test message " . rand(0,PHP_INT_MAX);
        $content = $twig -> render("telegram/send.html.twig", $data);

        return new Response($content);
    }
}
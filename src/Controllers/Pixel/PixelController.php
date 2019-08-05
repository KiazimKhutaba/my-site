<?php


namespace Castels\Controllers\Pixel;


use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class PixelController extends Controller
{
    private $gif = "\x47\x49\x46\x38\x37\x61\x1\x0\x1\x0\x80\x0\x0\xfc\x6a\x6c\x0\x0\x0\x2c\x0\x0\x0\x0\x1\x0\x1\x0\x0\x2\x2\x44\x1\x0\x3b";

    /**
     * @Route(
     *   url="/pixel",
     *   handler="index"
     * )
     */
    public function index()
    {
        $this->writeLog();

        $response = new Response();

        $response->headers->set("Last-Modified", gmdate("d, d m y h:i:s") . " gmt");
        $response->headers->set("Cache-Control", "no-cache, must-revalidate");
        $response->headers->set("Pragma", "no-cache");
        $response->headers->set("Content-Type", "image/gif");

        $response->setContent($this->gif);

        return $response;
    }


    private function writeLog()
    {

        $log = sprintf("[%s] %s %s %s %s\n",
            date('Y-m-d H:i:s'),
            $_SERVER['REMOTE_ADDR'],
            gethostbyaddr($_SERVER['REMOTE_ADDR']),
            $_SERVER['HTTP_REFERER'] ?: '', $_SERVER["HTTP_USER_AGENT"]);


        file_put_contents('../var/log/pixel/pixel.log', $log, FILE_APPEND | LOCK_EX);
    }
}
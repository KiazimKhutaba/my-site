<?php

namespace Castels\Controllers;

use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Zend\Feed\Reader\Exception\RuntimeException;
use Zend\Feed\Reader\Reader;


class RSSController extends Controller
{
    /**
     * @Route(
     *     url="/rss",
     *     handler="index"
     * )
     */
    public function index()
    {
        $twig = $this->get("twig");

        // Fetch the latest Slashdot headlines
        try {
            $slashdotRss =
                Reader::import('https://www.ekhokavkaza.com/api/zmojye$kjv');
        } catch (RuntimeException $e) {
            // feed import failed
            return new Response("Exception caught importing feed: {$e->getMessage()}");
        }

        // Initialize the channel/feed data array
        $channel = [
            'title' => $slashdotRss->getTitle(),
            'link' => $slashdotRss->getLink(),
            'description' => $slashdotRss->getDescription(),
            'items' => [],
        ];


        // Loop over each channel item/entry and store relevant data for each
        foreach ($slashdotRss as $item) {

            //$channel["items"][] = $item;

            $channel['items'][] = [
                'title' => $item->getTitle(),
                'link' => $item->getLink(),
                'description' => $item->getDescription()
            ];
        }

        //return new Response(debug($slashdotRss,1));

        return new Response($twig->render(
            "rss/index.html.twig",
            ["channel" => $channel, "channel_items" => $channel["items"]]
        ));

    }
}
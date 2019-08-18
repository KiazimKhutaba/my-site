<?php


namespace Castels\Service;


use Castels\TgConfig;

class TelegramService
{

    public function send($text)
    {
        return @file_get_contents($this->getUrl($text));
    }

    /**
     * @param $text
     * @return string
     */
    public function getUrl($text)
    {
        return sprintf(
            "https://api.telegram.org/bot%s/sendMessage?chat_id=%s&text=%s",
            TgConfig::BotApiKey,
            TgConfig::ChannelName,
            urlencode($text)
        );
    }
}
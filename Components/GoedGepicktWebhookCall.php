<?php

namespace GoedGepicktWebhooks\Components;

use GuzzleHttp\Client;

class GoedGepicktWebhookCall
{
    protected $config;

    public function __construct(
        Config $config
    )
    {
        $this->config = $config;
    }

    public function sendPostRequest($webhookData)
    {
        try {
            $webhookData['webhook-key'] = $this->config->getWebhookKey();
            $client = new Client();
            $client->post($this->getWebhookUrl(), [
                'body'    => json_encode($webhookData),
            ]);
        } catch (\Exception $e) {
        }

        return;
    }

    protected function getWebhookUrl()
    {
        return 'https://account.goedgepickt.nl/webhook/shopware5/handle-order-webhook';
    }
}
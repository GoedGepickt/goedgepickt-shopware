<?php

namespace GoedGepicktWebhooks\Components;

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
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->getWebhookUrl());
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($webhookData));
        curl_exec($curl);
        curl_close($curl);

        return;
    }

    protected function getWebhookUrl()
    {
        return 'https://account.goedgepickt.nl/webhook/shopware5/' . $this->config->getWebhookKey();
    }
}
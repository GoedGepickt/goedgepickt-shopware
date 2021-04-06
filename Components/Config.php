<?php

namespace GoedGepicktWebhooks\Components;

use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class Config
{
    protected $configReader;

    public function __construct(\Shopware\Components\Plugin\ConfigReader $configReader)
    {
        $this->configReader = $configReader;
    }

    public function getSettingValue($key = null, $default = null)
    {
        if (is_null($this->data)) {
            try {
                $shop = Shopware()->Shop();
            } catch (ServiceNotFoundException $e) {
                $shop = null;
            }

            $parts = explode('\\', __NAMESPACE__);
            $name = array_shift($parts);
            $this->data = $this->configReader->getByPluginName($name, $shop);
        }

        if (!is_null($key)) {
            return isset($this->data[$key]) ? $this->data[$key] : $default;
        }

        return $this->data;
    }

    public function getWebhookKey()
    {
        $webhookKey = '';

        if (!empty($this->getSettingValue('webhook-key'))) {
            $webhookKey = $this->getSettingValue('webhook-key');
        }

        return $webhookKey;
    }
}
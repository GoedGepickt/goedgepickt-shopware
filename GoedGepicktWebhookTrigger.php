<?php

namespace GoedGepicktWebhooks;

use GoedGepicktWebhooks\Components\GoedGepicktWebhookCall;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\DeactivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Shopware\Components\Plugin\Context\UpdateContext;

class GoedGepicktWebhookTrigger extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'sOrder::sSaveOrder::after'       => 'webhookTrigger',
            'sOrder::setPaymentStatus::after' => 'webhookTrigger',
            'sOrder::setOrderStatus::after'   => 'webhookTrigger',
        ];
    }

    public function install(InstallContext $context)
    {
        if (file_exists(__DIR__.'/vendor/autoload.php')) {
            require_once __DIR__.'/vendor/autoload.php';
        }

        parent::install($context);
    }

    public function update(UpdateContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_DEFAULT);

        parent::update($context);
    }

    public function uninstall(UninstallContext $context)
    {
        if ($context->keepUserData()) {
            return;
        }

        parent::uninstall($context);
    }

    public function deactivate(DeactivateContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_DEFAULT);

        parent::deactivate($context);
    }

    public function activate(ActivateContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_DEFAULT);

        parent::activate($context);
    }

    public function webhookTrigger()
    {
        $pluginConfig = Shopware()->Container()->get('goedgepickt_webhooks.config');
        $webhookData  = $this->getOrderDataForWebhook();

        $webhookClient = new GoedGepicktWebhookCall($pluginConfig);
        $webhookClient->sendRequest($webhookData);
    }

    private function getOrderDataForWebhook()
    {
        $this->session = Shopware()->Session();

        return [
            'orderNumber' => $this->session['sOrderVariables']['sOrderNumber'],
        ];
    }
}

# GoedGepickt webhooks for Shopware 5
GoedGepickt webhook triggers for creating/updating orders

## Installation

### Manual
1. Download this repository and navigate to your downloads folder. Make sure the downloaded files are merged into a ZIP file.
2. In your Shopware backend navigate to Configuration > Plugin-in manager > Installed
3. Use the Upload plugin button to select the zipped file.

### Composer (suggested)
Use command line to access the root folder of your project, thereafter execute the following code.

```
    composer require goedgepickt/goedgepickt-shopware
```

## Activate Plugin
1. Navigate to Configuration > Plug-in Manager > Installed > GoedGepickt in your Shopware Backend.
2. Activate the installed GoedGepickt plugin. 
3. Make sure you register the folowing field(s): 
    + Webhook Key: this key can be found as followed, in GoedGepickt navigate to Settings > Webshops > your Shopware shop. Here you will find a filed called Webhook key.

## Uninstall
1. Navigate to Configuration > Plug-in Manager > Installed > GoedGepickt in your Shopware Backend.
2. Deactivate the GoedGepickt plugin.
3. Uninstall GoedGepickt. 

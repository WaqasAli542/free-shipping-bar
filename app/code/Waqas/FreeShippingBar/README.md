#Free Shipping Bar Module

This extension allows store owners to create and display free shipping bar, which encourage customers to buy more products to avail free shipping on their purchase.

##Support: 
version - 2.3.x, 2.4.x 

##How to install Extension

1. Download the archive file.
2. Unzip the file
3. Create a folder [Magento_Root]/app/code/waqas/FreeShippingBar
4. Drop/move the unzipped files to directory '[Magento_Root]/app/code/waqas/FreeShippingBar'

#Enable Extension:
- php bin/magento module:enable Waqas_FreeShippingBar
- php bin/magento setup:upgrade
- php bin/magento setup:di:compile
- php bin/magento setup:static-content:deploy
- php bin/magento cache:flush

#Disable Extension:
- php bin/magento module:disable Waqas_FreeShippingBar
- php bin/magento setup:upgrade
- php bin/magento setup:di:compile
- php bin/magento setup:static-content:deploy
- php bin/magento cache:flush
---

# A extension for a badge for the navigation and the product detail page for Shopware 6

A extension for a _badge for the navigation and the product detail page_. The text from the custom badge is set at the custom fields at the product. The background color and the font color of the badge could be set over the configuration or at the product. The custom badge is also displayed when assigning a product page layout. When you increase the value from the constant _NUMBER_BADGES_ in the file _SschreierBadgeNavigationProductDetailPage.php_ in the _src_-directory before the installation, you can add so much badges as you like.

## Possible Configurations 
 - select, if the discount badge should be shown in the category lists
 - select, if the discount badge should be shown on the product detail page
 - select, if the topseller badge should be shown in the category lists
 - select, if the topseller badge should be shown on the product detail page
 - select, if the new badge should be shown in the category lists
 - select, if the new badge should be shown on the product detail page
 - select, if the custom badge should be shown in the category lists
 - select, if the custom badge should be shown on the product detail page
 - select, if the colors of the badge should be set via the configuration
 - set the background color of the badge
 - set the font color of the badge

## Available snippets
 - badgeText
 - boxLabelDiscount

## How to install the extension
### via console (recommended)

1. Download the latest _SschreierBadgeNavigationProductDetailPage-master.zip_.
2. Unzip the zip file and rename the folder to _SschreierBadgeNavigationProductDetailPage_. 
3. Move the folder to the project folder _custom/plugins/_ .
4. Connect to the console via ssh:

```
bin/console plugin:refresh
bin/console plugin:install --activate SschreierBadgeNavigationProductDetailPage
```

### via zip upload
1. Download the latest _SschreierBadgeNavigationProductDetailPage-master.zip_.
2. Unzip the zip file and rename the folder to _SschreierBadgeNavigationProductDetailPage_.
3. Zip the folder to _SschreierBadgeNavigationProductDetailPage.zip_.
4. Upload the zip in the Shopware Administration.
5. Install & Activate the extension.

#### extension update (zip)
1. Download the latest _SschreierBadgeNavigationProductDetailPage-master.zip_.
2. Unzip the zip file and rename the folder to _SschreierBadgeNavigationProductDetailPage_.
3. Zip the folder to _SschreierBadgeNavigationProductDetailPage.zip_.
4. Upload the zip in the Shopware Administration.
5. Update the extension.

## Images

### custom badge in navigation

![custom badge in navigation](https://www.sebastianschreier.de/plugins/SschreierBadgeNavigationProductDetailPage/SschreierBadgeNavigationProductDetailPage-Image1.jpg)

### custom badge on product detail page

![custom badge on product detail page](https://www.sebastianschreier.de/plugins/SschreierBadgeNavigationProductDetailPage/SschreierBadgeNavigationProductDetailPage-Image2.jpg)

### extension configuration part 1

![extension configuration part 1](https://www.sebastianschreier.de/plugins/SschreierBadgeNavigationProductDetailPage/SschreierBadgeNavigationProductDetailPage-Image3.jpg)

### extension configuration part 2

![extension configuration part 2](https://www.sebastianschreier.de/plugins/SschreierBadgeNavigationProductDetailPage/SschreierBadgeNavigationProductDetailPage-Image4.jpg)

### custom badge in shopware administration

![custom badge in shopware administration](https://www.sebastianschreier.de/plugins/SschreierBadgeNavigationProductDetailPage/SschreierBadgeNavigationProductDetailPage-Image5.jpg)

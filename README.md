# magento2-API-call-with-SearchCriteria
 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
magento2 free extension API call with SearchCriteria.

<img src="https://github.com/inadeemkhan/magento2-images/blob/master/ProductCollectionPostman.png" target="_blank"/>

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Nadeem`
 - Enable the module by running `php bin/magento module:enable Nadeem_Products`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require nadeem/module-products`
 - enable the module by running `php bin/magento module:enable Nadeem_Products`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

## Specifications

 - API Endpoint
	- GET - Nadeem\Products\Api\ProductsCollectionManagementInterface > Nadeem\Products\Model\ProductsCollectionManagement


## Attributes




# "Apply To" Attribute Option for Magento 2.0

Return back to the Magento 2.0 attribute settings "Apply To" option. Choose each product type that is associated with the attribute.

![alt tag](http://blog.belvg.com/wp-content/uploads/applyto.png)

## Installation

Update root `composer.json` with 
```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/belvg-public/Magento2_ApplyTo"
        }
    ],
    "require": {
        "belvg/module-applyto": "dev-master"
    }
}
```

Run `conposer update`

Enable module with `php bin/magento module:enable BelVG_ApplyTo`

# urls-rest-api

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/)

 - Allows/Adds extension for url-resolver plugins [[plugins](Glue/UrlsRestApi/Plugin/UrlResolverPluginInterface.php)]  to /url-resolver endpoint

## Integration

### Add composer registry
```
composer config repositories.gitlab.nxs360.com/461 '{"type": "composer", "url": "https://gitlab.nxs360.com/api/v4/group/461/-/packages/composer/packages.json"}'
```

### Add Gitlab domain
```
composer config gitlab-domains gitlab.nxs360.com
```

### Authentication
Go to Gitlab and create a personal access token. Then create an **auth.json** file:
```
composer config gitlab-token.gitlab.nxs360.com <personal_access_token>
```

Make sure to add **auth.json** to your **.gitignore**.

### Install package
```
composer req valantic-spryker/elasticsearch-logging
```

### Update your shared config
```php
$config[KernelConstants::PROJECT_NAMESPACES] = [
    'ValanticSpryker',
    ...
];

$config[LogConstants::LOG_LEVEL] = Logger::DEBUG;
```

Reference implementation: https://gitlab.nxs360.com/team-lr/glue-api

Fixer: `vendor/bin/phpcbf --standard=phpcs.xml --report=full src/ValanticSpryker/`

# PHPStan extension for PHP GraphQL Server integration with Nette Framework

![Checks](https://github.com/vojtech-dobes/phpstan-php-graphql-server-nette-integration/actions/workflows/checks.yml/badge.svg?branch=master&event=push)

This extension is recommended if you use PHPStan with [`vojtech-dobes/phpstan-php-graphql-server`](https://github.com/vojtech-dobes/phpstan-php-graphql-server) extension. It gives you prepared `Adapter` implementation for easy integration with your GraphQL service setup.



## Installation

To install the latest version, run the following command:

```
composer require vojtech-dobes/phpstan-php-graphql-server-nette-integration
```



### Setup

Using this extension you tell PHPStan about your GraphQL service in two ways. Either you can directly use services registered in your DI container, or you can point the extension at NEON configuration file that holds all necessary information in static form. The latter way is less convenient but won't prevent you from using PHPStan if your DI container can't temporarily compile (which is likely to happen during active development).



#### Method 1: DI container

Update your `phpstan.neon` like this:

```neon
includes:
  - vendor/vojtech-dobes/phpstan-php-graphql-server-nette-integration/extension_di_container.neon

graphqlDIContainer:
  dic: [Bootstrap, createContainerForPHPStan]
  extensionMap:
    %rootDir%/../../../src/schema.graphqls: graphql
```

Options:

- **`dic`**

  Expects callback that will return instance of your `Nette\DI\Container` from which it can extract necessary GraphQL services.

- **`extensionMap`**

  Expects map of schema file paths to extension name you use for that particular schema in your configuration. For example if your application configuration looks like this:

  ```neon
  extensions:
    my_graphql: Vojtechdobes\GraphQL\Integrations\Nette\Extension

  my_graphql:
    schemaPath: %rootDir%/src/my_schema.graphqls
  ```

  Then your `phpstan.neon` should contain:

  ```neon
  graphqlDIContainer:
    extensionMap:
      %rootDir%/../../../src/my_schema.graphqls: my_graphql
  ```

#### Method 2: static configuration

_WIP_

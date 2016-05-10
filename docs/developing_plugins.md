# Developing Sloth Plugins

Sloth is designed to try and hook up plugins as simply as possible to allow you to focus on you functionality and not on install process.

## Plugin Structure

To see a few examples of plugins visit: DMS/BetterPRs and DMS/LabelManager

A regular plugin should have the following structure:

```
+-- config
    +-- plugin.php
+-- src
+-- tests
```

Only `config/plugin.php` is required and enforced but as long as its called `plugin.php` you are free to put it anywhere, this file will be read by Sloth to setup your services/factories and routes as well as default values for configs.

Plugin files are arrays just like the standard Zend Expressive config files, here an example:

```php
<?php

return [
    'dependencies' => [
        'factories' => [
            SomeClass::class => SomeFactory::class
        ],
    ],

    'routes' => [
        [
            'name' => 'my_plugin_route',
            'path' => '/plugin/vendor/plugin/action',
            'middleware' => SomeClass::class,
            'allowed_methods' => ['POST'],
        ]
    ],

    'vendor.plugin' => [
        'some_setting' => 'has a value'
    ]
];
```

## Plugin Installation

Your plugin can be put into Sloth in two ways:

### inline (`plugins/*`)

The plugins folder is recommended is you are developing a plugin or if you are working on a plugin that will not need to be made public or shared. You are free to use submodules in this case.

The plugin folder will be analyzed to find any configuration files by default and all these plugins will be loaded.

### via composer (`vendor/*`)

If you are writing a plugin that will be shared, you can simply package it up a a composer package and install it into the vendor folder. Sloth will also scan those folders for configuration files and enable those plugins.

You may use the `sloth-plugin` type to make searching easier and for future proofing. As well as requiring `sloth/sloth` as a dependency.

## Adding a new endpoint

Endpoints are the heart of Sloth and slack integrations, for example, if you are sending information from github to Slack, all you need is to register a webhook on github that points to one of your Sloth endpoints and you can then handle that information however you like.

1. Add a new route: in your `plugin.php` file simply add a new route. We recommend using vendor prefixes to avoid clashing with public plugins you may come to use.

    ```php
    [
        'name' => 'my_plugin_route',
        'path' => '/plugin/vendor/plugin/action',
        'middleware' => SomeClass::class,
        'allowed_methods' => ['POST'],
    ]
    ```

2. Create an Action Class: all endpoints have an Action class, this is a class that receives and handles data however you like and is PSR-7 compatible. This action will also need a `Factory` but for most simple cases you may use our `GenericSlackAwareFactory`.

## Helpers

We have added a few helpers to get you up and running and not having to worry about stuff unrelated to your use case.

### SlackAware Factory and Action

This pair offers an Action and an accompanying Factory that will hook your action up to our Slack integration allowing you to receive data, process it and shoot off messages to Slack.

This Action will by default give you an instance of our Slack integration layer.

### SlackClientInterface and Drivers

Sloth comes out of the box with a Slack Client configured, needing only a webhook url to be set in config. Around this we wrote a slight abstraction layer to allow us to switch slack client if needed and to allow you choice if you so desire.

Our abstraction offers build wrappers for Messages and attachments and send function. Instantiate a new `Sloth\Platform\Slack\Message\Builder\MessageBuilder` and use the client available at `Sloth\Platform\Slack\SlackClientInterface::class` to send it.

### AckResponse

When interfacing with github, its usually a good idea to respond with a short json message that can be used for debugging later. For this we added a simple response class that let's you simple do `return AckResponse::success()`.

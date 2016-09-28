<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * Projectfb343429d500ba4cec62dceabc754ef2ServiceContainer.
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class Projectfb343429d500ba4cec62dceabc754ef2ServiceContainer extends Container
{
    private $parameters;
    private $targetDirs = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services = array();
        $this->methodMap = array(
            'app.cache' => 'getApp_CacheService',
            'app.platform' => 'getApp_PlatformService',
            'cache.redis' => 'getCache_RedisService',
            'redis' => 'getRedisService',
            'sloth.action.home' => 'getSloth_Action_HomeService',
            'sloth.plaform.phlack_driver.client' => 'getSloth_Plaform_PhlackDriver_ClientService',
            'sloth.platform.slack.phlack_driver' => 'getSloth_Platform_Slack_PhlackDriverService',
            'sloth.platform.slack.phlack_driver.message_transformer' => 'getSloth_Platform_Slack_PhlackDriver_MessageTransformerService',
        );
        $this->aliases = array(
            'slack.client' => 'sloth.platform.slack.phlack_driver',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped frozen container.');
    }

    /**
     * {@inheritdoc}
     */
    public function isFrozen()
    {
        return true;
    }

    /**
     * Gets the 'app.cache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\Common\Cache\ArrayCache A Doctrine\Common\Cache\ArrayCache instance
     */
    protected function getApp_CacheService()
    {
        $this->services['app.cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();

        $instance->setNamespace('clay');

        return $instance;
    }

    /**
     * Gets the 'app.platform' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Zend\Expressive\Application A Zend\Expressive\Application instance
     */
    protected function getApp_PlatformService()
    {
        $this->services['app.platform'] = $instance = \Zend\Expressive\AppFactory::create(call_user_func(array(new \Acclimate\Container\ContainerAcclimator(), 'acclimate'), $this), new \Zend\Expressive\Router\FastRouteRouter());

        $instance->route('/', 'sloth.action.home', array(0 => 'GET'), 'home');

        return $instance;
    }

    /**
     * Gets the 'cache.redis' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\Common\Cache\RedisCache A Doctrine\Common\Cache\RedisCache instance
     */
    protected function getCache_RedisService()
    {
        $this->services['cache.redis'] = $instance = new \Doctrine\Common\Cache\RedisCache();

        $instance->setNamespace('clay');
        $instance->setRedis($this->get('redis'));

        return $instance;
    }

    /**
     * Gets the 'redis' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Redis A Redis instance
     */
    protected function getRedisService()
    {
        $this->services['redis'] = $instance = new \Redis();

        $instance->connect('localhost', 6379);

        return $instance;
    }

    /**
     * Gets the 'sloth.action.home' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Sloth\Platform\Web\Action\HomeAction A Sloth\Platform\Web\Action\HomeAction instance
     */
    protected function getSloth_Action_HomeService()
    {
        return $this->services['sloth.action.home'] = new \Sloth\Platform\Web\Action\HomeAction();
    }

    /**
     * Gets the 'sloth.plaform.phlack_driver.client' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Crummy\Phlack\Phlack A Crummy\Phlack\Phlack instance
     */
    protected function getSloth_Plaform_PhlackDriver_ClientService()
    {
        return $this->services['sloth.plaform.phlack_driver.client'] = \Crummy\Phlack\Phlack::factory('smoething');
    }

    /**
     * Gets the 'sloth.platform.slack.phlack_driver' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Sloth\Platform\Slack\Driver\Phlack\Slack A Sloth\Platform\Slack\Driver\Phlack\Slack instance
     */
    protected function getSloth_Platform_Slack_PhlackDriverService()
    {
        return $this->services['sloth.platform.slack.phlack_driver'] = new \Sloth\Platform\Slack\Driver\Phlack\Slack($this->get('sloth.plaform.phlack_driver.client'), $this->get('sloth.platform.slack.phlack_driver.message_transformer'));
    }

    /**
     * Gets the 'sloth.platform.slack.phlack_driver.message_transformer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Sloth\Platform\Slack\Driver\Phlack\MessageTransformer A Sloth\Platform\Slack\Driver\Phlack\MessageTransformer instance
     */
    protected function getSloth_Platform_Slack_PhlackDriver_MessageTransformerService()
    {
        return $this->services['sloth.platform.slack.phlack_driver.message_transformer'] = new \Sloth\Platform\Slack\Driver\Phlack\MessageTransformer($this->get('sloth.plaform.phlack_driver.client'));
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        $name = strtolower($name);

        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }

        return $this->parameterBag;
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'cache.namespace' => 'clay',
            'memcached.servers' => array(
                0 => array(
                    0 => 'localhost',
                    1 => 11211,
                ),
            ),
            'redis.host' => 'localhost',
            'redis.port' => 6379,
            'db.host' => '127.0.0.1',
            'db.schema' => 'clay',
            'db.user' => 'root',
            'db.password' => 'admin',
            'db.driver' => 'pdo_mysql',
            'db.charset' => 'utf8mb4',
            'orm.entity.basedir' => 'src/',
            'orm.proxy.dir' => 'storage/doctrine-proxies',
            'orm.proxy.namespace' => 'Lcobucci\\Clay\\Proxies',
            'serializer.cachedir' => 'storage/serializer',
            'cors.origin' => '*',
            'cors.allowed_methods' => 'GET,POST,PUT,PATCH,DELETE,OPTIONS',
            'cors.allowed_headers' => 'Accept,Content-Type,Authorization',
            'cors.max_age' => '1728000',
            'slack_config' => 'smoething',
            'app.devmode' => true,
            'app.basedir' => '/Users/rdohms/dev/prj/php/sloth/config/../',
        );
    }
}

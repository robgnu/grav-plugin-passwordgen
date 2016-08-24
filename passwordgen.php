<?php
namespace Grav\Plugin;
use \Grav\Common\Plugin;
class PasswordgenPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            'onTwigExtensions' => ['onTwigExtensions', 0]
        ];
    }
    /**
     * Initialize configuration
     */
    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        $this->enable([
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ]);
    }
    /**
     * Set needed variables to display passwords.
     */
    public function onTwigSiteVariables()
    {
        if ($this->config->get('plugins.passwordgen.built_in_css')) {
            $this->grav['assets']->add('plugin://passwordgen/css/passwordgen.css');
        }
    }
    /**
     * 
     */
    public function onTwigExtensions()
    {
        require_once(__DIR__ . '/twig/passwordgen.twig.php');
        $this->grav['twig']->twig->addExtension(new passwordgenTwigExtension());
    }
}
?>

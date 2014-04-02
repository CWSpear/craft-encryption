<?php
namespace Craft;

class EndecryptPlugin extends BasePlugin
{
    public function getName()
    {
         return Craft::t('Endecrypt');
    }

    public function getVersion()
    {
        return '1.0.0';
    }

    public function getDeveloper()
    {
        return 'Mavrx';
    }

    public function getDeveloperUrl()
    {
        return 'http://mavrx.io/';
    }

    public function hasCpSection()
    {
        return false;
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.endecrypt.twigextensions.EndecryptTwigExtension');

        return new EndecryptTwigExtension();
    }

    protected function defineSettings()
    {
        return array(
            'salt' => array(AttributeType::String, 'required' => true)
        );
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('endecrypt/_settings', array(
            'settings' => $this->getSettings()
        ));
    }
}

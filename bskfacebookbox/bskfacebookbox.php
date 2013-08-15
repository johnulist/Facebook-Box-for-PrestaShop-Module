<?php
/*
 * BitSHOK Facebook Box
 * 
 * @author BitSHOK <office@bitshok.net>
 * @copyright 2012 BitSHOK
 * @version 1.0
 * @license http://creativecommons.org/licenses/by/3.0/ CC BY 3.0
 */

if (!defined('_PS_VERSION_')) exit;

class BskFacebookBox extends Module{
   
    public function __construct() {
        $this->name = 'bskfacebookbox'; // internal identifier, unique and lowercase
        $this->tab = 'social_networks'; // backend module coresponding category
        $this->version = '1.0'; // version number for the module
        $this->author = 'BitSHOK'; // module author
        $this->need_instance = 0; // load the module when displaying the "Modules" page in backend

        parent::__construct();

        $this->displayName = $this->l('Facebook Box'); // public name
        $this->description = $this->l('Display Facebook box'); // public description
    }

    /*
     * Install this module
     */
    public function install()
    {
        if (!parent::install() ||
            !$this->registerHook('displayHeader') ||
            !$this->registerHook('displayFooter') )
                return false;
        
        $this->initConfiguration(); // set default values for settings
        
        return true;
    }

    /*
     * Uninstall this module
     */
    public function uninstall()
    {
        if (!parent::uninstall())
            return false;
        
        $this->deleteConfiguration(); // delete settings
        
        return parent::uninstall();
    }

    /*
     * Header of pages hook (Technical name: displayHeader)
     */
    public function hookHeader(){
        $this->context->controller->addCSS($this->_path.'style.css');
        
        $appId = Configuration::get($this->name.'_appId');
        $sdkLink = '//connect.facebook.net/en_US/all.js#xfbml=1';
        if(!empty($appId)) $sdkLink .= "&appId={$appId}";
        $this->context->smarty->assign('sdkLink', $sdkLink);
        return $this->display(__FILE__, 'bskfacebookbox_sdk.tpl');
    }
    
    public function hookFooter(){
        $settings = unserialize( Configuration::get($this->name.'_settings') );
        $this->context->smarty->assign(array(
            'fbpage'        => $settings['fbpage'],
            'width'         => $settings['width'],
            'height'        => $settings['height'],
            'colorscheme'   => $settings['colorscheme'],
            'show_header'   => $settings['show_header'],
            'show_stream'   => $settings['show_stream'],
            'show_faces'    => $settings['show_faces'],
            'show_border'   => $settings['show_border'],
        ));
        return $this->display(__FILE__, 'bskfacebookbox_footer.tpl');
    }
    
    /**
     * Configuration page
     */
    public function getContent(){
        $message = $this->processForm();
        $settings = unserialize( Configuration::get($this->name.'_settings') );
        $appId = Configuration::get($this->name.'_appId');
        
        $this->context->smarty->assign(array(
            'message'       => $message,
            'fbpage'        => $settings['fbpage'],
            'width'         => $settings['width'],
            'height'        => $settings['height'],
            'colorscheme'   => $settings['colorscheme'],
            'show_header'   => $settings['show_header'],
            'show_stream'   => $settings['show_stream'],
            'show_faces'    => $settings['show_faces'],
            'show_border'   => $settings['show_border'],
            'appId'         => $appId
        ));
        
        return $this->display(__FILE__, 'settings.tpl');
    }
    
    /**
     * Process data from Configuration page after form submition
     * @return string message
     */
    protected function processForm(){
        if(Tools::isSubmit('saveBtn')){ // save data
            // get submited values
            $settings = array(
                'fbpage'        => Tools::getValue('fbpage'),
                'width'         => Tools::getValue('width'),
                'height'        => Tools::getValue('height'),
                'colorscheme'   => Tools::getValue('colorscheme'),
                'show_header'   => Tools::getValue('show_header'),
                'show_stream'   => Tools::getValue('show_stream'),
                'show_faces'    => Tools::getValue('show_faces'),
                'show_border'   => Tools::getValue('show_border')
            );
            Configuration::updateValue($this->name.'_settings', serialize($settings));
            Configuration::updateValue($this->name.'_appId', Tools::getValue('appId'));
            
            // display success message
            return $this->displayConfirmation($this->l('The settings have been successfully saved!'));
        }
        
        return '';
    }
    
    /**
     * Set the default values for Configuration page settings
     */
    protected function initConfiguration(){
        $settings = array(
            'fbpage'        => 'bitshok',
            'width'         => 175,
            'height'        => '',
            'colorscheme'   => 'dark',
            'show_header'   => '',
            'show_stream'   => '',
            'show_faces'    => 'on',
            'show_border'   => '',
        );
        Configuration::updateValue($this->name.'_settings', serialize($settings)); // create a prestashop variable with the settings
        Configuration::updateValue($this->name.'_appId', '');
    }
    
    /**
     * Delete configuration from database
     */
    protected function deleteConfiguration(){
        Configuration::deleteByName($this->name.'_settings');
        Configuration::deleteByName($this->name.'_appId');
    }
   
}

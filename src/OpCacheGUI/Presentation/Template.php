<?php
/**
 * The class is responsible for rendering HTML templates
 *
 * PHP version 5.5
 *
 * @category   OpCacheGUI
 * @package    Presentation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2014 Pieter Hordijk <https://github.com/PeeHaa>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    2.0.0
 */
namespace OpCacheGUI\Presentation;

use OpCacheGUI\I18n\Translator;

/**
 * The class is responsible for rendering HTML templates
 *
 * @category   OpCacheGUI
 * @package    Presentation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
abstract class Template implements Renderer
{
    /**
     * @var string The directory where all the templates are stored
     */
    protected $templateDirectory;

    /**
     * @var \OpCacheGUI\I18n\Translator Instance of a translation service
     */
    protected $translator;

    /**
     * @var array List of template variables
     */
    protected $variables = [];

    /**
     * Creates instance
     *
     * @param string                      $templateDirectory The directory where all the templates are stored
     * @param \OpCacheGUI\I18n\Translator $translator        Instance of a translation service
     */
    public function __construct($templateDirectory, Translator $translator)
    {
        $this->templateDirectory = $templateDirectory;
        $this->translator        = $translator;
    }

    /**
     * Magically get template variables, because magic that's why
     *
     * Disclaimer: I am fully aware this kinda sucks and will bite me in the arse
     *             at some point, so don't bother bugging me about this :-)
     *
     * @param mixed The key of which to get the data
     *
     * @return mixed The value which belongs to the key provided
     */
    public function __get($key)
    {
        return $this->variables[$key];
    }
}
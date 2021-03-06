<?php
/**
 * Defines a decorator to handle form field errors
 *
 * @category Form
 * @package Bootstrap_Form
 * @subpackage Decorator
 * @author Jaime Neto <contato@jaimeneto.com>
 */

/**
 * A decorator to render the form element errors
 *
 * @category Form
 * @package Bootstrap_Form
 * @subpackage Decorator
 * @author Jaime Neto <contato@jaimeneto.com>
 */
class Bootstrap_Form_Decorator_ElementErrors extends Zend_Form_Decorator_Abstract
{
    /**
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        if (!$this->getElement()->hasErrors()) {
            return $content;
        }

        $options = $this->getOptions();
        $escape = true;
        if (isset($options['escape'])) {
            $escape = (bool) $options['escape'];
        }

        $errors = $this->getElement()->getMessages();
        if ($escape) {
            $view = $this->getElement()->getView();
            foreach ($errors as $key => $message) {
                $errors[$key] = $view->escape($message);
            }
        }

        $messages = '<p class="help-block">';
        foreach($errors as $errormessage) {
            $messages .= $errormessage . '<br>' . PHP_EOL;
        }
        $messages .= '</p>';

        return $content . $messages;
    }
}

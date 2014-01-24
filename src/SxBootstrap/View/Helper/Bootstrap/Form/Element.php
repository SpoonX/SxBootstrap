<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\Exception;
use Zend\Form\ElementInterface;
use Zend\Form\Element as FormElement;
use Zend\View\Helper\AbstractHelper;

class Element extends AbstractHelper
{

    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function __invoke(ElementInterface $element)
    {
        return $this->render($element);
    }

    /**
     * @param ElementInterface $element
     *
     * @return string
     * @throws \SxBootstrap\Exception\RuntimeException
     */
    protected function render(ElementInterface $element)
    {
        $renderer = $this->getView();

        if (!method_exists($renderer, 'plugin')) {
            throw new Exception\RuntimeException(
                'Renderer does not have a plugin method.'
            );
        }

        if ($element instanceof FormElement\Button) {
            $helper = $renderer->plugin('sxb_button');

            return $helper($element);
        }

        if ($element instanceof FormElement\Captcha) {
            $helper = $renderer->plugin('form_captcha');

            return $helper($element);
        }

        if ($element instanceof FormElement\Csrf) {
            $helper = $renderer->plugin('sxb_form_hidden');

            return $helper($element);
        }

        if ($element instanceof FormElement\Collection) {
            $helper = $renderer->plugin('form_collection');

            return $helper($element);
        }

        if ($element instanceof FormElement\DateTimeSelect) {
            $helper = $renderer->plugin('form_date_time_select');

            return $helper($element);
        }

        if ($element instanceof FormElement\DateSelect) {
            $helper = $renderer->plugin('form_date_select');

            return $helper($element);
        }

        if ($element instanceof FormElement\MonthSelect) {
            $helper = $renderer->plugin('form_month_select');

            return $helper($element);
        }

        $type = $element->getAttribute('type');

        if ('checkbox' === $type) {
            $helper = $renderer->plugin('form_checkbox');

            return $helper($element);
        }

        if ('color' === $type) {
            $helper = $renderer->plugin('sxb_form_color');

            return $helper($element);
        }

        if ('date' === $type) {
            $helper = $renderer->plugin('sxb_form_date');

            return $helper($element);
        }

        if ('datetime' === $type) {
            $helper = $renderer->plugin('sxb_form_date_time');

            return $helper($element);
        }

        if ('datetime-local' === $type) {
            $helper = $renderer->plugin('sxb_form_date_time_local');

            return $helper($element);
        }

        if ('email' === $type) {
            $helper = $renderer->plugin('sxb_form_email');

            return $helper($element);
        }

        if ('file' === $type) {
            $helper = $renderer->plugin('sxb_form_file');

            return $helper($element);
        }

        if ('hidden' === $type) {
            $helper = $renderer->plugin('sxb_form_hidden');

            return $helper($element);
        }

        if ('image' === $type) {
            $helper = $renderer->plugin('sxb_form_image');

            return $helper($element);
        }

        if ('month' === $type) {
            $helper = $renderer->plugin('sxb_form_month');

            return $helper($element);
        }

        if ('multi_checkbox' === $type) {
            $helper = $renderer->plugin('sxb_form_multi_checkbox');

            return $helper($element);
        }

        if ('number' === $type) {
            $helper = $renderer->plugin('sxb_form_number');

            return $helper($element);
        }

        if ('password' === $type) {
            $helper = $renderer->plugin('sxb_form_password');

            return $helper($element);
        }

        if ('radio' === $type) {
            $helper = $renderer->plugin('sxb_form_radio');

            return $helper($element);
        }

        if ('range' === $type) {
            $helper = $renderer->plugin('sxb_form_range');

            return $helper($element);
        }

        if ('reset' === $type) {
            $helper = $renderer->plugin('sxb_form_reset');

            return $helper($element);
        }

        if ('search' === $type) {
            $helper = $renderer->plugin('sxb_form_search');

            return $helper($element);
        }

        if ('select' === $type) {
            $helper = $renderer->plugin('form_select');

            return $helper($element);
        }

        if ('submit' === $type) {
            $helper = $renderer->plugin('sxb_form_submit');

            return $helper($element);
        }

        if ('tel' === $type) {
            $helper = $renderer->plugin('sxb_form_tel');

            return $helper($element);
        }

        if ('text' === $type) {
            $helper = $renderer->plugin('sxb_form_input');

            return $helper($element);
        }

        if ('textarea' === $type) {
            $helper = $renderer->plugin('form_textarea');

            return $helper($element);
        }

        if ('time' === $type) {
            $helper = $renderer->plugin('sxb_form_time');

            return $helper($element);
        }

        if ('url' === $type) {
            $helper = $renderer->plugin('sxb_form_url');

            return $helper($element);
        }

        if ('week' === $type) {
            $helper = $renderer->plugin('sxb_form_week');

            return $helper($element);
        }

        $helper = $renderer->plugin('sxb_form_input');

        return $helper($element);
    }
}

$rowPlugin     = $this->getView()->plugin('sxb_form_control_group');
$labelPlugin   = $this->getView()->plugin('sxb_form_control_label');
$controlPlugin = $this->getView()->plugin('sxb_form_controls');
$label         = $element->getLabel();
$element       = $this->renderElement($element);

if (null !== $label) {
$label = $labelPlugin($label, $element->getName());
}

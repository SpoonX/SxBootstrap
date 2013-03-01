<?php
namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Html\HtmlElement;

/**
 * 	The ViewHelper that creates a block to represent Code.
 */
class Code extends AbstractHelper
{
	/**
	 *	Create a HTML Code element
	 * 	@param 	string The contents of the element
	 * 	@return SxBootstrap\View\Helper\Bootstrap\Code
	 */
	public function __invoke($content = '')
	{
		// Check if it is one line or multiple lines of code
		// We have to use the pre element when there are multiple lines of code.
		$usePre = strpos($content, "\n") !== false;

		// Create the HtmlElement and consider the tag to use
		$this->element = new HtmlElement($usePre ? 'pre' : 'code');

		// Convert the content to valid html.
		$this->element->setContent(nl2br(htmlentities($content)));

		// return ourself
		return $this;
	}

	/**
	 * 	Return the HTML string of this HTML element
	 *  @return string
	 */
	public function render()
	{
		return $this->element->render();
	}
}

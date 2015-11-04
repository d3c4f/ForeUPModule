<?php namespace ForeUP\Marketing;


/**
 * ForeUP Marketing Module - Templates Merging
 *
 * Allows customers to create custom texts and emails
 * in formatted HTML from a template and a parameter list.
 *
 * @author Deven Fore <deven@thetransistor.com>
 */
class Template {
	// TODO: Make $template and $parameters private.
	// TODO: Move validation to getter/setter methods
	// TODO: Add error handling
	// TODO: Check for recursion via parameters

	/**
	 * Template to merge parameters into
	 *
	 * @var string $template
	*/
	public $template;

	/**
	 * List of parameters to be merged into the template
	 *
	 * @var array $parameters
	 */
	public $parameters = array();

	/**
	 * Merges the parameters into the template and renders the formatted HTML
	 *
	 * @return string HTML Rendered Template
	 */
	public function RenderHTML(){
		$renderedHTML = $this->template;

		foreach ($this->parameters as $key => $value){
			// TODO: Validate $key for PCRE escape characters: . ^ $ * + - ? ( ) [ ] { } \ |

			$encValue = htmlentities ($value, ENT_QUOTES | ENT_HTML401);
			$renderedHTML = preg_replace('/<<'.$key.'>>/i', $encValue, $renderedHTML);
		}

		return $renderedHTML;
	}

}

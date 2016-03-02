<?php

use Rain\Tpl;

class Template_Rain {

	/**
	 * TODO: parse section list if no file present
	 */
	public function template($request, $response, $template_section) {
		if ($response->statusCode == 500) {
			return;
		}
		$templatePath = _get('template_basedir')._get('template_name').'/';

		Tpl::configure(
			[
			'tpl_ext'=>'html.php',
			'tpl_dir'       =>[
				$templatePath.'views/'.$request->appName.'/',
				'src/'.$request->appName.'/views/',
				'local/'.$request->appName.'/views/',
				$templatePath.'views/',
			],
			'cache_dir'=>'var/cache/'
			]
		);

		Tpl::registerTag(	"({%asseturl.*?%})", // preg split
			"{%asseturl (.*?)%}", // preg match
			function( $params ){ // function called by the tag
				return m_url().$params[1][0];
			}
		);

		Tpl::registerTag(	"({%templateurl.*?%})", // preg split
			"{%templateurl (.*?)%}", // preg match
			function( $params ){ // function called by the tag
				return m_turl().$params[1][0];
			}
		);

		$viewFile = _get('template.main.file', $request->modName.'_'.$request->actName);
		try {
			$t = new Tpl;
			$t->var = $response->sectionList;
			$t->assign('baseurl', m_url());
			$t->assign('turl', m_turl());
			ob_start();
			$t->draw($viewFile);
			$x =  ob_get_contents();
			ob_end_clean();
			echo $x;
		} catch (\Rain\Tpl\NotFoundException $e) {
			if ($response->has('main')) {
				if (is_array($response->main)) {
					$mainArray = $response->main;
				} else {
					$mainArray = array($response->main);
				}

				foreach ($mainArray as $_itm) {
					echo "<section>";
					echo $this->transformContent($_itm);
					echo "</section>";
				}
			}
		} catch (Exception $e) {
			//output.php::hangup() will set the header for 500
			//if we are in production mode, we can set apache or
			// nginx in cgi mode to intercept status headers and
			// show a custom 500/501 page.
			$response->statusCode = 500;
			if ($request->isDevelopment()) {
				throw $e;
			}
		}
	}

	public function transformContent($content) {

		//struct
		if (is_array($content)) {
			return implode(' ', array_values($content));
		}

		//we have some special output,
		// could be text, could be object
		if (!is_object($content))
			return $content;

		//it's an object
		if (method_exists( $content, 'toHtml' )) {
			return call_user_func(array($content, 'toHtml'));
		}

		if (method_exists( $content, 'toString' )) {
			return call_user_func(array($content, 'toString'));
		}

		if (method_exists( $content, '__toString' )) {
			return call_user_func(array($content, '__toString'));
		}
	}
}

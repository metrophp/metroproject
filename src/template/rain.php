<?php

use Rain\Tpl;

class Template_Rain {

	/**
	 * TODO: parse section list if no file present
	 */
	public function template($request, $response, $template_section) {
		Tpl::configure(
			[
			'tpl_ext'=>'html.php',
			'tpl_dir'       =>[
				$templatePath.'views/'.$request->appName.'/',
				'src/'.$request->appName.'/views/',
				'local/'.$request->appName.'/views/'
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

		try {
			$t = new Tpl;
			$t->var = $response->sectionList;
			$t->assign('baseurl', m_url());
			$t->assign('turl', m_turl());
			ob_start();
			$t->draw($request->modName.'_'.$request->actName);
			$x =  ob_get_contents();
			ob_end_clean();
			echo $x;
		} catch (Exception $e) {
			if ($request->isDevelopment()) {
				throw $e;
			}
			//output.php::hangup() will set the header for 500
			//if we are in production mode, we can set apache or
			// nginx in cgi mode to intercept status headers and
			// show a custom 500/501 page.
			$response->statusCode = 500;
		}
	}
}

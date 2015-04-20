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
			'tpl_dir'=>'src/'.$request->appName.'/views',
			'cache_dir'=>'var/cache/'
			]
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
			//TODO: show errors in dev mode
			//meh.. just keep goin
		}
	}
}

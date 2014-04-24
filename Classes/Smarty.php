<?php
/**
 * Plugin class
 */
namespace Phile\Plugin\Phile\TemplateSmarty;


use Phile\Registry;
use Phile\Event;
use Phile\ServiceLocator\TemplateInterface;

class Smarty implements TemplateInterface {
	/**
	 * @var array the complete phile config
	 */
	protected $settings;

	/**
	 * @var array the config for smarty
	 */
	protected $config;

	/**
	 * @var \Phile\Model\Page
	 */
	protected $page;

	public function __construct($config = null)	{
		if (!is_null($config)) {
			$this->config = $config;
		}
		$this->settings = Registry::get('Phile_Settings');
	}

	public function setCurrentPage(\Phile\Model\Page $page) {
		$this->page = $page;
	}

	public function render() {
		$pageRepository = new \Phile\Repository\Page();
		$output = 'No template found!';
		if (file_exists(THEMES_DIR . $this->settings['theme'])) {
			$smarty = new \Smarty();
			$smarty->setTemplateDir(THEMES_DIR . $this->settings['theme']);
			$smarty->setCompileDir(THEMES_DIR . $this->settings['theme'] . '/_compiled');
			$smarty->setCacheDir($this->config['cache_dir']);
			$smarty->debugging = $this->config['debugging'];
			$data = array(
				'config' => $this->settings,
				'base_dir' => rtrim(ROOT_DIR, '/'),
				'base_url' => $this->settings['base_url'],
				'theme_dir' => THEMES_DIR . $this->settings['theme'],
				'theme_url' => $this->settings['base_url'] .'/'. basename(THEMES_DIR) .'/'. $this->settings['theme'],
				'site_title' => $this->settings['site_title'],
				'current_page' => array(
					'title' => $this->page->getTitle(),
					'url' => $this->page->getUrl()
					),
				'meta' => $this->page->getMeta(),
				'content' => $this->page->getContent()
				);
			// we need to break down this object for Smarty
			$pages = $pageRepository->findAll($this->settings);
			$data['pages'] = array();
			for ($i=0; $i < count($pages); $i++) {
				$data['pages'][] = array(
					'title' => $pages[$i]->getTitle(),
					'url' => $pages[$i]->getUrl(),
					'content' => $pages[$i]->getContent(),
					'meta' => $pages[$i]->getMeta()
					);
			}
			// assign the data
			foreach ($data as $key => $value) {
				$smarty->assign($key, $value);
			}

			Event::triggerEvent('template_engine_registered', array('engine' => &$smarty));

			$template = ($this->page->getMeta()->get('template') !== null) ? $this->page->getMeta()->get('template') : 'index';
			$smarty->display($template . '.tpl');
		}
		return $output;
	}
}

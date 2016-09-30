<?php // strict

namespace LayoutCore\Providers;

use LayoutCore\Extensions\TwigLayoutCoreExtension;
use LayoutCore\Extensions\TwigServiceProvider;
use LayoutCore\Providers\LayoutCoreRouteServiceProvider;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;


class LayoutCoreServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->getApplication()->register(LayoutCoreRouteServiceProvider::class);

		$this->getApplication()->singleton('LayoutCore\Helper\TemplateContainer');

		$this->getApplication()->bind('LayoutCore\Builder\Item\ItemColumnBuilder');
		$this->getApplication()->bind('LayoutCore\Builder\Item\ItemFilterBuilder');
		$this->getApplication()->bind('LayoutCore\Builder\Item\ItemParamsBuilder');

		$this->getApplication()->singleton('LayoutCore\Services\NavigationService');
		$this->getApplication()->singleton('LayoutCore\Services\CategoryService');

	}

	public function boot(Twig $twig)
	{
		$twig->addExtension(TwigServiceProvider::class);
		$twig->addExtension(TwigLayoutCoreExtension::class);
		$twig->addExtension('Twig_Extensions_Extension_Intl');
	}
}
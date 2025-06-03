<?php declare(strict_types=1);

namespace Vojtechdobes\Tests;

use Nette;


final class MyConfigurator
{

	public function createContainer(): Nette\DI\Container
	{
		$configurator = new Nette\Bootstrap\Configurator();
		$configurator->setDebugMode(true);
		$configurator->setTempDirectory(__DIR__ . '/../tests-temp');
		$configurator->addConfig(__DIR__ . '/CorrespondanceRuleTest.appConfig.neon');
		$configurator->addStaticParameters([
			'schemaPath' => __DIR__ . '/../vendor/vojtech-dobes/phpstan-php-graphql-server/tests-shared/schema.graphqls',
		]);

		return $configurator->createContainer();
	}

}

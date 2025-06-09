<?php declare(strict_types=1);

namespace Vojtechdobes\PHPStan\GraphQL;

use Nette;
use Vojtechdobes;


final class NetteDIContainerAdapter implements Adapter
{

	private Nette\DI\Container $dic;

	/** @var array<string, string> */
	private readonly array $extensionMap;



	/**
	 * @param callable(): Nette\DI\Container $dic
	 * @param array<string, string> $extensionMap
	 */
	public function __construct(
		callable $dic,
		array $extensionMap,
	) {
		$this->dic = $dic();

		$this->extensionMap = array_combine(
			array_map(
				static fn ($key) => realpath($key),
				array_keys($extensionMap),
			),
			$extensionMap,
		);
	}



	public function getSchema(string $schemaName): Vojtechdobes\GraphQL\TypeSystem\Schema
	{
		return $this->dic->getService($this->extensionMap[$schemaName] . '.schema');
	}



	public function getFieldResolverProvider(string $schemaName): Vojtechdobes\GraphQL\FieldResolverProvider
	{
		return $this->dic->getService($this->extensionMap[$schemaName] . '.fieldResolverProvider');
	}

}

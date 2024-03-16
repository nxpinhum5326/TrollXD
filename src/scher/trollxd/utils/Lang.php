<?php

declare(strict_types=1);

namespace scher\trollxd\utils;

use scher\trollxd\Loader;

class Lang {
	/** @var array<string, mixed> */
	private static array $translations = [];

	private static array $languages = [];

	private static string $defaultLanguage;

	/**
	 * Initializes the language module.
	 *
	 * @param array $languages (going to be loaded)
	 * @return void
	 */
	public static function init(array $languages): void {
		self::$languages = $languages;
		self::$defaultLanguage = Loader::getInstance()->getConfig()->get("language");

		foreach (self::$languages as $language) {
			$path = Loader::getInstance()->getDataFolder() . "langs/$language.json";
			self::loadTranslations($path, $language);
		}
	}

	/**
	 * Loads translations.
	 *
	 * @param string $path
	 * @param string $language
	 *
	 * @throws \RuntimeException
	 */
	private static function loadTranslations(string $path, string $language): void {
		if (!file_exists($path)) {
			return;
		}

		$jsonContent = file_get_contents($path);

		if ($jsonContent === false) {
			throw new \RuntimeException("Could not read file $path");
		}

		$translations = json_decode($jsonContent, true);

		if ($translations === null && json_last_error() !== JSON_ERROR_NONE) {
			throw new \RuntimeException("Could not decode JSON in file $path");
		}

		self::$translations[$language] = $translations["translations"] ?? [];
	}

	/**
	 * @return string[]
	 */
	public static function getLanguages(): array {
		return self::$languages;
	}

	/**
	 * Retrieves the default language.
	 *
	 * @return string
	 */
	public static function getDefaultLanguage(): string {
		return self::$defaultLanguage;
	}

	/**
	 * @param string $key
	 * @param array<string, mixed> $replacements
	 *
	 * @return string
	 */
	public static function translate(string $key, array $replacements = []): string {
		$language = self::getDefaultLanguage();

		$languageTranslations = self::$translations[$language] ?? [];
		$translation = $languageTranslations[$key] ?? $key;

		$translation = str_replace("&", "§", $translation);

		foreach ($replacements as $placeholder => $value) {
			$translation = str_replace("{%" . $placeholder . "}", $value, $translation);
		}

		return $translation;
	}
}

<?php
/**
 * Benchmark PHP hash algorithms
 * @file    HashBench.php
 *
 * PHP version 5.3.9+
 *
 * @author  Alexander Yancharuk <alex@itvault.info>
 * @date    Sat Sep 20 03:37:20 2014
 * @copyright The BSD 3-Clause License.
 */

namespace Tests;

use Veles\Tools\CliProgressBar;
use Veles\Tools\Timer;
use Application\TestApplication;

/**
 * Class HashBench
 *
 * @author Alexander Yancharuk <alex@itvault.info>
 */
class HashBench extends TestApplication
{
    protected static $repeats = 10000;

	final public static function run()
	{
		$repeats = self::getRepeats();
		$string = uniqid();
		$hashes = hash_algos();

		foreach ($hashes as $hash_name) {
			$bar = new CliProgressBar($repeats);
			for ($i = 1; $i <= $repeats; ++$i) {
				Timer::start();
				hash($hash_name, $string);
				Timer::stop();
				$bar->update($i);
			}

			self::addResult($hash_name, Timer::get());

			Timer::reset();
		}
	}
}
<?php
/**
 * Check what is faster foreach or while
 *
 * @file      ForeachVsWhile.php
 *
 * PHP version 5.4+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      Втр Сен 10 17:03:20 2013
 * @license   The BSD 3-Clause License
 *            <https://tldrlegal.com/license/bsd-3-clause-license-(revised)>
 */

namespace Tests;

use Application\TestApplication;
use Veles\Tools\CliProgressBar;
use Veles\Tools\Timer;

/**
 * Class ForeachVsWhile
 * @author  Yancharuk Alexander <alex at itvault dot info>
 */
class ForeachVsWhile extends TestApplication
{
	protected $repeats = 1000;

	public function run()
	{
		$repeats = $this->getRepeats();

		$bar = new CliProgressBar($repeats);
		for ($i = 1; $i <= $repeats; ++$i) {
			Timer::start();
			$j = 0; while (++$j <= $repeats) {}
			Timer::stop();
			$bar->update($i);
		}

		$this->addResult('while', Timer::get());

		$bar = new CliProgressBar($repeats);

		Timer::reset();
		for ($i = 1; $i <= $repeats; ++$i) {
			Timer::start();
			for ($j = 0; $j < $repeats; ++$j) {}
			Timer::stop();
			$bar->update($i);
		}

		$this->addResult('for', Timer::get());
	}
}

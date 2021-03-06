<?php
/**
 * What is faster typecasting or function intval()
 *
 * @file      IntvalVsTypeCast.php
 *
 * PHP version 5.4+
 *
 * @author    Alexander Yancharuk <alex at itvault dot info>
 * @date      Thu Apr 03 14:39:45 2014
 * @license   The BSD 3-Clause License
 *            <https://tldrlegal.com/license/bsd-3-clause-license-(revised)>
 */

namespace Tests;

use Application\TestApplication;
use Veles\Tools\CliProgressBar;
use Veles\Tools\Timer;

/**
 * Class IntvalVsTypeCast
 *
 * @author Alexander Yancharuk <alex at itvault dot info>
 */
class IntvalVsTypeCast extends TestApplication
{
    protected $repeats = 10000;

	public function run()
	{
		$repeats = $this->getRepeats();

		$bar = new CliProgressBar($repeats);
		for ($i = 1; $i <= $repeats; ++$i) {
			Timer::start();
			(int) 5.55;
			Timer::stop();
			$bar->update($i);
		}

		$this->addResult('(int)', Timer::get());

		Timer::reset();
		$bar = new CliProgressBar($repeats);
		for ($i = 1; $i <= $repeats; ++$i) {
			Timer::start();
			intval(5.55);
			Timer::stop();
			$bar->update($i);
		}

		$this->addResult('intval()', Timer::get());
	}
}

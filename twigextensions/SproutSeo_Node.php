<?php

namespace Craft;

class SproutSeo_Node extends \Twig_Node
{
	/**
	 * Compiles a Optimize_Node into PHP.
	 */
	public function compile(\Twig_Compiler $compiler)
	{
		if ($this->getNode('action') == 'optimize')
		{
			$compiler
				->addDebugInfo($this)
				->write("echo \Craft\craft()->sproutSeo->optimize->getMetadata(\$context);\n\n");
		}
	}
}

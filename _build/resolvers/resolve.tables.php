<?php

if ($object->xpdo) {
	/* @var modX $modx */
	$modx =& $object->xpdo;

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
		case xPDOTransport::ACTION_UPGRADE:

			$modelPath = $modx->getOption('core_path').'components/bannery/model/';
			$modx->addPackage('bannery', $modelPath);
			$manager = $modx->getManager();
			$objects = array(
				'byAd',
				'byPosition',
				'byAdPosition',
				'byClick',
			);
			foreach ($objects as $v) {
				$manager->createObjectContainer($v);
			}

			$level = $modx->getLogLevel();

			$modx->setLogLevel(xPDO::LOG_LEVEL_FATAL);
			$manager->addField('byAd', 'source');
			$manager->addField('byAd', 'start');
			$manager->addField('byAd', 'end');
			$manager->addIndex('byAd', 'active');
			$manager->addIndex('byAd', 'start');
			$manager->addIndex('byAd', 'end');
			$manager->addIndex('byPosition', 'name');
			$manager->addIndex('byAdPosition', 'ad');
			$manager->addIndex('byAdPosition', 'position');
			$modx->setLogLevel($level);
			break;

		case xPDOTransport::ACTION_UNINSTALL:
			break;
	}
}
return true;
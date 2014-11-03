<?php
/**
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    J!Code Framework
 * @package     J!Code Framework
 * @author      Jeroen Bleijenberg <jeroen@maxserv.nl>
 *
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
namespace Jcode\Core\Model;

class Observer
{

    /**
     * @var
     */
    protected $_config;

    /**
     * Add additional helpers to Flow
     *
     * @param \Jcode\Event $observer
     */
    public function addFlowHelpers(\Jcode\Event $observer)
    {
        $helpersObject = $observer->getEventData();
        $this->_config = $observer->getConfig();

        $helpersObject->addData('skinurl', function ($file) {
            return sprintf('%s/design/%s/%s', $this->_config->getWeb()->getBaseUrl(),
                $this->_config->getDesign()->getLayout(), $file);
        });

        $helpersObject->addData('url', function ($path) {
            return sprintf('%s/%s', $this->_config->getWeb()->getBaseUrl(), $path);
        });
    }

    /**
     * Set flow mode to never, for development purposes
     *
     * @param \Jcode\Event $observer
     */
    public function flowInitBefore(\Jcode\Event $observer)
    {
        $flowSettings = $observer->getEventData();

        $flowSettings->setMode(\Flow\Loader::RECOMPILE_ALWAYS);
    }
}
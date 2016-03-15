<?php
/**
 * BelVG LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 *
 ********************************************************************
 * @category   BelVG
 * @package    BelVG_ApplyTo
 * @copyright  Copyright (c) 2010 - 2015 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 */
namespace BelVG\ApplyTo\Model;
use Magento\Framework\Event\ObserverInterface;

class Observer implements ObserverInterface
{
    protected $context;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\Registry $registry
    ) {
        $this->_coreRegistry = $registry;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $form = $observer->getForm();
        $attributeObject = $this->getAttributeObject();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $types = $objectManager->create('Magento\Catalog\Model\ProductTypes\Config')->getAll();
        $values = [];
        foreach ($types as $type)
            $values[]=[
                'label'=>$type['label'],
                'value'=>$type['name']
            ];

        $fieldset = $form->getElement('base_fieldset');
        $fieldset->addField(
            'apply_to',
            'multiselect',
            [
                'name' => 'apply_to[]',
                'label' => __('Apply to'),
                'title' => __('Apply to'),
                'required' => true,
                'value'=>$attributeObject->getApplyTo(),
                'values' =>$values
            ]
        );
        $observer->setForm($form);
        return $this;
    }

    /**
     * Return attribute object
     *
     * @return Attribute
     */
    public function getAttributeObject()
    {
        return $this->_coreRegistry->registry('entity_attribute');
    }
}

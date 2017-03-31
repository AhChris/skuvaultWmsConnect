<?php
namespace SkuVault\WMSConnect\Plugin;

class ProductActions
{
    protected $context;
    protected $urlBuilder;
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->context = $context;
        $this->urlBuilder = $urlBuilder;
    }
    public function afterPrepareDataSource(
        \Magento\Catalog\Ui\Component\Listing\Columns\ProductActions $subject,
        array $dataSource
    ) {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$subject->getData('name')]['see_in_skuvault'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'https://app.skuvault.com/products/product/list?term='.$item['sku']
                    ),
                'label' => __('See in SkuVault'),
                'hidden' => false,
                ];
            }
        }
        return $dataSource;
    }
}

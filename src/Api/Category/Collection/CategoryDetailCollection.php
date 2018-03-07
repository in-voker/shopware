<?php declare(strict_types=1);

namespace Shopware\Api\Category\Collection;

use Shopware\Api\Category\Struct\CategoryDetailStruct;

class CategoryDetailCollection extends CategoryBasicCollection
{
    /**
     * @var CategoryDetailStruct[]
     */
    protected $elements = [];

    public function getParents(): CategoryBasicCollection
    {
        return new CategoryBasicCollection(
            $this->fmap(function (CategoryDetailStruct $category) {
                return $category->getParent();
            })
        );
    }

    public function getChildrenIds(): array
    {
        $ids = [];
        foreach ($this->elements as $element) {
            foreach ($element->getChildren()->getIds() as $id) {
                $ids[] = $id;
            }
        }

        return $ids;
    }

    public function getChildren(): CategoryBasicCollection
    {
        $collection = new CategoryBasicCollection();
        foreach ($this->elements as $element) {
            $collection->fill($element->getChildren()->getElements());
        }

        return $collection;
    }

    public function getTranslationIds(): array
    {
        $ids = [];
        foreach ($this->elements as $element) {
            foreach ($element->getTranslations()->getIds() as $id) {
                $ids[] = $id;
            }
        }

        return $ids;
    }

    public function getTranslations(): CategoryTranslationBasicCollection
    {
        $collection = new CategoryTranslationBasicCollection();
        foreach ($this->elements as $element) {
            $collection->fill($element->getTranslations()->getElements());
        }

        return $collection;
    }

    protected function getExpectedClass(): string
    {
        return CategoryDetailStruct::class;
    }
}

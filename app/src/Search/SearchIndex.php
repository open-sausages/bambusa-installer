<?php
namespace SilverStripe\Bambusa\Search;

use Firesphere\SolrSearch\Indexes\BaseIndex;
use SilverStripe\CMS\Model\SiteTree;

class SearchIndex extends BaseIndex
{
    public function init()
    {
        $this->addClass(SiteTree::class);
        $this->addFulltextField('Title');
        /** @see ElementalArea::getElementsForSearch */
        $this->addFulltextField('ElementsForSearch');
    }

    public function getIndexName()
    {
        // Hardwired to docker-compose pre-creation at the moment
        return 'mycore';
    }
}

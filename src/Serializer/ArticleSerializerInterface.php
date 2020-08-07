<?php

declare(strict_types=1);

namespace ArticlesApp\Serializer;

use ArticlesApp\Model\Article;

/**
 * @author Karol Gancarczyk
 */
interface ArticleSerializerInterface {

    public function serialize(Article $article);

}
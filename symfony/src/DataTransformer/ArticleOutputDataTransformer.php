<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Article;
use App\DTO\ArticleOutput;

/**
 * Description of ArticleOutputDataTransformer
 *
 * @author kuro
 */
class ArticleOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $output = new ArticleOutput();
        $output->title = 'Title is : ' . $data->getTitle();
        $output->contents = $data->getContents();
        $uploadTime = $data->getUpdateTime();
        $output->updateTime = $uploadTime ?
            $uploadTime->format('m/d H:i') . ' ' . $uploadTime->getTimezone()->getName() :
            'not set';

        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof ArticleOutput) {
            // already transformed
            return false;
        }
        
        return ArticleOutput::class === $to && $data instanceof Article;
    }
}

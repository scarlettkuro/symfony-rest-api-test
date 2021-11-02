<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Article;
use App\DTO\ArticleInput;

/**
 * Description of ArticleInputDataTransformer
 *
 * @author kuro
 */
class ArticleInputDataTransformer implements DataTransformerInterface
{
    /*private $validator;
 
    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = []) : Article
    {
        $this->validator->validate($data);
        
        $article = isset($data->id) ?
                $context[AbstractItemNormalizer::OBJECT_TO_POPULATE]
                : new Article();
        $article->setTitle($data->title);
        $article->setContents($data->contents);
        
        // we recieve time in one timezone, but save in another
        $updateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $data->updateTime, new \DateTimeZone('Africa/Asmera'));
        $updateTime->setTimezone(new \DateTimeZone('UTC'));
        $article->setUpdateTime($updateTime);
 
        return $article;
    }
 
    /**
     * {@inheritDoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Article) {
            // already transformed
            return false;
        }
        
        return Article::class === $to && ($context['input']['class'] ?? null) === ArticleInput::class;
    }
}

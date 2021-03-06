<?php

namespace PServerCore\Service;


use Closure;
use PServerCore\Options\GeneralOptions;
use Zend\Cache\Storage\StorageInterface;

class CachingHelper
{
    /** @var  StorageInterface */
    protected $cachingService;

    /** @var  GeneralOptions */
    protected $generalOptions;

    /**
     * CachingHelper constructor.
     * @param StorageInterface $cachingService
     * @param GeneralOptions $generalOptions
     */
    public function __construct(StorageInterface $cachingService, GeneralOptions $generalOptions)
    {
        $this->cachingService = $cachingService;
        $this->generalOptions = $generalOptions;
    }

    /**
     * @param $cacheKey
     * @param Closure $closure
     * @param null $lifetime
     * @return mixed
     */
    public function getItem($cacheKey, Closure $closure, $lifetime = null)
    {
        // we have to check if we enable the caching in config
        if (!$this->isCachingEnable()) {
            return $closure();
        }

        $data = $this->cachingService->getItem($cacheKey);
        if (!$data) {
            $data = $closure();
            if ($lifetime > 0) {
                $this->cachingService->setOptions(
                    $this->cachingService
                        ->getOptions()
                        ->setTtl($lifetime)
                );
            }
            $this->cachingService->setItem($cacheKey, $data);
        }

        return $data;
    }

    /**
     * @param $cacheKey
     */
    public function delItem($cacheKey)
    {
        $this->cachingService->removeItem($cacheKey);
    }

    /**
     * @return bool
     */
    public function isCachingEnable()
    {
        return (bool)$this->generalOptions->getCache()['enable'];
    }

} 
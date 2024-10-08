<?php

declare(strict_types=1);

/*
 * This file is part of rekalogika/rekapager package.
 *
 * (c) Priyadi Iman Nurcahyo <https://rekalogika.dev>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Rekalogika\Rekapager\Batch;

use Rekalogika\Rekapager\Batch\Event\AfterPageEvent;
use Rekalogika\Rekapager\Batch\Event\AfterProcessEvent;
use Rekalogika\Rekapager\Batch\Event\BeforePageEvent;
use Rekalogika\Rekapager\Batch\Event\BeforeProcessEvent;
use Rekalogika\Rekapager\Batch\Event\InterruptEvent;
use Rekalogika\Rekapager\Batch\Event\ItemEvent;
use Rekalogika\Rekapager\Batch\Event\TimeLimitEvent;

/**
 * @template TKey of array-key
 * @template T
 * @implements BatchProcessorInterface<TKey,T>
 */
abstract class BatchProcessorDecorator implements BatchProcessorInterface
{
    /**
     * @param BatchProcessorInterface<TKey,T> $decorated
     */
    public function __construct(private readonly BatchProcessorInterface $decorated) {}

    #[\Override]
    public function processItem(ItemEvent $itemEvent): void
    {
        $this->decorated->processItem($itemEvent);
    }

    #[\Override]
    public function getItemsPerPage(): int
    {
        return $this->decorated->getItemsPerPage();
    }

    #[\Override]
    public function beforeProcess(BeforeProcessEvent $event): void
    {
        $this->decorated->beforeProcess($event);
    }

    #[\Override]
    public function afterProcess(AfterProcessEvent $event): void
    {
        $this->decorated->afterProcess($event);
    }

    #[\Override]
    public function beforePage(BeforePageEvent $event): void
    {
        $this->decorated->beforePage($event);
    }

    #[\Override]
    public function afterPage(AfterPageEvent $event): void
    {
        $this->decorated->afterPage($event);
    }

    #[\Override]
    public function onInterrupt(InterruptEvent $event): void
    {
        $this->decorated->onInterrupt($event);
    }

    #[\Override]
    public function onTimeLimit(TimeLimitEvent $event): void
    {
        $this->decorated->onTimeLimit($event);
    }
}
